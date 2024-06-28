<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SupportController extends MY_Controller
{
    public function index()
    {
        $filters = [
            'status' => $this->input->get('status'),
            'user_id' => $this->input->get('user_id'),
            'start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date')
        ];

        $tickets = $this->supportTicketModel->getSupportTickets(array_filter($filters));

        $data = [
            'tickets' => $tickets
        ];

        $content = $this->load->view('admin/support/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Support Tickets']);
    }

    public function view($id)
    {
        $ticket = $this->supportTicketModel->find($id);
        if (!$ticket) {
            $this->session->set_flashdata('error', 'Support ticket not found.');redirect('admin/support');
        }

        $replies = $this->supportTicketReplyModel->getReplies(['ticket_id' => $id]);

        $data = [
            'ticket' => $ticket,
            'replies' => $replies
        ];

        $content = $this->load->view('admin/support/view', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'View Support Ticket']);
    }

    public function reply($id)
    {
        if (getRequestMethod() == 'post') {
            $message = $this->input->post('message');

            if ($this->supportTicketReplyModel->addReply($id, null, $this->session->userdata('admin_id'), $message)) {
                $this->session->set_flashdata('success', 'Reply added successfully.');redirect('admin/support/view/' . $id);
            } else {
                $this->session->set_flashdata('error', 'Failed to add reply. Please try again.');redirect($this->input->server('HTTP_REFERER'));
            }
        }

        redirect('admin/support/view/' . $id);
    }

    public function close($id)
    {
        if ($this->supportTicketModel->closeSupportTicket($id)) {
            $this->session->set_flashdata('success', 'Support ticket closed successfully.');redirect('admin/support');
        } else {
            $this->session->set_flashdata('error', 'Failed to close support ticket. Please try again.');redirect($this->input->server('HTTP_REFERER'));
        }
    }
}
