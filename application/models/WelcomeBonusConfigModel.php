<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WelcomeBonusConfigModel extends CI_Model
{
    private $table='welcome_bonus_configs';
    public function getActiveConfig()
    {
        return $this->db->where('is_active', 1)
                    ->db->get($this->table)->row();
    }

    public function addWelcomeBonusConfig($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = null;
        return $this->db->insert($this->table,$data);
    }

    public function updateWelcomeBonusConfig($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$id, $data);
    }

    public function deleteWelcomeBonusConfig($id)
    {
        return $this->db->delete($this->table,$id);
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function setActiveConfig($id)
    {
        $config = $this->find($id);

        if ($config) {
            // Deactivate all other configs
            $this->set(['is_active' => 0])
                 ->update($this->table);

            // Activate the specified config
            $config->is_active = 1;
            return $this->db->where('id',$config->id)->update($this->table,$config);
        }

        return false;
    }
}
