<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SupportController extends MY_Controller
{
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's support tickets
        $supportTickets = $this->supportTicketModel->where('user_id', $userId)->order_by('created_at', 'DESC')->get()->result();

        $data = [
            'supportTickets' => $supportTickets
        ];

        $content = $this->load->view('member/support/index', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Support Tickets']);
    }

    public function $this->load->view($id, true)
    {
        $userId = $this->session->userdata('user_id');
        
        // Get specific support ticket
        $supportTicket = $this->supportTicketModel->where('user_id', $userId)->find($id);
        // Get replies for the support ticket
        $replies = $this->supportTicketReplyModel->where('ticket_id', $id)->order_by('created_at', 'ASC')->get()->result();

        if (!$supportTicket) {
            $this->session->set_flashdata('error', 'Support ticket not found.');redirect('member/support');
        }

        $data = [
            'supportTicket' => $supportTicket,
            'replies' => $replies
        ];

        $content = $this->load->view('member/support/view', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'View Support Ticket']);
    }

    public function create()
    {
        if (getRequestMethod() == 'post') {
            $userId = $this->session->userdata('user_id');
            $data = [
                'user_id' => $userId,
                'subject' => $this->input->post('subject'),
                'status' => 'open'
            ];

            if ($this->supportTicketModel->createSupportTicket($userId, $data['subject'], $data['status'])) {
                $this->session->set_flashdata('success', 'Support ticket created successfully.');redirect('member/support');
            } else {
                $this->session->set_flashdata('error', 'Failed to create support ticket. Please try again.');redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $content = $this->load->view('member/support/create', true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Create Support Ticket']);
    }

    public function reply($ticket_id)
    {
        if (getRequestMethod() == 'post') {
            $userId = $this->session->userdata('user_id');
            $data = [
                'ticket_id' => $ticket_id,
                'user_id' => $userId,
                'message' => $this->input->post('message')
            ];

            if ($this->supportTicketReplyModel->addReply($ticket_id, $userId, null, $data['message'])) {
                $this->session->set_flashdata('success', 'Reply added successfully.');redirect('member/support/view/' . $ticket_id);
            } else {
                $this->session->set_flashdata('error', 'Failed to add reply. Please try again.');redirect($this->input->server('HTTP_REFERER'));
            }
        }

        redirect('member/support/view/' . $ticket_id);
    }
}
