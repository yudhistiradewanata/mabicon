<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BonusController extends CI_Controller
{
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's bonuses
        $userBonuses = $this->db->where('user_id', $userId)->order_by('created_at', 'DESC')->get('user_bonuses')->result();
        
        // Summarize bonuses (you can add your own summary logic here)
        $bonusSummary = $this->db->select('SUM(bonus_amount) as total_bonus')
                                  ->where('user_id', $userId)
                                  ->get('user_bonuses')
                                  ->row();
        
        $data = [
            'userBonuses' => $userBonuses,
            'bonusSummary' => $bonusSummary
        ];

        $content = $this->load->view('member/bonus/index', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'My Bonuses']);
    }
}
