<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends MY_Controller
{
    public function kyc(){
        $this->edit('kyc');
    }
    public function changePassword(){
        $this->edit('changePassword');
    }
    public function edit($activeTab='personalDetails')
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's profile information
        $user = $this->userModel->find($userId);
        $loginHistories=$this->db->where('user_id',$userId)->order_by('login_date desc')->get('login_histories')->result();
        $usdtAddresses=$this->db->where('user_id',$userId)->order_by('created_at desc')->get('usdt_addresses')->result();
        $kyc=$this->db->where('user_id',$userId)->order_by('id desc')->get('kyc')->row();
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');redirect('member/profile');
        }

        if (getRequestMethod() == 'post') {
            $password=$this->input->post('password');
            if($this->userModel->authenticate($user->username,$password)){
                $data = [
                    'id' => $userId,
                    'full_name' => $this->input->post('full_name'),
                    'email' => $this->input->post('email'),
                    'phone_number' => $this->input->post('phone_number')
                ];

                if ($this->db->where('id',$userId)->update('users',$data)) {
                    $this->session->set_flashdata('success', 'Profile updated successfully.');redirect('member/profile');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update profile. Please try again.');redirect($this->input->server('HTTP_REFERER'));
                }
            }
            else{
                $this->session->set_flashdata('error', 'Wrong Password. Failed to update profile.');redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $data = [
            'user' => $user,
            'loginHistories'=>$loginHistories,
            'usdtAddresses'=>$usdtAddresses,
            'activeTab'=>$activeTab,
            'kyc'=>$kyc
        ];

        $content = $this->load->view('member/profile/edit', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Edit Profile']);
    }
    public function editPassword()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's profile information
        $user = $this->userModel->find($userId);
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('member/profile/changePassword');
        }
        $oldPassword = $this->input->post('old_password');
        $newPassword = $this->input->post('new_password');
        $confirmPassword = $this->input->post('confirm_password');

        if ($this->userModel->authenticate($user->username, $oldPassword)) {
            if ($newPassword === $confirmPassword) {
                $data = [
                    'password_hash' => password_hash($newPassword, PASSWORD_DEFAULT)
                ];

                if ($this->db->where('id', $userId)->update('users', $data)) {
                    $this->session->set_flashdata('success', 'Password updated successfully.');
                    redirect('member/profile/changePassword');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update password. Please try again.');
                    redirect('member/profile/changePassword');
                }
            } else {
                $this->session->set_flashdata('error', 'New Password and Confirm Password do not match.');
                redirect('member/profile/changePassword');
            }
        } else {
            $this->session->set_flashdata('error', 'Wrong Old Password. Failed to update password.');
            redirect('member/profile/changePassword');
        }
    }

    public function uploadKYC()
    {
        $userId = $this->session->userdata('user_id');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $config['upload_path'] = './assets/uploads/kyc/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['max_size'] = 2048; // Maximum size in KB
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('kyc_image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($this->input->server('HTTP_REFERER'));
            } else {
                $fileData = $this->upload->data();
                $filePath = $fileData['file_name'];

                $data = [
                    'user_id' => $userId,
                    'image' => $filePath,
                    'status' => 'pending'
                ];

                if ($this->kycModel->createKYC($data)) {
                    $this->session->set_flashdata('success', 'KYC document uploaded successfully.');
                    redirect('member/profile');
                } else {
                    $this->session->set_flashdata('error', 'Failed to upload KYC document. Please try again.');
                    redirect($this->input->server('HTTP_REFERER'));
                }
            }
        }

        $data = [
            'user_id' => $userId
        ];

        $content = $this->load->view('member/profile/upload_kyc', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Upload KYC']);
    }

    public function createUSDTAddress(){

    }
    public function defaultUSDTAddress($id){

    }
}
