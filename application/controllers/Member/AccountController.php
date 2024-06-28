<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountController extends MY_Controller
{
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's transaction history
        $transactions = $this->db->where('user_id', $userId)->order_by('transaction_date', 'DESC')->get('transactions')->result();

        // Get user's balances
        $balances = $this->db->where('user_id', $userId)->get('balances')->result();
        $balanceSummary = $this->balanceModel->getBalanceSummary($userId);

        $data = [
            'transactions' => $transactions,
            'balances' => $balances,
            'balanceSummary'=>$balanceSummary
        ];

        $content = $this->load->view('member/account/index', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Account Overview']);
    }

    public function statement()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's transaction history
        $transactions = $this->db->where('user_id', $userId)->order_by('transaction_date', 'DESC')->get('transactions')->result();

        $data = [
            'transactions' => $transactions
        ];

        $content = $this->load->view('member/account/statement', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Account Statement']);
    }

    public function performanceReport()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's transactions and balances for performance report
        $transactions = $this->db->where('user_id', $userId)->order_by('transaction_date', 'DESC')->get('transactions')->result();
        $balances = $this->db->where('user_id', $userId)->get('balances')->result();

        $data = [
            'transactions' => $transactions,
            'balances' => $balances
        ];

        $content = $this->load->view('member/account/performance_report', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Performance Report']);
    }
}
