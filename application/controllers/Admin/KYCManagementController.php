<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KYCManagementController extends MY_Controller
{
    public function index()
    {
        $pendingKYC = $this->kycModel->getPendingKYC();

        $data = [
            'pendingKYC' => $pendingKYC
        ];

        $content = $this->load->view('admin/kyc_management/index', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'KYC Management']);
    }

    public function view($id)
    {
        $kyc = $this->kycModel->getKYCById($id);
        if (!$kyc) {
            $this->session->set_flashdata('error', 'KYC request not found.');redirect('admin/kyc-management');
        }

        $user = $this->userModel->find($kyc->user_id);

        $data = [
            'kyc' => $kyc,
            'user' => $user
        ];

        $content = $this->load->view('admin/kyc_management/view', $data, true);
        $this->load->view('admin/layout/master', ['content' => $content, 'title' => 'View KYC Request']);
    }

    public function approve()
    {
        $id=$this->input->post("id");
        if ($this->kycModel->updateKYCStatus($id, 'approved')) {
            $this->session->set_flashdata('success', 'KYC request approved successfully.');redirect('admin/kyc-management');
        } else {
            $this->session->set_flashdata('error', 'Failed to approve KYC request. Please try again.');redirect($this->input->server('HTTP_REFERER'));
        }
    }

    public function reject()
    {
        $id=$this->input->post("id");
        if ($this->kycModel->updateKYCStatus($id, 'rejected')) {
            $this->session->set_flashdata('success', 'KYC request rejected successfully.');redirect('admin/kyc-management');
        } else {
            $this->session->set_flashdata('error', 'Failed to reject KYC request. Please try again.');redirect($this->input->server('HTTP_REFERER'));
        }
    }
}
