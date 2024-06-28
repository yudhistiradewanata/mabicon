<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupportTicketModel extends CI_Model
{
    private $table='support_tickets';
    public function getSupportTickets($filter = [])
    {
        if (isset($filter['user_id']) && !empty($filter['user_id'])) {
            $this->db->where('user_id', $filter['user_id']);
        }

        if (isset($filter['status']) && !empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
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
    public function createSupportTicket($user_id, $subject, $status = 'open')
    {
        $data = [
            'user_id' => $user_id,
            'subject' => $subject,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null
        ];

        return $this->db->insert($this->table,$data);
    }

    public function closeSupportTicket($ticket_id)
    {
        $ticket = $this->find($ticket_id);

        if ($ticket) {
            $ticket['status'] = 'closed';
            $ticket['updated_at'] = date('Y-m-d H:i:s');

            return $this->db->where('id',$ticket->id)->update($this->table,$ticket);
        }

        return false;
    }
    
    public function getTicketById($ticket_id)
    {
        return $this->find($ticket_id);
    }
}
