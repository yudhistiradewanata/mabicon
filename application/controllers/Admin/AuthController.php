<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends MY_Controller
{
    public function login()
    {
        // echo "EXIT";exit;
        // Check if the request is a POST
        if (getRequestMethod() == 'post') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // pre($username);

            $admin = $this->adminModel->authenticate($username, $password);

            if ($admin) {
                // Set admin session data
                $this->setAdminSession($admin);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid login credentials.');redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $this->load->view('admin/auth/login');
    }

    public function logout()
    {
        // Destroy admin session
        $this->session->sess_destroy();
        redirect('admin/auth/login');
    }

    private function setAdminSession($admin)
    {
        $data = [
            'admin_id' => $admin->id,
            'username' => $admin->username,
            'email' => $admin->email,
            'full_name' => $admin->full_name,
            'isLoggedIn' => true,
            'isAdminLoggedIn'=>true
        ];

        $this->session->set_userdata($data);
    }
}
