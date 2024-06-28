<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RebateBonusConfigModel extends CI_Model
{
    private $table='rebate_bonus_configs';
    public function getActiveConfigByTier($tier_id)
    {
        return $this->db->where('tier_id', $tier_id)
                    ->where('is_active', 1)
                    ->get($this->table)->row();
    }

    public function addRebateBonusConfig($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = null;
        return $this->db->insert($this->table,$data);
    }

    public function updateRebateBonusConfig($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$id, $data);
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function deleteRebateBonusConfig($id)
    {
        return $this->db->delete($this->table,$id);
    }

    public function setActiveConfig($id)
    {
        $config = $this->find($id);

        if ($config) {
            // Deactivate all other configs for the same tier
            $this->db->where('tier_id', $config->tier_id)
                 ->set(['is_active' => 0])
                 ->update($this->table);

            // Activate the specified config
            $config->is_active = 1;
            return $this->db->where('id',$config->id)->update($this->table,$config);
        }

        return false;
    }
}
