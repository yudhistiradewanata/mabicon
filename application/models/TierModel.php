<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TierModel extends CI_Model
{
    private $table='tiers';
    public function getTiers($filter = [])
    {
        if (isset($filter['name']) && !empty($filter['name'])) {
            $this->db->where('name', $filter['name']);
        }

        if (isset($filter['min_deposit']) && !empty($filter['min_deposit'])) {
            $this->db->where('min_deposit >=', $filter['min_deposit']);
        }

        if (isset($filter['min_trading_volume']) && !empty($filter['min_trading_volume'])) {
            $this->db->where('min_trading_volume >=', $filter['min_trading_volume']);
        }

        return $this->db->get($this->table)->result();
    }

    public function addTier($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = null;
        return $this->db->insert($this->table,$data);
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function updateTier($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$id, $data);
    }

    public function deleteTier($id)
    {
        return $this->db->delete($this->table,$id);
    }
}
