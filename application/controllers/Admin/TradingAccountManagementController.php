<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TradingAccountManagementController extends MY_Controller
{
    public function index()
    {
        $pendingAccounts = $this->tradingAccountModel->getTradingAccounts(['status' => 'pending']);

        $data = [
            'pendingAccounts' => $pendingAccounts
        ];

        $content = $this->load->view('admin/tradingaccount_management/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Trading Account Management']);
    }

    public function approve()
    {
        $id = $this->input->post('id');
        $account_id = $this->input->post('account_id');
        $password = $this->input->post('password');

        if ($this->tradingAccountModel->approve($id, $account_id,$password)) {
            $emailConfig=$this->config->item('email');
            $this->email->initialize($emailConfig);
            $user = $this->db->select('u.email')->where('ta.id',$id)->from('users u')->join('trading_accounts ta','u.id=ta.user_id')->get()->row();
            $this->email->from($emailConfig['smtp_user'], 'Mabicon');
            $this->email->to($user->email);
            $this->email->subject('Trading Account Request Approved');
            $this->email->message('Your Trading Account Request have been approved.<br>Login ID: ' . $account_id."<br>Login Password: ".$password."<br><br>DO NOT SHARE THIS CREDENTIAL WITH ANYONE ELSE!");
            $this->email->send(false);

            $this->session->set_flashdata('success', 'Trading account approved successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to approve trading account.');
        }
        redirect('admin/trading-account-management');
    }

    public function reject()
    {
        $id = $this->input->post('id');
        if ($this->tradingAccountModel->reject($id)) {
            $this->session->set_flashdata('success', 'Trading account rejected successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to reject trading account.');
        }
        redirect('admin/trading-account-management');
    }
}
