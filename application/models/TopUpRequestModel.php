<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TopUpRequestModel extends CI_Model
{
    private $table='top_up_requests';
    public function getTopUpRequests($filter = [])
    {
        if (isset($filter['username']) && !empty($filter['username'])) {
            $this->db->like('u.username', $filter['username']);
        }
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('t.user_id', $filter['user_id']);
        }
        if (isset($filter['account_id']) && !empty($filter['account_id'])) {
            $this->db->where('t.account_id', $filter['account_id']);
        }
        if (isset($filter['search']) && !empty($filter['search'])) {
            $this->db->group_start()->like('u.username', $filter['search'])->or_like('t.account_id',$filter['search'])->group_end();
        }
        
        if (isset($filter['user_ids']) && !empty($filter['user_ids'])) {
            $this->db->where_in('t.user_id', $filter['user_ids']);
        }
        if (isset($filter['status']) && !empty($filter['status'])) {
            $this->db->where('t.status', $filter['status']);
        }
        if (isset($filter['start_date']) && !empty($filter['start_date'])) {
            $this->db->where('date(t.topup_date) >=', $filter['start_date']);
        }
        if (isset($filter['end_date']) && !empty($filter['end_date'])) {
            $this->db->where('date(t.topup_date) <=', $filter['end_date']);
        }

        return $this->db->select('t.*, u.username, ta.account_id')
                        ->from($this->table.' t')
                        ->join('users u', 't.user_id = u.id')
                        ->join('trading_accounts ta', 't.account_id = ta.account_id', 'left')
                        ->get()
                        ->result();
    }

    public function find($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insertTopUpRequest($user_id, $account_id, $amount, $proof_file, $destination, $status = 'pending', $reviewed_by_admin_id = null)
    {
        $data = [
            'user_id' => $user_id,
            'account_id' => $account_id,
            'topup_amount' => $amount,
            'topup_date' => date('Y-m-d H:i:s'),
            'transfer_proof_file' => $proof_file,
            'transfer_destination' => $destination,
            'status' => $status,
            'reviewed_by_admin_id' => $reviewed_by_admin_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table, $data);
    }

    public function approveTopUpRequest($request_id, $admin_id)
    {
        $topUpRequest = $this->find($request_id);

        if ($topUpRequest) {
            
            // Update balance
            $this->balanceModel->insertDebit($topUpRequest['user_id'], $topUpRequest['account_id'], $topUpRequest['topup_amount'], 'top_up_requests',$request_id,'Approved Deposit of '.$topUpRequest->topup_amount);

            // Create deposit transaction
            $this->transactionModel->insertDeposit($topUpRequest['user_id'], $topUpRequest['account_id'], $topUpRequest['topup_amount'], 'Top-up approved');

            // Update top-up request status
            $topUpRequest['status'] = 'approved';
            $topUpRequest['reviewed_by_admin_id'] = $admin_id;
            $topUpRequest['updated_at'] = date('Y-m-d H:i:s');

            return $this->db->where('id',$topUpRequest->id)->update($this->table,$topUpRequest);
        }

        return false;
    }

    public function rejectTopUpRequest($request_id, $admin_id)
    {
        $topUpRequest = $this->find($request_id);

        if ($topUpRequest) {
            // Update top-up request status
            $topUpRequest['status'] = 'rejected';
            $topUpRequest['reviewed_by_admin_id'] = $admin_id;
            $topUpRequest['updated_at'] = date('Y-m-d H:i:s');

            return $this->db->where('id',$topUpRequest->id)->update($this->table,$topUpRequest);
        }

        return false;
    }

    public function cancelTopUpRequest($request_id)
    {
        $topUpRequest = $this->find($request_id);

        if ($topUpRequest && $topUpRequest['status'] == 'pending') {
            $topUpRequest['status'] = 'canceled';
            $topUpRequest['updated_at'] = date('Y-m-d H:i:s');

            return $this->db->where('id',$topUpRequest->id)->update($this->table,$topUpRequest);
        }

        return false;
    }
}
