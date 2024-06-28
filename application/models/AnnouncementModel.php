<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnnouncementModel extends CI_Model
{
    private $table='announcements';
    public function getAnnouncements($filter = [])
    {
        if (isset($filter['title']) && !empty($filter['title'])) {
            $this->db->like('title', $filter['title']);
        }

        if (isset($filter['created_at']) && !empty($filter['created_at'])) {
            $this->db->where('created_at >=', $filter['created_at']);
        }

        return $this->db->get($this->table)->result();
    }

    public function createAnnouncement($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['deleted_at'] = null;
        return $this->db->insert($this->table,$data);
    }

    public function editAnnouncement($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->update($this->table,$id, $data);
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
}
