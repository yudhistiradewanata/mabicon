<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionManagementController extends MY_Controller
{
    public function pending(){
        $this->index('pending');
    }
    public function index($status='')
    {
        $filters = [
            'username' => $this->input->get('username'),
            'transaction_type' => $this->input->get('transaction_type'),
            'start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date'),
            'status' => $this->input->get('status'),
        ];
        if(!empty($status)){
            $filters['status']=$status;
        }
        $topUpRequests = $this->topUpRequestModel->getTopUpRequests($filters);
        $withdrawalRequests = $this->withdrawalRequestModel->getWithdrawalRequests(array_filter($filters));

        $data = [
            'topUpRequests' => $topUpRequests,
            'withdrawalRequests' => $withdrawalRequests,
            'filters' => $filters
        ];

        $content = $this->load->view('admin/transaction_management/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Transaction Management']);
    }
    public function pendingTransferWithdrawal()
    {
        $filters = [
            'username' => $this->input->get('username'),
            'start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date'),
            'status' => 'approved',
        ];
        if(!empty($status)){
            $filters['status']=$status;
        }
        $withdrawalRequests = $this->withdrawalRequestModel->getWithdrawalRequests(array_filter($filters));

        $data = [
            'withdrawalRequests' => $withdrawalRequests,
            'filters' => $filters
        ];

        $content = $this->load->view('admin/transaction_management/pending-transfer-withdrawal', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Transaction Management']);
    }

    public function approveTopUp()
    {
        $id=$this->input->post('id');
        $topUpRequest = $this->topUpRequestModel->find($id);

        if ($topUpRequest && $topUpRequest->status == 'pending') {
            // Debit the user's balance
            $this->balanceModel->insertDebit($topUpRequest->user_id, $topUpRequest->account_id, $topUpRequest->topup_amount, 'top_up_requests', $topUpRequest->id, 'Top-up approved of '.$topUpRequest->topup_amount);

            $topUpRequest->status = 'approved';
            $this->db->where('id', $topUpRequest->id)->update('top_up_requests', $topUpRequest);
            $this->session->set_flashdata('success', 'Top-up request approved successfully.');
            redirect('admin/transaction-management/pending');
        } else {
            $this->session->set_flashdata('error', 'Top-up request not found or not pending.');
            redirect('admin/transaction-management/pending');
        }
    }

    public function rejectTopUp()
    {
        $id=$this->input->post('id');
        $topUpRequest = $this->topUpRequestModel->find($id);

        if ($topUpRequest && $topUpRequest->status == 'pending') {
            $topUpRequest->status = 'rejected';
            $this->db->where('id', $topUpRequest->id)->update('top_up_requests', $topUpRequest);
            $this->session->set_flashdata('success', 'Top-up request rejected successfully.');
            redirect('admin/transaction-management/pending');
        } else {
            $this->session->set_flashdata('error', 'Top-up request not found or not pending.');
            redirect('admin/transaction-management/pending');
        }
    }

    public function approveWithdrawal()
    {
        $id=$this->input->post('id');
        $withdrawalRequest = $this->withdrawalRequestModel->find($id);

        if ($withdrawalRequest && $withdrawalRequest->status == 'pending') {
            $withdrawalRequest->status = 'approved';
            $this->db->where('id', $withdrawalRequest->id)->update('withdrawal_requests', $withdrawalRequest);
            $this->session->set_flashdata('success', 'Withdrawal request approved successfully.');
            redirect('admin/transaction-management/pending');
        } else {
            $this->session->set_flashdata('error', 'Withdrawal request not found or not pending.');
            redirect('admin/transaction-management/pending');
        }
    }
    public function transferWithdrawal()
    {
        $id=$this->input->post('id');
        $withdrawalRequest = $this->withdrawalRequestModel->find($id);

        if ($withdrawalRequest && $withdrawalRequest->status == 'approved') {
            $withdrawalRequest->status = 'transfered';
            $this->db->where('id', $withdrawalRequest->id)->update('withdrawal_requests', $withdrawalRequest);
            $this->session->set_flashdata('success', 'Withdrawal request approved successfully.');
            redirect('admin/transaction-management/pendingTransferWithdrawal');
        } else {
            $this->session->set_flashdata('error', 'Withdrawal request not found or not pending.');
            redirect('admin/transaction-management/pendingTransferWithdrawal');
        }
    }

    public function rejectWithdrawal()
    {
        $id=$this->input->post('id');
        $withdrawalRequest = $this->withdrawalRequestModel->find($id);

        if ($withdrawalRequest && $withdrawalRequest->status == 'pending') {
            // Debit the user's balance back
            $this->balanceModel->insertDebit($withdrawalRequest->user_id, $withdrawalRequest->account_id, $withdrawalRequest->withdrawal_amount, 'withdrawal_requests', $withdrawalRequest->id, 'Withdrawal rejected of '.$withdrawalRequest->withdrawal_amount);

            $withdrawalRequest->status = 'rejected';
            $this->db->where('id', $withdrawalRequest->id)->update('withdrawal_requests', $withdrawalRequest);
            $this->session->set_flashdata('success', 'Withdrawal request rejected successfully.');
            redirect('admin/transaction-management/pending');
        } else {
            $this->session->set_flashdata('error', 'Withdrawal request not found or not pending.');
            redirect('admin/transaction-management/pending');
        }
    }
}
