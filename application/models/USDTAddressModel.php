<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class USDTAddressModel extends CI_Model
{
    private $table='usdt_addresses';
    public function getUSDTAddresses($filter = [])
    {
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('user_id', $filter['user_id']);
        }

        if (isset($filter['is_default']) && !empty($filter['is_default'])) {
            $this->db->where('is_default', $filter['is_default']);
        }

        if (isset($filter['is_broker_address']) && !empty($filter['is_broker_address'])) {
            $this->db->where('is_broker_address', $filter['is_broker_address']);
        }

        return $this->db->get($this->table)->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function addUSDTAddress($user_id, $title, $usdt_address, $is_default = false, $is_broker_address = false)
    {
        // If this is to be the default address, unset previous defaults
        if ($is_default) {
            $this->db->where('user_id', $user_id)
                 ->set(['is_default' => false])
                 ->update($this->table);
        }

        $data = [
            'user_id' => $user_id,
            'usdt_address' => $usdt_address,
            'title'=>$title,
            'is_default' => $is_default,
            // 'is_broker_address' => $is_broker_address,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }

    public function setDefaultAddress($address_id, $user_id)
    {
        // Unset previous default addresses
        $this->db->where('user_id', $user_id)
             ->set(['is_default' => false])
             ->update($this->table);

        // Set the new default address
        $this->db->where('id', $address_id)
             ->set(['is_default' => true])
             ->update($this->table);
    }
}
