<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class withdrawalRequestModel extends CI_Model
{
    private $table='withdrawal_requests';
    public function getWithdrawalRequests($filter = [])
    {
        if (isset($filter['username']) && !empty($filter['username'])) {
            $this->db->like('u.username', $filter['username']);
        }
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('w.user_id', $filter['user_id']);
        }

        if (isset($filter['user_ids']) && !empty($filter['user_ids'])) {
            $this->db->where_in('w.user_id', $filter['user_ids']);
        }

        if (isset($filter['status']) && !empty($filter['status'])) {
            $this->db->where('w.status', $filter['status']);
        }

        if (isset($filter['start_date']) && !empty($filter['start_date'])) {
            $this->db->where('date(w.created_at) >=', $filter['start_date']);
        }

        if (isset($filter['end_date']) && !empty($filter['end_date'])) {
            $this->db->where('date(w.created_at) <=', $filter['end_date']);
        }

        return $this->db->select('w.*,u.username')->from($this->table.' w')->join('users u','w.user_id=u.id')->get()->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function insertWithdrawalRequest($data)
    {
        // Extract data from the array
        $user_id = $data['user_id'];
        $withdrawal_amount = $data['withdrawal_amount'];
        $otp = $data['otp_sent_to_email'];
        $usdt_address = $data['usdt_address'];
        $status = isset($data['status']) ? $data['status'] : 'pending';
        $reviewed_by_admin_id = isset($data['reviewed_by_admin_id']) ? $data['reviewed_by_admin_id'] : null;

        // Prepare data for insertion
        $insertData = [
            'user_id' => $user_id,
            'withdrawal_amount' => $withdrawal_amount,
            'otp_sent_to_email' => $otp,
            'usdt_address' => $usdt_address,
            'status' => $status,
            'reviewed_by_admin_id' => $reviewed_by_admin_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        $this->db->insert($this->table, $insertData);
        $new_id=$this->db->insert_id();
        // Credit the user's balance and create a withdrawal transaction
        $this->balanceModel->insertCredit($user_id, $withdrawal_amount, 'withdrawal_requests',$new_id,'Withdrawal Request of '.$withdrawal_amount);
        $this->transactionModel->insertWithdrawal($user_id, $withdrawal_amount, 'Withdrawal request created');
        return $new_id;
    }

    public function approveWithdrawalRequest($request_id, $admin_id)
    {
        $withdrawalRequest = $this->find($request_id);

        if ($withdrawalRequest) {
            // Update withdrawal request status
            $withdrawalRequest['status'] = 'approved';
            $withdrawalRequest['reviewed_by_admin_id'] = $admin_id;
            $withdrawalRequest['updated_at'] = date('Y-m-d H:i:s');

            return $this->db->where('id',$withdrawalRequest->id)->update($this->table,$withdrawalRequest);
        }

        return false;
    }

    public function rejectWithdrawalRequest($request_id, $admin_id)
    {
        $withdrawalRequest = $this->find($request_id);

        if ($withdrawalRequest) {
            
            // Refund the user's balance and create a reversal transaction
            $this->balanceModel->insertDebit($withdrawalRequest['user_id'], $withdrawalRequest['withdrawal_amount'], 'withdrawal_requests',$request_id,'Rejected Withdrawal Request of '.$withdrawalRequest->withdrawal_amount);
            $this->transactionModel->insertWithdrawal($withdrawalRequest['user_id'], -$withdrawalRequest['withdrawal_amount'], 'Withdrawal request rejected');

            // Update withdrawal request status
            $withdrawalRequest['status'] = 'rejected';
            $withdrawalRequest['reviewed_by_admin_id'] = $admin_id;
            $withdrawalRequest['updated_at'] = date('Y-m-d H:i:s');

            return $this->db->where('id',$withdrawalRequest->id)->update($this->table,$withdrawalRequest);
        }

        return false;
    }

    public function cancelWithdrawalRequest($request_id)
    {
        $withdrawalRequest = $this->find($request_id);

        if ($withdrawalRequest && $withdrawalRequest['status'] == 'pending') {
            
            // Refund the user's balance and create a reversal transaction
            $this->balanceModel->insertDebit($withdrawalRequest['user_id'], $withdrawalRequest['withdrawal_amount'], 'withdrawal_requests',$request_id,'Canceled Withdrawal Request of '.$withdrawalRequest->withdrawal_amount);
            $this->transactionModel->insertWithdrawal($withdrawalRequest['user_id'], -$withdrawalRequest['withdrawal_amount'], 'Withdrawal request canceled');

            // Update withdrawal request status
            $withdrawalRequest['status'] = 'canceled';
            $withdrawalRequest['updated_at'] = date('Y-m-d H:i:s');

            return $this->db->where('id',$withdrawalRequest->id)->update($this->table,$withdrawalRequest);
        }

        return false;
    }
}
