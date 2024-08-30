<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{
    private $table='admins';
    public function getAdmins($filter = [])
    {
        if (isset($filter['username']) && !empty($filter['username'])) {
            $this->db->where('username', $filter['username']);
        }

        if (isset($filter['email']) && !empty($filter['email'])) {
            $this->db->where('email', $filter['email']);
        }

        if (isset($filter['role']) && !empty($filter['role'])) {
            $this->db->where('role', $filter['role']);
        }

        if (isset($filter['status']) && !empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }

        return $this->db->get($this->table)->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function addAdmin($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = null;
        return $this->db->insert($this->table,$data);
    }

    public function updateAdmin($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$id, $data);
    }

    public function deleteAdmin($id)
    {
        return $this->db->delete($this->table,$id);
    }

    public function authenticate($username, $password)
    {
        $admin = $this->db->where('username', $username)->or_where('email',$username)->get($this->table)->row();

        if ($admin && password_verify($password, $admin->password_hash)) {
            return $admin;
        }

        return false;
    }
}
