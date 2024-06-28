<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KYCModel extends CI_Model
{
    private $table='kyc';
    public function getKYC($filters = [])
    {
        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $this->db->where('user_id', $filters['user_id']);
        }

        if (isset($filters['status']) && !empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }

        if (isset($filters['start_date']) && !empty($filters['start_date'])) {
            $this->db->where('created_at >=', $filters['start_date']);
        }

        if (isset($filters['end_date']) && !empty($filters['end_date'])) {
            $this->db->where('created_at <=', $filters['end_date']);
        }

        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function createKYC($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table,$data);
    }

    public function updateKYCStatus($id, $status)
    {
        $data = [
            'status' => $status,
            'reviewed_at' => date('Y-m-d H:i:s')
        ];
        return $this->db->where('id',$id)->update($this->table, $data);
    }

    public function getPendingKYC()
    {
        return $this->db->select('kyc.*,u.username')->where('kyc.status', 'pending')->from($this->table)->join('users u','kyc.user_id=u.id')->get()->result();
    }

    public function getKYCById($id)
    {
        return $this->find($id);
    }
}
