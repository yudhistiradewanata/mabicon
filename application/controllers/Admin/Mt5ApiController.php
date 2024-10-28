<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mt5ApiController extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("mt5model");
        $this->_authid='1059';
    }
    public function user()
    {
        $users=$this->db->select('u.id,u.username,u.full_name,k.id_number kyc_id_number,k.created_at kyc_created_at')->where('mt5_login is null')->join('kyc k','u.id=k.user_id')->where('k.status','approved')->get('users u')->result();
        $data = [
            'users' => $users
        ];
        $content = $this->load->view('admin/mt5_api/user', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'MT 5 API - Pending User Creation']);
    }
    public function account()
    {
        $accounts=$this->db->select('t.id,u.full_name,k.id_number kyc_id_number,u.username,t.created_at')->where('mt5_login is null')->join('users u','t.user_id=u.id')->join('kyc k','u.id=k.user_id')->where('k.status','approved')->get('trading_accounts t')->result();
        
        $data = [
            'accounts' => $accounts
        ];
        $content = $this->load->view('admin/mt5_api/account', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'MT 5 API - Pending Account Creation']);
    }
    public function sendUser(){
        $post=$this->input->post();
        redirect("admin/mt5-api/user");
    }
    public function sendAccount(){
        $post=$this->input->post();
        
        $account=$this->db->select('t.id,t.id as account_name,k.id_number kyc_id_number,u.email,u.username')->where('mt5_login is null')->join('users u','t.user_id=u.id')->join('kyc k','u.id=k.user_id')->where('k.status','approved')->where('t.id',$post['send_id'])->get('trading_accounts t')->row();
        if($account==null){
            $this->session->set_flashdata('error', 'User not found / User KYC not done yet / Account has already been registered');
            redirect("admin/mt5-api/account");
        }
        $authdata=$this->mt5model->createUser($this->_authid,$account);
        // pre($authdata);
        if($authdata!=false && is_array($authdata)){
            $emailConfig=$this->config->item('email');
            $this->email->initialize($emailConfig);
            $this->email->from($emailConfig['smtp_user'], 'Mabicon');
            $this->email->to($account->email);
            $this->email->subject('Trading Account Request Approved');
            $this->email->message('Dear '.$account->username.',<br><br>Your Trading Account Request have been approved.<br>Login ID: ' . $authdata['login']."<br>Main Password: ".$authdata['mt5_passmain']."<br><br>Investor Password: ".$authdata['mt5_passinvestor']."<br><br>DO NOT SHARE THIS CREDENTIAL WITH ANYONE ELSE!");
            $this->email->send(false);    
            $this->session->set_flashdata('success', 'Account successfully created on MT5.');
        }
        else{
            $this->session->set_flashdata('error', 'Failed to Create Account on MT5.');
            // exit;
        }

        
        redirect("admin/mt5-api/account");

    }
}
