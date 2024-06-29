<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends MY_Controller
{
    public function login()
    {
        // Check if the request is a POST
        if (getRequestMethod() == 'post') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->userModel->authenticate($username, $password);

            if ($user && $user->status=='active') {
                $this->userModel->logLogin([
                    'user_id'=>$user->id,
                    'platform'=>$this->input->post('platform'),
                    'browser'=>$this->input->post('browserCode'),
                    'login_date'=>date("Y-m-d H:i:s"),
                ]);
                // Set user session data
                $this->setUserSession($user);
                redirect('member/dashboard');
            } elseif($user && $user->status=='pending'){
                $this->session->set_flashdata('error', 'You must activate your account by accessing a verification link sent to your email.');redirect($this->input->server('HTTP_REFERER'));
            } else {
                $this->session->set_flashdata('error', 'Invalid login credentials.');redirect($this->input->server('HTTP_REFERER'));
            }
        }
        // echo "X";exit;
        $this->load->view('member/auth/login');
    }

    public function register($referral_username='')
    {
        if (getRequestMethod() == 'post') {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            
            // Check for existing username
            if ($this->userModel->usernameExists($username)) {
                $this->session->set_flashdata('error', 'Username already exists.');
                redirect($this->input->server('HTTP_REFERER'));
            }
            
            // Check for existing email
            if ($this->userModel->emailExists($email)) {
                $this->session->set_flashdata('error', 'Email already exists.');
                redirect($this->input->server('HTTP_REFERER'));
            }

            $data = [
                'username' => $username,
                'email' => $email,
                'phone_number' => $this->input->post('phone_number'),
                'password' => $this->input->post('password'),
                'full_name' => $this->input->post('full_name'),
            ];

            $referral_username = $this->input->post('referral_username');
            if (!empty($referral_username)) {
                $referral_user = $this->db->where('username',$referral_username)->get('users')->row();
                if (!$referral_user) {
                    $this->session->set_flashdata('error', 'Referral username not found.');
                    redirect($this->input->server('HTTP_REFERER'));
                } else {
                    $data['referral_id'] = $referral_user->id;
                }
            }

            $data['status'] = 'inactive';
            
            if ($this->userModel->register($data)) {
                $this->sendVerificationEmail($data['email']);
                $this->session->set_flashdata('success', 'Registration successful. Please check your email for verification link.');
                redirect('member/auth/login');
            } else {
                $this->session->set_flashdata('error', 'Failed to register. Please try again.');
                redirect($this->input->server('HTTP_REFERER'));
            }
        }
        if(!empty($referral_username)){
            $data['referral_username']=$referral_username;
        }

        $this->load->view('member/auth/register',$data);
    }

    private function sendVerificationEmail($email)
    {
        $token = bin2hex(random_bytes(16));
        $this->userModel->saveEmailResetToken($email, $token);

        $verification_link = site_url("member/auth/verify/$token");

        $this->email->initialize($this->config->item('email'));
        $this->email->from($this->config->item('smtp_user'), 'Mabicon');
        $this->email->to($email);
        $this->email->subject('Account Verification');
        $this->email->message("Please click the following link to verify your account: $verification_link");

        $this->email->send();
    }

    public function verify($token)
    {
        $user = $this->userModel->getUserByEmailResetToken($token);

        if ($user) {
            $this->userModel->activateUser($user->id);
            $this->session->set_flashdata('success', 'Account verified successfully. You can now log in.');
            redirect('member/auth/login');
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired verification link.');
            redirect('member/auth/login');
        }
    }

    public function logout()
    {
        // Destroy user session
        $this->session->sess_destroy();
        redirect('member/auth/login');
    }

    private function setUserSession($user)
    {
        $data = [
            'user_id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'full_name' => $user->full_name,
            'isLoggedIn' => true,
            'isMemberLoggedIn'=>true
        ];

        $this->session->set_userdata($data);
    }
    public function forgotPassword()
    {
        if (getRequestMethod() == 'post') {
            $email = $this->input->post('email');

            // Validate email
            $user = $this->db->where('email',$email)->get('users')->row();
            if (!$user) {
                $this->session->set_flashdata('error', 'Email not found.');
                redirect($this->input->server('HTTP_REFERER'));
            }

            // Generate reset token
            $resetToken = bin2hex(random_bytes(32));
            $resetUrl = site_url('member/auth/resetPassword/' . $resetToken);

            // Save reset token to the user record
            $this->userModel->saveResetToken($user->id, $resetToken);

            // Send reset email
            $this->load->library('email');
            $this->email->initialize($this->config->item('email'));
            $this->email->from($this->config->item('smtp_user'), 'Mabicon');
            $this->email->to($user->email);
            $this->email->subject('Password Reset Request');
            $this->email->message("Click this link to reset your password: <a href=\"$resetUrl\">$resetUrl</a>");

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Password reset link sent to your email.');
            } else {
                $this->session->set_flashdata('error', 'Failed to send password reset email.');
            }

            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->load->view('member/auth/forgot_password');
    }

    public function resetPassword($resetToken)
    {
        $user = $this->userModel->getUserByResetToken($resetToken);
        if (!$user) {
            $this->session->set_flashdata('error', 'Invalid or expired reset token.');
            redirect('member/auth/forgotPassword');
        }

        // Generate new password
        // $newPassword = bin2hex(random_bytes(4)); // 8 characters
        $newPassword = generateRandomString(8);
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update user's password
        $this->userModel->updatePassword($user->id, $hashedPassword);

        // Send new password to the user's email
        $this->load->library('email');
        $this->email->initialize($this->config->item('email'));
        $this->email->from($this->config->item('smtp_user'), 'Mabicon');
        $this->email->to($user->email);
        $this->email->subject('Your New Password');
        $this->email->message("Your new password is: $newPassword");

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'New password sent to your email.');
        } else {
            $this->session->set_flashdata('error', 'Failed to send new password email.');
        }

        redirect('member/auth/login');
    }
}
