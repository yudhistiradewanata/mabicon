<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BalanceModel extends CI_Model
{
    private $table='balances';
    public function getBalances($filter = [])
    {
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('user_id', $filter['user_id']);
        }

        if (isset($filter['user_ids']) && !empty($filter['user_ids'])) {
            $this->db->where_in('user_id', $filter['user_ids']);
        }

        if (isset($filter['start_date']) && !empty($filter['start_date'])) {
            $this->db->where('created_at >=', $filter['start_date']);
        }

        if (isset($filter['end_date']) && !empty($filter['end_date'])) {
            $this->db->where('created_at <=', $filter['end_date']);
        }

        return $this->db->get($this->table)->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    
    public function insertCredit($user_id, $amount, $associated_with,$associated_id,$notes='')
    {
        $lastBalance = $this->getLastBalanceAmount($user_id);
        $data = [
            'user_id' => $user_id,
            'previous_amount' => $lastBalance,
            'debit_amount' => 0,
            'credit_amount' => $amount,
            'balance_amount' => $lastBalance - $amount,
            'last_updated' => date('Y-m-d H:i:s'),
            'associated_with'=>$associated_with,
            'associated_id'=>$associated_id,
            'notes' => $notes,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }

    public function insertDebit($user_id, $amount, $associated_with,$associated_id,$notes='')
    {
        $lastBalance = $this->getLastBalanceAmount($user_id);
        $data = [
            'user_id' => $user_id,
            'previous_amount' => $lastBalance,
            'debit_amount' => $amount,
            'credit_amount' => 0,
            'balance_amount' => $lastBalance + $amount,
            'last_updated' => date('Y-m-d H:i:s'),
            'associated_with'=>$associated_with,
            'associated_id'=>$associated_id,
            'notes' => $notes,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }

    public function getLastBalanceAmount($user_id)
    {
        $this->db->select('SUM(debit_amount) - SUM(credit_amount) AS balance_amount');
        $this->db->where('user_id', $user_id);
        $this->db->group_by('user_id');

        $result = $this->db->get($this->table)->row();

        return $result ? $result->balance_amount : 0;
    }

    public function getUserBalances($user_ids)
    {
        $this->db->select('user_id, SUM(debit_amount) - SUM(credit_amount) AS balance_amount');
        $this->db->where_in('user_id', $user_ids);
        $this->db->group_by('user_id');

        $results = $this->db->get($this->table)->result();

        $balances = [];
        foreach ($results as $result) {
            $balances[$result->user_id] = $result->balance_amount;
        }

        return $balances;
    }

    public function getBalanceSummary($userId, $startDate='', $endDate='')
    {
        if(empty($startDate)){
            $startDate='2000-01-01';
        }
        if(empty($endDate)){
            $endDate=date("Y-m-d");
        }
        return $this->db->where('user_id', $userId)
                    ->where('date(created_at) >=', $startDate)
                    ->where('date(created_at) <=', $endDate)
                    ->select('SUM(debit_amount) - SUM(credit_amount) as total_balance')
                    ->get($this->table)->row();
    }
}
