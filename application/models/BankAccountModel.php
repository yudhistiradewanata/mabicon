<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BankAccountModel extends CI_Model
{
    private $table='bank_accounts';
    public function getBankAccounts($filter = [])
    {
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('user_id', $filter['user_id']);
        }

        if (isset($filter['is_default']) && !empty($filter['is_default'])) {
            $this->db->where('is_default', $filter['is_default']);
        }

        if (isset($filter['is_broker_account']) && !empty($filter['is_broker_account'])) {
            $this->db->where('is_broker_account', $filter['is_broker_account']);
        }

        return $this->db->get($this->table)->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }

    public function addBankAccount($user_id, $bank_name, $account_number, $account_holder_name, $is_default = false, $is_broker_account = false)
    {
        // If this is to be the default account, unset previous defaults
        if ($is_default) {
            $this->db->where('user_id', $user_id)
                 ->set(['is_default' => false])
                 ->update($this->table);
        }

        $data = [
            'user_id' => $user_id,
            'bank_name' => $bank_name,
            'account_number' => $account_number,
            'account_holder_name' => $account_holder_name,
            'is_default' => $is_default,
            'is_broker_account' => $is_broker_account,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }

    public function setDefaultAccount($account_id, $user_id)
    {
        // Unset previous default accounts
        $this->db->where('user_id', $user_id)
             ->set(['is_default' => false])
             ->update($this->table);

        // Set the new default account
        $this->db->where('id', $account_id)
             ->set(['is_default' => true])
             ->update($this->table);
    }
}
