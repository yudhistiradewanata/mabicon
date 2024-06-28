<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TurnoverBonusConfigModel extends CI_Model
{
    private $table='turnover_bonus_configs';
    public function getActiveConfigs()
    {
        return $this->db->where('is_active', 1)->get($this->table)->result();
    }

    public function addTurnoverBonusConfig($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = null;
        return $this->db->insert($this->table,$data);
    }

    public function updateTurnoverBonusConfig($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$id, $data);
    }

    public function deleteTurnoverBonusConfig($id)
    {
        return $this->db->delete($this->table,$id);
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
}
