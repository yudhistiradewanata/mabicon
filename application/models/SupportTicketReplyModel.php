<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupportTicketReplyModel extends CI_Model
{
    private $table='support_ticket_replies';
     public function getReplies($filter = [])
    {
        if (isset($filter['ticket_id']) && !empty($filter['ticket_id'])) {
            $this->db->where('ticket_id', $filter['ticket_id']);
        }

        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('user_id', $filter['user_id']);
        }

        if (isset($filter['admin_id']) && !empty($filter['admin_id'])) {
            $this->db->where('admin_id', $filter['admin_id']);
        }

        if (isset($filter['start_date']) && !empty($filter['start_date'])) {
            $this->db->where('created_at >=', $filter['start_date']);
        }

        if (isset($filter['end_date']) && !empty($filter['end_date'])) {
            $this->db->where('created_at <=', $filter['end_date']);
        }

        return $this->db->get($this->table)->result();
    }
    public function find($id){
        return $this->db->where('id',$id)->get($this->table)->row();
    }
    public function addReply($ticket_id, $user_id = null, $admin_id = null, $message='')
    {
        $data = [
            'ticket_id' => $ticket_id,
            'user_id' => $user_id,
            'admin_id' => $admin_id,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }
}
