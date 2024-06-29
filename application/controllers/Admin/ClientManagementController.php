<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientManagementController extends MY_Controller
{
    public function index()
    {
        $filters = [
            'username' => $this->input->get('username'),
            'email' => $this->input->get('email'),
            'referral_username' => $this->input->get('referral_username'),
            'created_by' => $this->input->get('created_by'),
            'current_tier_id' => $this->input->get('current_tier_id'),
            'user_id' => $this->input->get('user_id'),
            'user_ids' => $this->input->get('user_ids'),
            'join_date_from'=>$this->input->get('join_date_from'),
            'join_date_to'=>$this->input->get('join_date_to'),
        ];

        $users = $this->userModel->getUsers(array_filter($filters));

        foreach ($users as $user) {
            $user->current_balance = $this->db->where('user_id', $user->id)->select('ifnull(sum(debit_amount-credit_amount),0) as amount')->get('balances')->row()->amount;
            $user->has_pending_deposit = $this->db->where('user_id', $user->id)->where('status', 'pending')->count_all_results('top_up_requests') > 0;
            $user->has_pending_withdrawal = $this->db->where('user_id', $user->id)->where('status', 'pending')->count_all_results('withdrawal_requests') > 0;
        }

        $data = [
            'users' => $users,
        ];

        $content = $this->load->view('admin/client_management/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Client Management']);
    }

    public function view($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');redirect('admin/client_management');
        }

        $balances = $this->balanceModel->where('user_id', $id)->get()->result();
        $pendingDeposits = $this->topUpRequestModel->where('user_id', $id)->where('status', 'pending')->get()->result();
        $pendingWithdrawals = $this->withdrawalRequestModel->where('user_id', $id)->where('status', 'pending')->get()->result();
        $tradingHistories = $this->tradingHistoryModel->where('user_id', $id)->get()->result();
        $bonuses = $this->userBonusModel->where('user_id', $id)->get()->result();

        $data = [
            'user' => $user,
            'balances' => $balances,
            'pendingDeposits' => $pendingDeposits,
            'pendingWithdrawals' => $pendingWithdrawals,
            'tradingHistories' => $tradingHistories,
            'bonuses' => $bonuses
        ];

        $content = $this->load->view('admin/client_management/view', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'View User']);
    }

    public function pending()
    {
        $pendingUsers = $this->userModel->where('status', 'pending')->get()->result();

        $data = [
            'pendingUsers' => $pendingUsers
        ];

        $content = $this->load->view('admin/client_management/pending', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Pending Users']);
    }

    public function approve($id)
    {
        $user = $this->userModel->find($id);
        if ($user && $user->status == 'pending') {
            $user->status = 'approved';
            $this->db->where('id',$user->id)->update('users',$user);
            $this->session->set_flashdata('success', 'User approved successfully.');redirect('admin/client_management/pending');
        } else {
            $this->session->set_flashdata('error', 'User not found or not pending.');redirect('admin/client_management/pending');
        }
    }

    public function reject($id)
    {
        $user = $this->userModel->find($id);
        if ($user && $user->status == 'pending') {
            $user->status = 'rejected';
            $this->db->where('id',$user->id)->update('users',$user);
            $this->session->set_flashdata('success', 'User rejected successfully.');redirect('admin/client_management/pending');
        } else {
            $this->session->set_flashdata('error', 'User not found or not pending.');redirect('admin/client_management/pending');
        }
    }
}
