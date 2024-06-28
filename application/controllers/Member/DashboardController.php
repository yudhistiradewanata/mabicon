<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends MY_Controller
{
    
    public function index()
    {
        // echo "A";exit;
        $userId = $this->session->userdata('user_id');

        // Check KYC status
        $kycStatus = $this->kycModel->getKYC(['user_id' => $userId]);

        if (empty($kycStatus) || $kycStatus[0]->status == 'rejected') {
            $this->session->set_flashdata('error', 'Your KYC is not complete. Please upload your proof of identity.');
        } elseif ($kycStatus[0]->status == 'pending') {
            $this->session->set_flashdata('warning', 'Your KYC is under review.');
        } elseif ($kycStatus[0]->status == 'approved') {
            if (!$this->session->has_userdata('kyc_approved')) {
                $this->session->set_userdata('kyc_approved', true);
                $this->session->set_flashdata('success', 'Your KYC has been approved.');
            }
        }

        $dateChoice = $this->input->post('date_choice');
        // pre($dateChoice);
        if($dateChoice==null){
            $dateChoice='7days';
        }
        [$startDate, $endDate] = $this->convertDateChoice($dateChoice);

        $balanceSummary = $this->balanceModel->getBalanceSummary($userId, $startDate, $endDate);
        $tradingSummary = $this->tradingHistoryModel->getTradingSummary($userId, $startDate, $endDate);
        $transactionSummary = $this->transactionModel->getTransactionSummary($userId, $startDate, $endDate);
        $bonusSummary = $this->userBonusModel->getBonusSummary($userId, $startDate, $endDate);
        $announcements = $this->announcementModel->getAnnouncements();
        $trades=$this->db->where("date(trade_date)>=",$startDate)->where("date(trade_date)<=",$endDate)->where("user_id",$userId)->order_by("trade_date desc")->get('trading_histories')->result();
        $transactions=$this->db->where("date(transaction_date)>=",$startDate)->where("date(transaction_date)<=",$endDate)->where("user_id",$userId)->where_in("transaction_type",['deposit','withdrawal'])->order_by("transaction_date desc")->get('transactions')->result();


        $data = [
            'balanceSummary' => $balanceSummary,
            'tradingSummary' => $tradingSummary,
            'transactionSummary' => $transactionSummary,
            'bonusSummary' => $bonusSummary,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'announcements' => $announcements,
            'trades'=>$trades,
            'transactions'=>$transactions,
            'kycStatus' => $kycStatus[0]->status ?? 'not_submitted',
            'hidePageTitle'=>true
        ];
        // pre($data);

        $content = $this->load->view('member/dashboard/index2', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'Member Dashboard']);
    }

    public function viewAnnouncement($id)
    {
        $announcement = $this->announcementModel->find($id);

        if (!$announcement) {
            $this->session->set_flashdata('error', 'Announcement not found.');redirect('member/dashboard');
        }

        $data = [
            'announcement' => $announcement
        ];

        $content = $this->load->view('member/announcement/view', $data, true);
        $this->load->view('member/layout/master', ['content' => $content, 'title' => 'View Announcement']);
    }

    private function convertDateChoice($dateChoice)
    {
        $endDate = new DateTime();
        switch ($dateChoice) {
            case '7days':
                $startDate = (clone $endDate)->modify('-7 days');
                break;
            case '1month':
                $startDate = (clone $endDate)->modify('-1 month');
                break;
            case '3months':
                $startDate = (clone $endDate)->modify('-3 months');
                break;
            case '6months':
                $startDate = (clone $endDate)->modify('-6 months');
                break;
            case '1year':
                $startDate = (clone $endDate)->modify('-1 year');
                break;
            default:
                $dates=explode(" to ", $dateChoice);

                $startDate = new DateTime($dates[0]);
                $endDate = new DateTime($dates[1]);
                break;
        }
        return [$startDate->format("Y-m-d"), $endDate->format("Y-m-d")];


    }
}
