<?php

class ToolController extends MY_Controller
{
    public function sendemail(){
        
        $emailConfig=$this->config->item('email');
        $this->email->initialize($emailConfig);
        $this->email->from($emailConfig['smtp_user'], 'Mabicon');
        $this->email->to("yudhistiradewanata@gmail.com");
        $this->email->subject('Account Verification');
        $this->email->message("Hi nice to meet you, i am Mabicon Tech");

        $this->email->send();
    }
    public function index(){
        echo "B";
    }
    public function resetUserPass($user_id){
        $password_hash=password_hash('password', PASSWORD_DEFAULT);
        $this->db->where('id',$user_id)->set(['password_hash'=>$password_hash])->update('users');
        echo "OK";
    }
    public function resetAdminPass($admin_id){
        $password_hash=password_hash('password', PASSWORD_DEFAULT);
        $this->db->where('id',$admin_id)->set(['password_hash'=>$password_hash])->update('admins');
        echo "OK";
    }
    public function createTestData()
    {
        $this->truncateAllTables();

        // Create test admin
        $adminId = $this->adminModel->insert([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test user
        $userId = $this->userModel->insert([
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password_hash' => password_hash('password', PASSWORD_DEFAULT),
            'status' => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test balance
        $this->balanceModel->insert([
            'user_id' => $userId,
            'previous_amount' => 500,
            'debit_amount' => 0,
            'credit_amount' => 1000,
            'balance_amount' => 1000,
            'last_updated' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test bank account
        $this->bankAccountModel->insert([
            'user_id' => $userId,
            'bank_name' => 'Test Bank',
            'account_number' => '1234567890',
            'account_holder_name' => 'Test User',
            'is_default' => 1,
            'is_broker_account' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test referral bonus config
        $this->referralBonusConfigModel->insert([
            'percentage' => 10,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test support ticket
        $ticketId = $this->supportTicketModel->insert([
            'user_id' => $userId,
            'subject' => 'Test Support Ticket',
            'status' => 'open',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test support ticket reply
        $this->supportTicketReplyModel->insert([
            'ticket_id' => $ticketId,
            'user_id' => $userId,
            'admin_id' => $adminId,
            'message' => 'Test reply from admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test top-up request
        $this->topUpRequestModel->insert([
            'user_id' => $userId,
            'topup_amount' => 500,
            'topup_date' => date('Y-m-d H:i:s'),
            'transfer_proof_file' => 'proof.png',
            'transfer_destination' => 'broker_bank_account',
            'status' => 'pending',
            'reviewed_by_admin_id' => $adminId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test trading history
        $this->tradingHistoryModel->insert([
            'user_id' => $userId,
            'trade_date' => date('Y-m-d H:i:s'),
            'asset' => 'EUR/USD',
            'open_price' => 1.2000,
            'trade_status' => 'closed',
            'close_price' => 1.2500,
            'pnl' => 50,
            'margin' => 100,
            'lot' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test turnover bonus config
        $this->turnoverBonusConfigModel->insert([
            'level' => 1,
            'turnover_threshold' => 10000,
            'bonus_amount' => 100,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test USDT address
        $this->usdtAddressModel->insert([
            'user_id' => $userId,
            'usdt_address' => 'usdt123456',
            'is_default' => 1,
            'is_broker_account' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test user bonus
        $this->userBonusModel->insert([
            'user_id' => $userId,
            'bonus_id' => $bonusId,
            'description' => 'Test bonus',
            'bonus_amount' => 50,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test withdrawal request
        $this->withdrawalRequestModel->insert([
            'user_id' => $userId,
            'withdrawal_amount' => 200,
            'otp_sent_to_email' => 'testuser@example.com',
            'usdt_address' => 'usdt123456',
            'status' => 'pending',
            'reviewed_by_admin_id' => $adminId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test announcement
        $this->announcementModel->insert([
            'title' => 'Test Announcement',
            'content' => 'This is a test announcement.',
            'image' => 'announcement.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test KYC entry
        $this->kycModel->insert([
            'user_id' => $userId,
            'image' => 'kyc.png',
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test tier
        $this->tierModel->insert([
            'name' => 'Test Tier',
            'description' => 'This is a test tier.',
            'min_deposit' => 1000,
            'min_trading_volume' => 10000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test rebate bonus config
        $this->rebateBonusConfigModel->insert([
            'tier_id' => 1,
            'percentage' => 2,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test welcome bonus config
        $this->welcomeBonusConfigModel->insert([
            'amount' => 100,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return 'Test data created successfully!';
    }
    public function truncateAllTables()
    {
        $db = \Config\Database::connect();

        $tables = [
            'admins',
            'users',
            'balances',
            'bank_accounts',
            'referral_bonus_configs',
            'support_tickets',
            'support_ticket_replies',
            'top_up_requests',
            'trading_histories',
            'turnover_bonus_configs',
            'usdt_addresses',
            'user_bonuses',
            'withdrawal_requests',
            'announcements',
            'kyc',
            'tiers',
            'rebate_bonus_configs',
            'welcome_bonus_configs'
        ];

        foreach ($tables as $table) {
            $db->table($table)->truncate();
        }

        return 'All tables truncated successfully!';
    }
}
