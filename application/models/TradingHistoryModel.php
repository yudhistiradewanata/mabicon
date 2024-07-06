<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TradingHistoryModel extends CI_Model
{
    private $table='trading_histories';
    public function getTradingHistories($filter = [])
    {
        if (isset($filter['username']) && !empty($filter['username'])) {
            $this->db->like('u.username', $filter['username']);
        }

        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('t.user_id', $filter['user_id']);
        }

        if (isset($filter['asset']) && !empty($filter['asset'])) {
            $this->db->like('t.asset', $filter['asset']);
        }

        if (isset($filter['trade_date']) && !empty($filter['trade_date'])) {
            $this->db->where('date(t.trade_date)', $filter['trade_date']);
        }

        if (isset($filter['start_date']) && !empty($filter['start_date'])) {
            $this->db->where('date(t.trade_date) >=', $filter['start_date']);
        }

        if (isset($filter['end_date']) && !empty($filter['end_date'])) {
            $this->db->where('date(t.trade_date) <=', $filter['end_date']);
        }

        return $this->db->select('t.*,u.username')->from($this->table.' t')->join('users u','t.user_id=u.id')->get()->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function importTrades($filePath)
    {
        // Load the CSVReader library
        $this->load->library('CSVReader');
        
        // Load CSV data
        $trades = $this->csvreader->parse_file($filePath);

        // Get unique trading account IDs from the CSV
        $tradingAccountIds = array_unique(array_column($trades, 'account_id'));
        $tradeIds = array_column($trades, 'trade_id');

        // Get users mapped by account_id
        $users = $this->db->where_in('account_id', $tradingAccountIds)
                          ->get('users')
                          ->result_array();
        $userMap = array_column($users, null, 'account_id');

        // Get existing trades to check for duplicates and status changes
        $existingTrades = $this->db->where_in('trade_id', $tradeIds)
                                   ->get('trading_histories')
                                   ->result_array();
        $existingTradeMap = [];
        foreach ($existingTrades as $trade) {
            $existingTradeMap[$trade['trade_id']] = $trade;
        }

        // Get current balances for all relevant users
        $userIds = array_column($users, 'id');
        $currentBalances = $this->db->select('user_id, SUM(debit_amount) - SUM(credit_amount) AS balance_amount')
                                    ->where_in('user_id', $userIds)
                                    ->group_by('user_id')
                                    ->get('balances')
                                    ->result_array();
        $balanceMap = array_column($currentBalances, 'balance_amount', 'user_id');

        // Prepare data for insertion and update
        $newTradingData = [];
        $updateTradingData = [];
        $balanceRecords = [];
        $rebateBonuses = [];

        foreach ($trades as $trade) {
            if (isset($userMap[$trade['account_id']])) {
                $userId = $userMap[$trade['account_id']]['id'];

                // Check if trade already exists
                $existingTrade = isset($existingTradeMap[$trade['trade_id']]) ? $existingTradeMap[$trade['trade_id']] : null;

                // Handle close_date
                $trade['close_date'] = empty($trade['close_date']) ? null : $trade['close_date'];

                if ($existingTrade) {
                    // Skip if trade is already imported and status is still open
                    if ($existingTrade['trade_status'] == 'open' && $trade['trade_status'] == 'open') {
                        continue;
                    }

                    // Skip crediting margin if the trade was previously imported
                    $skipMarginCredit = true;

                    // Debit margin and PnL separately if trade status changed from open to closed
                    if ($existingTrade['trade_status'] == 'open' && $trade['trade_status'] == 'closed') {
                        $balanceRecords[] = [
                            'user_id' => $userId,
                            'debit_amount' => $trade['margin'],
                            'credit_amount' => 0,
                            'last_updated' => $trade['close_date'],
                            'associated_with' => 'trade',
                            'associated_id' => null,
                            'notes' => 'Trade close margin debit',
                            'created_at' => $trade['close_date'],
                            'updated_at' => $trade['close_date'],
                            'deleted_at' => null
                        ];

                        if ($trade['pnl'] != 0) {
                            if ($trade['pnl'] < 0) {
                                $balanceRecords[] = [
                                    'user_id' => $userId,
                                    'debit_amount' => 0,
                                    'credit_amount' => abs($trade['pnl']),
                                    'last_updated' => $trade['close_date'],
                                    'associated_with' => 'trade',
                                    'associated_id' => null,
                                    'notes' => 'Trade close PnL credit',
                                    'created_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'updated_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'deleted_at' => null
                                ];
                            } else {
                                $balanceRecords[] = [
                                    'user_id' => $userId,
                                    'debit_amount' => $trade['pnl'],
                                    'credit_amount' => 0,
                                    'last_updated' => $trade['close_date'],
                                    'associated_with' => 'trade',
                                    'associated_id' => null,
                                    'notes' => 'Trade close PnL debit',
                                    'created_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'updated_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'deleted_at' => null
                                ];
                            }
                        }

                        if ($trade['rebate_amount'] > 0) {
                            // Prepare rebate bonus data
                            $rebateBonuses[] = [
                                'user_id' => $userId,
                                'bonus_type' => 'rebate',
                                'description' => 'Rebate for trade ' . $trade['trade_id'],
                                'bonus_amount' => $trade['rebate_amount'],
                                'created_at' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s')
                            ];

                            // Debit user's balance with rebate amount
                            $balanceRecords[] = [
                                'user_id' => $userId,
                                'debit_amount' => 0,
                                'credit_amount' => $trade['rebate_amount'],
                                'last_updated' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s'),
                                'associated_with' => 'rebate',
                                'associated_id' => null,
                                'notes' => 'Rebate bonus credit',
                                'created_at' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s'),
                                'updated_at' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s'),
                                'deleted_at' => null
                            ];
                        }
                    }

                    // Add to update array
                    $updateTradingData[] = [
                        'id' => $existingTrade['id'],
                        'user_id' => $userId,
                        'account_id' => $trade['account_id'],
                        'trade_id' => $trade['trade_id'],
                        'trade_date' => $trade['trade_date'],
                        'close_date' => $trade['close_date'],
                        'asset' => $trade['asset'],
                        'order' => $trade['order'],
                        'open_price' => $trade['open_price'],
                        'trade_status' => $trade['trade_status'],
                        'close_price' => $trade['close_price'],
                        'pnl' => $trade['pnl'],
                        'margin' => $trade['margin'],
                        'lot' => $trade['lot'],
                        'rebate' => $trade['rebate_amount'],
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                } else {
                    // Prepare trade data for insertion
                    $newTradingData[] = [
                        'user_id' => $userId,
                        'account_id' => $trade['account_id'],
                        'trade_id' => $trade['trade_id'],
                        'trade_date' => $trade['trade_date'],
                        'close_date' => $trade['close_date'],
                        'asset' => $trade['asset'],
                        'order' => $trade['order'],
                        'open_price' => $trade['open_price'],
                        'trade_status' => $trade['trade_status'],
                        'close_price' => $trade['close_price'],
                        'pnl' => $trade['pnl'],
                        'margin' => $trade['margin'],
                        'lot' => $trade['lot'],
                        'rebate' => $trade['rebate_amount'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    // Credit user balance for margin
                    $balanceRecords[] = [
                        'user_id' => $userId,
                        'debit_amount' => 0,
                        'credit_amount' => $trade['margin'],
                        'last_updated' => $trade['trade_date'],
                        'associated_with' => 'trade',
                        'associated_id' => null,
                        'notes' => 'Trade open margin credit',
                        'created_at' => $trade['trade_date'],
                        'updated_at' => $trade['trade_date'],
                        'deleted_at' => null
                    ];

                    // Handle closed trades for new entries
                    if ($trade['trade_status'] == 'closed') {
                        // Debit margin and PnL
                        $balanceRecords[] = [
                            'user_id' => $userId,
                            'debit_amount' => $trade['margin'],
                            'credit_amount' => 0,
                            'last_updated' => $trade['close_date'],
                            'associated_with' => 'trade',
                            'associated_id' => null,
                            'notes' => 'Trade close margin debit',
                            'created_at' => $trade['close_date'],
                            'updated_at' => $trade['close_date'],
                            'deleted_at' => null
                        ];

                        if ($trade['pnl'] != 0) {
                            if ($trade['pnl'] < 0) {
                                $balanceRecords[] = [
                                    'user_id' => $userId,
                                    'debit_amount' => 0,
                                    'credit_amount' => abs($trade['pnl']),
                                    'last_updated' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'associated_with' => 'trade',
                                    'associated_id' => null,
                                    'notes' => 'Trade close PnL credit',
                                    'created_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'updated_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'deleted_at' => null
                                ];
                            } else {
                                $balanceRecords[] = [
                                    'user_id' => $userId,
                                    'debit_amount' => $trade['pnl'],
                                    'credit_amount' => 0,
                                    'last_updated' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'associated_with' => 'trade',
                                    'associated_id' => null,
                                    'notes' => 'Trade close PnL debit',
                                    'created_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'updated_at' => (new DateTime($trade['close_date']))->modify('+1 second')->format('Y-m-d H:i:s'),
                                    'deleted_at' => null
                                ];
                            }
                        }

                        if ($trade['rebate_amount'] > 0) {
                            // Prepare rebate bonus data
                            $rebateBonuses[] = [
                                'user_id' => $userId,
                                'bonus_type' => 'rebate',
                                'description' => 'Rebate for trade ' . $trade['trade_id'],
                                'bonus_amount' => $trade['rebate_amount'],
                                'created_at' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s')
                            ];

                            // Debit user's balance with rebate amount
                            $balanceRecords[] = [
                                'user_id' => $userId,
                                'debit_amount' => 0,
                                'credit_amount' => $trade['rebate_amount'],
                                'last_updated' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s'),
                                'associated_with' => 'rebate',
                                'associated_id' => null,
                                'notes' => 'Rebate bonus credit',
                                'created_at' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s'),
                                'updated_at' => (new DateTime($trade['close_date']))->modify('+2 seconds')->format('Y-m-d H:i:s'),
                                'deleted_at' => null
                            ];
                        }
                    }
                }
            }
        }

        // Batch update existing trades
        if (!empty($updateTradingData)) {
            $this->db->update_batch('trading_histories', $updateTradingData, 'trade_id');
        }

        // Batch insert new trades
        if (!empty($newTradingData)) {
            $this->db->insert_batch('trading_histories', $newTradingData);
        }

        // Combine and sort all balance records by created_at
        usort($balanceRecords, function ($a, $b) {
            return strtotime($a['created_at']) - strtotime($b['created_at']);
        });

        // Calculate previous_amount and balance_amount
        $finalBalanceRecords = [];
        foreach ($balanceRecords as $record) {
            $userId = $record['user_id'];
            if (!isset($currentBalances[$userId])) {
                $currentBalances[$userId] = $this->balanceModel->getLastBalanceAmount($userId);
            }

            $record['previous_amount'] = $currentBalances[$userId];
            if ($record['debit_amount'] > 0) {
                $currentBalances[$userId] += $record['debit_amount'];
            } else {
                $currentBalances[$userId] -= $record['credit_amount'];
            }
            $record['balance_amount'] = $currentBalances[$userId];

            $finalBalanceRecords[] = $record;
        }

        // Batch insert balance records
        if (!empty($finalBalanceRecords)) {
            $this->db->insert_batch('balances', $finalBalanceRecords);
        }

        // Batch insert rebate bonuses
        if (!empty($rebateBonuses)) {
            $this->db->insert_batch('user_bonuses', $rebateBonuses);
        }
    }



    public function getTradingSummary($userId, $startDate='', $endDate='')
    {
        if(empty($startDate)){
            $startDate='2000-01-01';
        }
        if(empty($endDate)){
            $endDate=date("Y-m-d");
        }
        return $this->db->where('user_id', $userId)
                    ->where('created_at >=', $startDate)
                    ->where('created_at <=', $endDate)
                    ->select('SUM(pnl) as total_pnl, COUNT(id) as total_trades,sum(margin) as total_margin')
                    ->get($this->table)->row();
    }

}
