<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BalanceManagementController extends MY_Controller
{
    public function index()
    {
        $filters = [
            'username' => $this->input->get('username'),
            'start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date')
        ];

        $this->db->select('users.username, balances.*');
        $this->db->from('balances');
        $this->db->join('users', 'balances.user_id = users.id', 'left');

        if (!empty($filters['username'])) {
            $this->db->like('users.username', $filters['username']);
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('balances.created_at >=', $filters['start_date']);
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('balances.created_at <=', $filters['end_date']);
        }

        $balances = $this->db->get()->result();

        $data = [
            'balances' => $balances,
            'filters' => $filters
        ];

        $content = $this->load->view('admin/balance_management/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Balance Management']);
    }
}
