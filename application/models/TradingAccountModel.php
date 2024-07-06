<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TradingAccountModel extends CI_Model
{
    private $table = 'trading_accounts';

    public function getTradingAccounts($filter = [])
    {
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('ta.user_id', $filter['user_id']);
        }
        if (isset($filter['status']) && !empty($filter['status'])) {
            $this->db->where('ta.status', $filter['status']);
        }

        return $this->db->select('ta.*, u.username')
                        ->from($this->table . ' ta')
                        ->join('users u', 'ta.user_id = u.id')
                        ->get()
                        ->result();
    }

    public function store($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function approve($id, $account_id)
    {
        $data = [
            'status' => 'approved',
            'account_id' => $account_id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function reject($id)
    {
        $data = [
            'status' => 'rejected',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->where('id', $id)->update($this->table, $data);
    }
}
