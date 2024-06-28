<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TradingController extends MY_Controller
{
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's trading histories
        $tradingHistories = $this->db->where('user_id', $userId)->order_by('trade_date', 'DESC')->get('trading_histories')->result();
        $tradingSummary=$this->tradingHistoryModel->getTradingSummary($userId);
        $data = [
            'tradingHistories' => $tradingHistories,
            'tradingSummary'=>$tradingSummary
        ];

        $content = $this->load->view('member/trading/index', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Trading History']);
    }
    public function view($id)
    {
        $userId = $this->session->userdata('user_id');
        
        // Get specific trading history
        $tradingHistory = $this->tradingHistoryModel->where('user_id', $userId)->find($id);

        if (!$tradingHistory) {
            $this->session->set_flashdata('error', 'Trade not found.');redirect('member/trading');
        }

        $data = [
            'tradingHistory' => $tradingHistory
        ];

        $content = $this->load->view('member/trading/view', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'View Trade']);
    }

    public function topUp()
    {
        if (getRequestMethod() == 'post') {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'topup_amount' => $this->input->post('topup_amount'),
                'topup_date' => $this->input->post('topup_date'),
                'transfer_destination' => $this->input->post('transfer_destination'),
                'status' => 'pending',
            ];

            // Handle file upload
            if (!empty($_FILES['transfer_proof_file']['name'])) {
                $config['upload_path'] = './assets/uploads/deposit/';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size'] = 2048;
                $config['file_name'] = time() . '_' . $_FILES['transfer_proof_file']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('transfer_proof_file')) {
                    $data['transfer_proof_file'] = $this->upload->data('file_name');
                } else {
                    // Handle file upload error
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('member/topup');
                }
            }

            // Insert data into database
            if ($this->db->insert('top_up_requests',$data)) {
                $this->session->set_flashdata('success', 'Top-Up Request created successfully.');
                redirect('member/topup');
            } else {
                $this->session->set_flashdata('error', 'Failed to create Top-Up Request.');
                redirect('member/topup');
            }
        }
        $content = $this->load->view('member/trading/top_up', true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Top Up']);
    }

    public function withdraw()
    {
        if (getRequestMethod() == 'post') {
            $userId = $this->session->userdata('user_id');
            $withdrawal_amount = $this->input->post('withdrawal_amount');
            $otp = $this->input->post('otp');
            $usdtAddress = $this->input->post('usdt_address');

            // Check if OTP matches
            $user = $this->db->where('id',$userId)->get('users')->row();
            if ($user->otp !== $otp) {
                $this->session->set_flashdata('error', 'Invalid OTP. Please try again.');
                redirect($this->input->server('HTTP_REFERER'));
            }

            // Check if amount is valid (You can add more logic here to check available balance if necessary)
            // Assuming you have a function getAvailableBalance($userId) in your userModel
            $availableBalance = $this->balanceModel->getBalanceSummary($userId)->total_balance;
            if ($withdrawal_amount > $availableBalance) {
                $this->session->set_flashdata('error', 'Insufficient balance. Please try again.');
                redirect($this->input->server('HTTP_REFERER'));
            }

            // Prepare data for insertion
            $data = [
                'user_id' => $userId,
                'withdrawal_amount' => $withdrawal_amount,
                'otp_sent_to_email' => $user->email,
                'otp'=>$otp,
                'usdt_address' => $usdtAddress,
                'status' => 'pending'
            ];
            $this->db->trans_start();
            // Insert withdrawal request into the database
            if ($this->withdrawalRequestModel->insertWithdrawalRequest($data)) {
                // Set OTP to NULL after successful insertion
                $this->userModel->clearOtp($userId);
                $this->db->trans_complete();
                $this->session->set_flashdata('success', 'Withdrawal request submitted successfully.');
                redirect('member/trading/withdrawalHistory');
            } else {
                $this->db->trans_rollback();
                $this->db->trans_complete();
                $this->session->set_flashdata('error', 'Failed to submit withdrawal request. Please try again.');
                redirect($this->input->server('HTTP_REFERER'));
            }
        }

        $content = $this->load->view('member/trading/withdraw', true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Withdraw']);
    }

    public function topUpHistory()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's top-up request history
        $topUpRequests = $this->db->where('user_id', $userId)->order_by('topup_date', 'DESC')->get('top_up_requests')->result();

        $data = [
            'topUpRequests' => $topUpRequests
        ];

        $content = $this->load->view('member/trading/top_up_history', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Top Up History']);
    }

    public function withdrawalHistory()
    {
        $userId = $this->session->userdata('user_id');
        
        // Get user's withdrawal request history
        $withdrawalRequests = $this->db->where('user_id', $userId)->order_by('created_at', 'DESC')->get('withdrawal_requests')->result();
        $usdtAddresses=$this->db->where('user_id',$userId)->order_by('is_default desc')->get('usdt_addresses')->result();
        $data = [
            'withdrawalRequests' => $withdrawalRequests,
            'usdtAddresses'=>$usdtAddresses
        ];

        $content = $this->load->view('member/trading/withdrawal_history', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Withdrawal History']);
    }
    public function requestOtp() {
        $userId = $this->session->userdata('user_id');

        // Generate a 6-character random string
        $otp = generateRandomString(6);
        $emailConfig=$this->config->item('email');
        // pre($email);
        // Update the user's otp in the database
        if ($this->userModel->updateOtp($userId, $otp)) {
            // Get user's email
            $user = $this->db->where('id',$userId)->get('users')->row();
            if ($user) {
                // Send OTP to the user's email
                $this->email->initialize($emailConfig);
                $this->email->from($emailConfig['smtp_user'], 'Mabicon');
                $this->email->to($user->email);
                $this->email->subject('Your OTP Code');
                $this->email->message('Your OTP code is: ' . $otp);

                if ($this->email->send(false)) {
                    echo json_encode(['status' => 'success','message'=>'OTP sent to your email. Please check your email.']);
                } else {
                    // echo json_encode($this->email->print_debugger(array('headers')));
                    echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User not found.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update OTP.']);
        }
    }
}

