<?php

class Home extends CI_Controller
{
    public function index()
    {
        // echo "A";exit;
        
        $this->load->view('landing');
        
    }

    public function root($path = '')
    {
        if ($path !== '') {
            if(@file_exists(APPPATH.'Views/'.$path.'.php')) {
                $this->load->view($path);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            echo 'Page Not Found.';
        }
    }
}
