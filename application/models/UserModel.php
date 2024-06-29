<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{
    private $table='users';
    public function getUsers($filter = [])
    {
        if (isset($filter['username']) && !empty($filter['username'])) {
            $this->db->like('u.username', $filter['username']);
        }
        if (isset($filter['referral_username']) && !empty($filter['referral_username'])) {
            $this->db->like('r.username', $filter['referral_username']);
        }
        if (isset($filter['email']) && !empty($filter['email'])) {
            $this->db->like('u.email', $filter['email']);
        }

        if (isset($filter['created_by']) && !empty($filter['created_by'])) {
            $this->db->where('date(u.created_by)', $filter['created_by']);
        }
        if (isset($filter['join_date_from']) && !empty($filter['join_date_from'])) {
            $this->db->where('date(u.created_at) >=', $filter['join_date_from']);
        }
        if (isset($filter['join_date_to']) && !empty($filter['join_date_to'])) {
            $this->db->where('date(u.created_at) <=', $filter['join_date_to']);
        }
        if (isset($filter['current_tier_id']) && !empty($filter['current_tier_id'])) {
            $this->db->where('u.current_tier_id', $filter['current_tier_id']);
        }

        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('u.id', $filter['user_id']);
        }

        if (isset($filter['user_ids']) && !empty($filter['user_ids'])) {
            $this->db->where_in('u.id', $filter['user_ids']);
        }

        return $this->db->select('u.*,r.username referral_username')->from($this->table.' u')->join('users r','u.referral_id=r.id','left')->get()->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function editUserProfile($user_id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$user_id, $data);
    }

    public function authenticate($username, $password)
    {
        $user = $this->db->where('username', $username)->or_where('email',$username)->get($this->table)->row();

        if ($user && password_verify($password, $user->password_hash)) {
            return $user;
        }

        return false;
    }

    public function register($data)
    {
        $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
        unset($data['password']);
        $data['status'] = 'pending';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = null;

        return $this->db->insert($this->table,$data);
    }

    public function activateUser($user_id)
    {
        return $this->db->where('id', $user_id)->update($this->table, ['status' => 'active', 'reset_token' => null, 'reset_token_expires' => null]);
    }
    public function logLogin($data){
        $this->db->insert('login_histories',$data);
        return $this->db->insert_id();
    }
    public function updateOtp($userId, $otp) {
        $data = [
            'otp' => $otp,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $userId);
        return $this->db->update('users', $data);
    }
    public function clearOtp($userId) {
        $data = [
            'otp' => NULL,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->where('id', $userId);
        return $this->db->update('users', $data);
    }
    public function saveResetToken($userId, $resetToken)
    {
        $data = [
            'reset_token' => $resetToken,
            'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ];
        return $this->db->where('id', $userId)->update('users', $data);
    }
    public function saveEmailResetToken($email, $resetToken)
    {
        $data = [
            'reset_token' => $resetToken
        ];
        return $this->db->where('email', $email)->update('users', $data);
    }

    public function getUserByResetToken($resetToken)
    {
        return $this->db->where('reset_token', $resetToken)
                        ->where('reset_token_expires >=', date('Y-m-d H:i:s'))
                        ->get('users')->row();
    }
    public function getUserByEmailResetToken($resetToken)
    {
        return $this->db->where('reset_token', $resetToken)
                        ->get('users')->row();
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $data = [
            'password_hash' => $hashedPassword,
            'reset_token' => null,
            'reset_token_expires' => null
        ];
        return $this->db->where('id', $userId)->update('users', $data);
    }
    public function usernameExists($username)
    {
        return $this->db->where('username', $username)->count_all_results($this->table) > 0;
    }

    public function emailExists($email)
    {
        return $this->db->where('email', $email)->count_all_results($this->table) > 0;
    }
}
