<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserBonusModel extends CI_Model
{
    private $table='user_bonuses';
    public function getBonuses($filter = [])
    {
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('user_id', $filter['user_id']);
        }

        if (isset($filter['start_date']) && !empty($filter['start_date'])) {
            $this->db->where('created_at >=', $filter['start_date']);
        }

        if (isset($filter['end_date']) && !empty($filter['end_date'])) {
            $this->db->where('created_at <=', $filter['end_date']);
        }

        return $this->db->get($this->table)->result();
    }
    public function getBonusSummary($userId, $startDate, $endDate)
    {
        return $this->db->where('user_id', $userId)
                    ->where('created_at >=', $startDate)
                    ->where('created_at <=', $endDate)
                    ->select('SUM(bonus_amount) as total_bonus')
                    ->get($this->table)->row();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
}
