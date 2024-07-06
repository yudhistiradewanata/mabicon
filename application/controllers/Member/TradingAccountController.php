<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TradingAccountController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $userId = $this->session->userdata('user_id');
        $filters = ['user_id' => $userId];
        $tradingAccounts = $this->tradingAccountModel->getTradingAccounts($filters);

        $data = [
            'tradingAccounts' => $tradingAccounts
        ];

        $content = $this->load->view('member/tradingaccount/index', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Trading Accounts']);
    }

    public function create()
    {
        $userId = $this->session->userdata('user_id');
        $data = [
            'user_id' => $userId,
            'account_id' => $this->input->post('account_id') ?: null,
            'requested_at' => date('Y-m-d H:i:s'),
            'status' => 'pending'
        ];

        if ($this->tradingAccountModel->store($data)) {
            $this->session->set_flashdata('success', 'Trading account request submitted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to submit trading account request.');
        }
        redirect('member/tradingaccount');
    }
}
