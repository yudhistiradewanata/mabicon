<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TradingManagementController extends MY_Controller
{
    public function index()
    {

        $filters = [
            'username' => $this->input->get('username'),
            'asset' => $this->input->get('asset'),
            'user_id' => $this->input->get('user_id'),
            'trade_date' => $this->input->get('trade_date'),
            'start_date' => $this->input->get('start_date'),
            'end_date' => $this->input->get('end_date')
        ];

        $tradingHistories = $this->tradingHistoryModel->getTradingHistories(array_filter($filters));

        $data = [
            'tradingHistories' => $tradingHistories,
            'filters'=>$filters
        ];

        $content = $this->load->view('admin/trading_management/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Trading Management']);
    }

    public function import()
    {
        $config['upload_path'] = './assets/uploads/trades/';
        $config['allowed_types'] = 'csv';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('trading_csv')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('admin/trading-management');
        } else {
            $fileData = $this->upload->data();
            $filePath = $fileData['full_path'];
            $this->db->trans_start();
            $this->tradingHistoryModel->importTrades($filePath);
            $this->db->trans_complete();
            $this->session->set_flashdata('success', 'Trading history imported successfully.');
            redirect('admin/trading-management');
        }
    }

    public function uploadHistory()
    {
        // Assuming there's a model or logic to get the upload history
        // Replace with actual implementation as needed

        $uploadHistories = []; // Placeholder

        $data = [
            'uploadHistories' => $uploadHistories
        ];

        $content = $this->load->view('admin/trading_management/upload_history', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'Upload History']);
    }
}
