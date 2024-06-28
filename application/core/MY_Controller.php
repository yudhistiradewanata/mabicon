<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        if($this->uri->segment(1)==="member" && $this->uri->segment(2)!=="auth"){
            if(!$this->session->has_userdata('isMemberLoggedIn')){
                redirect("member/auth/login");
            }
        }
        elseif($this->uri->segment(1)==="admin" && $this->uri->segment(2)!=="auth"){
            if(!$this->session->has_userdata('isAdminLoggedIn')){
                redirect("admin/auth/login");
            }
        }
    }
}
