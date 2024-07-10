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
            'account_id' => null,
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
    public function verifyPassword()
    {
        $user_id = $this->session->userdata('user_id');
        $account_id = $this->input->post('account_id');
        $user_password = $this->input->post('user_password');

        $user = $this->userModel->find($user_id);

        if (password_verify($user_password, $user->password_hash)) {
            $tradingAccount = $this->tradingAccountModel->find($account_id);

            if ($tradingAccount && $tradingAccount->user_id == $user_id) {
                echo json_encode(['status' => 'success', 'trading_account_password' => $tradingAccount->password]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid trading account.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid user password.']);
        }
    }
}
