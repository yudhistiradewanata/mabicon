<?php

class Auth extends CI_Controller
{
    
    public function index()
    {
        $this->load->view('auth/login');
    }

    public function login()
    {
        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));

        if ($username == 'admin@themesbrand.com' && $password == '123456') {
            $session = session();
            $session->set('isLoggedIn', 1);
            redirect('');
        } else {
            $this->session->set_flashdata('error', 'These credentials do not match our records.');redirect($this->input->server('HTTP_REFERER'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('isLoggedIn');
        redirect('login');
    }

}
