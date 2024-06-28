<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller
{
    public function index()
    {
        // echo "A";exit;
        // User Statistics
        $totalUsers = $this->db->count_all('users');
        $date7DaysAgo = (new DateTime())->modify('-7 days')->format('Y-m-d');
        $date30DaysAgo = (new DateTime())->modify('-30 days')->format('Y-m-d');

        // Get new users count
        $newUsersLast7Days = $this->db->where('date(created_at) >=', $date7DaysAgo)->count_all_results('users');
        $newUsersLast30Days = $this->db->where('date(created_at) >=', $date30DaysAgo)->count_all_results('users');
        $activeUsers = $this->db->where('status', 'active')->count_all_results('users');

        // Financial Summary
        $totalDeposits = $this->db->where('status', 'approved')->select_sum('topup_amount')->get('top_up_requests')->row()->topup_amount;
        $totalPendingDeposits = $this->db->where('status', 'pending')->select_sum('topup_amount')->get('top_up_requests')->row()->topup_amount;
        $totalWithdrawals = $this->db->where('status', 'approved')->select_sum('withdrawal_amount')->get('withdrawal_requests')->row()->withdrawal_amount;
        $totalPendingWithdrawals = $this->db->where('status', 'pending')->select_sum('withdrawal_amount')->get('withdrawal_requests')->row()->withdrawal_amount;
        $totalTradingVolume = $this->db->select_sum('margin')->get('trading_histories')->row()->margin;
        $totalPnl = $this->db->select_sum('pnl')->get('trading_histories')->row()->pnl;
        $totalOpenTrade = $this->db->where('trade_status','open')->select_sum('margin')->get('trading_histories')->row()->margin;
        $currentBalancesOverview = $this->db->select('sum(debit_amount)-sum(credit_amount) as amount')->get('balances')->row()->amount;

        // Support Tickets
        $openSupportTickets = $this->db->where('status', 'open')->count_all_results('support_tickets');
        $recentSupportTickets = $this->db->order_by('created_at', 'DESC')->limit(5)->get('support_tickets')->result();

        // Trading Activity
        $recentTrades = $this->db->order_by('trade_date', 'DESC')->limit(5)->get('trading_histories')->result();
        $tradingVolumePerAsset = $this->db->select('asset, SUM(margin) as total_volume')->group_by('asset')->get('trading_histories')->result();

        // Bonuses and Promotions
        $totalBonusesDistributed = $this->db->select_sum('bonus_amount')->get('user_bonuses')->row()->bonus_amount;

        $data = [
            'totalUsers' => $newUsersLast7Days ?: 0,
            'newUsersLast7Days' => $newUsersLast7Days ?: 0,
            'newUsersLast30Days' => $newUsersLast30Days ?: 0,
            'activeUsers' => $activeUsers ?: 0,
            'totalDeposits' => $totalDeposits ?: 0,
            'totalPendingDeposits' => $totalPendingDeposits ?: 0,
            'totalWithdrawals' => $totalWithdrawals ?: 0,
            'totalPendingWithdrawals' => $totalPendingWithdrawals ?: 0,
            'totalTradingVolume' => $totalTradingVolume ?: 0,
            'currentBalancesOverview' => $currentBalancesOverview ?: 0,
            'openSupportTickets' => $openSupportTickets ?: 0,
            'recentSupportTickets' => $recentSupportTickets ?: [],
            'recentTrades' => $recentTrades ?: [],
            'tradingVolumePerAsset' => $tradingVolumePerAsset ?: [],
            'totalBonusesDistributed' => $totalBonusesDistributed ?: 0,
            'totalOpenTrade' => $totalOpenTrade ?: 0,
            'totalPnl' => $totalPnl ?: 0,
        ];

        $content = $this->load->view('admin/dashboard/index2', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Admin Dashboard']);
    }
}
