<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionModel extends CI_Model
{
    private $table='transactions';
    public function getTransactions($filter = [])
    {
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('user_id', $filter['user_id']);
        }
        if (isset($filter['account_id']) && !empty($filter['account_id'])) {
            $this->db->where('account_id', $filter['account_id']);
        }
        if (isset($filter['user_ids']) && !empty($filter['user_ids'])) {
            $this->db->where_in('user_id', $filter['user_ids']);
        }

        if (isset($filter['start_date']) && !empty($filter['start_date'])) {
            $this->db->where('transaction_date >=', $filter['start_date']);
        }

        if (isset($filter['end_date']) && !empty($filter['end_date'])) {
            $this->db->where('transaction_date <=', $filter['end_date']);
        }

        if (isset($filter['transaction_type']) && !empty($filter['transaction_type'])) {
            $this->db->where('transaction_type', $filter['transaction_type']);
        }

        if (isset($filter['transaction_types']) && !empty($filter['transaction_types'])) {
            $this->db->where_in('transaction_type', $filter['transaction_types']);
        }

        return $this->db->get($this->table)->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function insertDeposit($user_id, $account_id, $amount, $description = '')
    {
        $data = [
            'user_id' => $user_id,
            'account_id' => $account_id,
            'transaction_type' => 'deposit',
            'amount' => $amount,
            'transaction_date' => date('Y-m-d H:i:s'),
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }

    public function insertWithdrawal($user_id, $account_id, $amount, $description = '')
    {
        $data = [
            'user_id' => $user_id,
            'account_id' => $account_id,
            'transaction_type' => 'withdrawal',
            'amount' => $amount,
            'transaction_date' => date('Y-m-d H:i:s'),
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }

    public function insertTrade($user_id, $account_id, $amount, $description = '')
    {
        $data = [
            'user_id' => $user_id,
            'account_id' => $account_id,
            'transaction_type' => 'trade',
            'amount' => $amount,
            'transaction_date' => date('Y-m-d H:i:s'),
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }
    public function getTransactionSummary($userId, $startDate, $endDate)
    {
        $pending_withdrawal=$this->db->select("sum(withdrawal_amount) pending_withdrawal")->where('user_id', $userId)->where('status','pending')->get('withdrawal_requests')->row()->pending_withdrawal;
        $total_withdrawal=$this->db->select("sum(withdrawal_amount) total_withdrawal")->where('user_id', $userId)->where_in('status',['approved','transfered'])->get('withdrawal_requests')->row()->total_withdrawal;
        $pending_deposit=$this->db->select("sum(topup_amount) pending_deposit")->where('user_id', $userId)->where('status','pending')->get('top_up_requests')->row()->pending_deposit;
        $total_deposit=$this->db->select("sum(topup_amount) total_deposit")->where('user_id', $userId)->where('status','approved')->get('top_up_requests')->row()->total_deposit;

        return (object)[
            'pending_withdrawal'=>$pending_withdrawal,
            'total_withdrawal'=>$total_withdrawal,
            'pending_deposit'=>$pending_deposit,
            'total_deposit'=>$total_deposit
        ];
    }

}
