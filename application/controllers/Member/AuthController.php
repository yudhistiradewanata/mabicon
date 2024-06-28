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

            if ($user) {
                $this->userModel->logLogin([
                    'user_id'=>$user->id,
                    'platform'=>$this->input->post('platform'),
                    'browser'=>$this->input->post('browserCode'),
                    'login_date'=>date("Y-m-d H:i:s"),
                ]);
                // Set user session data
                $this->setUserSession($user);
                redirect('member/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid login credentials.');redirect($this->input->server('HTTP_REFERER'));
            }
        }
        // echo "X";exit;
        $this->load->view('member/auth/login');
    }

    public function register()
    {
        // Check if the request is a POST
        if (getRequestMethod() == 'post') {
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'full_name' => $this->input->post('full_name')
            ];

            if ($this->userModel->register($data)) {
                $this->session->set_flashdata('success', 'Registration successful. Please wait for admin approval.');redirect('member/auth/login');
            } else {
                $this->session->set_flashdata('error', 'Failed to register. Please try again.');redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $this->load->view('member/auth/register');
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
