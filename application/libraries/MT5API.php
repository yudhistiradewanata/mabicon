<?php
// application/libraries/MT5API.php

class MT5API {
    private $server;
    private $curl;
    private $authenticated = false;

    public function __construct($params) {
        $this->server = rtrim($params['server'], '/');
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0); // Disable SSL verification for self-signed certificates
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Connection: Keep-Alive'));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    public function __destruct() {
        if ($this->curl) {
            curl_close($this->curl);
        }
    }

    private function sendRequest($path, $method = 'GET', $body = null) {
        $url = $this->server . $path;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);

        if ($method === 'POST' && $body !== null) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);
        }

        $result = curl_exec($this->curl);
        if ($result === false) {
            throw new Exception('Curl error: ' . curl_error($this->curl));
        }

        $code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        if ($code != 200) {
            throw new Exception('HTTP error code: ' . $code);
        }

        return json_decode($result, true);
    }

    private function md5_unicode($str) {
        return md5(mb_convert_encoding($str, 'UTF-16LE', 'UTF-8'), true);
    }

    private function hashPassword($password) {
        return md5($this->md5_unicode($password) . 'WebAPI', true);
    }

    public function authenticate($login, $password, $build = '484', $agent = 'WebManager') {
        $authStartResponse = $this->sendRequest("/api/auth/start?version=$build&agent=$agent&login=$login&type=manager");
        
        if ((int)$authStartResponse['retcode'] !== 0) {
            throw new Exception('Auth start error: ' . $authStartResponse['retcode']);
        }

        $srv_rand = hex2bin($authStartResponse['srv_rand']);
        $password_hash = $this->hashPassword($password);
        $srv_rand_answer = md5($password_hash . $srv_rand);

        $cli_rand_buf = random_bytes(16);
        $cli_rand = bin2hex($cli_rand_buf);

        $authAnswerResponse = $this->sendRequest("/api/auth/answer?srv_rand_answer=$srv_rand_answer&cli_rand=$cli_rand");

        if ((int)$authAnswerResponse['retcode'] !== 0) {
            throw new Exception('Auth answer error: ' . $authAnswerResponse['retcode']);
        }

        $cli_rand_answer = md5($password_hash . $cli_rand_buf);
        if ($cli_rand_answer !== $authAnswerResponse['cli_rand_answer']) {
            throw new Exception('Auth answer error: invalid client answer');
        }

        $this->authenticated = true;
        return true;
    }

    public function get($path) {
        if (!$this->authenticated) {
            throw new Exception('Not authenticated');
        }
        return $this->sendRequest($path, 'GET');
    }

    public function post($path, $body) {
        if (!$this->authenticated) {
            throw new Exception('Not authenticated');
        }
        return $this->sendRequest($path, 'POST', $body);
    }

    ## Main Interfaces

    #Users
    public function getUser($login) {
        return $this->sendRequest("/api/user/get?login=$login", 'GET');
    }

    public function getExternalUser($externalLogin) {
        return $this->sendRequest("/api/user/get_external?login=$externalLogin", 'GET');
    }

    public function getBatchUsers($logins) {
        $query = http_build_query(['logins' => implode(',', $logins)]);
        return $this->sendRequest("/api/user/get_batch?$query", 'GET');
    }

    public function checkUserPassword($login, $password) {
        $data = json_encode(['login' => $login, 'password' => $password]);
        return $this->sendRequest('/api/user/check_password', 'POST', $data);
    }

    public function changeUserPassword($login, $password) {
        $data = json_encode(['login' => $login, 'password' => $password]);
        return $this->sendRequest('/api/user/change_password', 'POST', $data);
    }

    public function getUserAccount($login) {
        return $this->sendRequest("/api/user/account/get?login=$login", 'GET');
    }

    public function getBatchUserAccounts($logins) {
        $query = http_build_query(['logins' => implode(',', $logins)]);
        return $this->sendRequest("/api/user/account/get_batch?$query", 'GET');
    }

    public function getUserLogins($groups) {
        $query = http_build_query(['groups' => implode(',', $groups)]);
        return $this->sendRequest("/api/user/logins?$query", 'GET');
    }

    public function getUserTotal() {
        return $this->sendRequest('/api/user/total', 'GET');
    }

    public function getUserGroup($login) {
        return $this->sendRequest("/api/user/group?login=$login", 'GET');
    }

    public function updateUserCertificate($certificateData) {
        return $this->sendRequest('/api/user/certificate/update', 'POST', json_encode($certificateData));
    }

    public function getUserCertificate($login) {
        return $this->sendRequest("/api/user/certificate/get?login=$login", 'GET');
    }

    public function deleteUserCertificate($login) {
        return $this->sendRequest("/api/user/certificate/delete?login=$login", 'POST');
    }

    public function confirmUserCertificate($login) {
        return $this->sendRequest("/api/user/certificate/confirm?login=$login", 'POST');
    }

    public function getUserOtpSecret($login) {
        return $this->sendRequest("/api/user/otp_secret/get?login=$login", 'GET');
    }

    public function setUserOtpSecret($login, $otpSecret) {
        $data = json_encode(['login' => $login, 'otp_secret' => $otpSecret]);
        return $this->sendRequest('/api/user/otp_secret/set', 'POST', $data);
    }

    public function syncExternalUser($login) {
        return $this->sendRequest("/api/user/sync_external?login=$login", 'POST');
    }

    public function checkUserBalance($login) {
        return $this->sendRequest("/api/user/check_balance?login=$login", 'POST');
    }

    public function archiveUser($login) {
        return $this->sendRequest("/api/user/archive/add?login=$login", 'POST');
    }

    public function getArchivedUser($login) {
        return $this->sendRequest("/api/user/archive/get?login=$login", 'GET');
    }

    public function getBatchArchivedUsers($logins) {
        $query = http_build_query(['logins' => implode(',', $logins)]);
        return $this->sendRequest("/api/user/archive/get_batch?$query", 'GET');
    }

    public function restoreUser($login) {
        return $this->sendRequest("/api/user/restore?login=$login", 'POST');
    }

    public function getUserBackupList($startDate, $endDate) {
        $query = http_build_query(['start_date' => $startDate, 'end_date' => $endDate]);
        return $this->sendRequest("/api/user/backup/list?$query", 'GET');
    }

    public function getUserBackup($backupDate) {
        return $this->sendRequest("/api/user/backup/get?backup_date=$backupDate", 'GET');
    }

    public function sendNotification($notificationData) {
        return $this->sendRequest('/api/notification/send', 'POST', json_encode($notificationData));
    }

    #Trading
    public function addClient($clientData) {
        return $this->sendRequest('/api/client/add', 'POST', json_encode($clientData));
    }

    public function updateClient($clientData) {
        return $this->sendRequest('/api/client/update', 'POST', json_encode($clientData));
    }

    public function deleteClient($clientId) {
        return $this->sendRequest("/api/client/delete?login=$clientId", 'POST');
    }

    public function getClient($clientId) {
        return $this->sendRequest("/api/client/get?login=$clientId", 'GET');
    }

    public function getClientHistory($clientId, $startTime, $endTime) {
        $query = http_build_query(['login' => $clientId, 'start' => $startTime, 'end' => $endTime]);
        return $this->sendRequest("/api/client/history/get?$query", 'GET');
    }

    public function getClientIds() {
        return $this->sendRequest('/api/client/get_ids', 'GET');
    }

    public function addClientUser($clientId, $userId) {
        $data = json_encode(['login' => $clientId, 'user' => $userId]);
        return $this->sendRequest('/api/client/user/add', 'POST', $data);
    }

    public function deleteClientUser($clientId, $userId) {
        $data = json_encode(['login' => $clientId, 'user' => $userId]);
        return $this->sendRequest('/api/client/user/delete', 'POST', $data);
    }

    public function getClientUserLogins($clientId) {
        return $this->sendRequest("/api/client/user/get_logins?login=$clientId", 'GET');
    }

    #Mail
    public function sendMail($mailData) {
        return $this->sendRequest('/api/mail/send', 'POST', json_encode($mailData));
    }

    public function getMail($mailId) {
        return $this->sendRequest("/api/mail/get?id=$mailId", 'GET');
    }

    public function getMailBody($mailId) {
        return $this->sendRequest("/api/mail/get_body?id=$mailId", 'GET');
    }

    #News
    public function sendNews($newsData) {
        return $this->sendRequest('/api/news/send', 'POST', json_encode($newsData));
    }

    public function getNews($newsId) {
        return $this->sendRequest("/api/news/get?id=$newsId", 'GET');
    }

    public function getNewsBody($newsId) {
        return $this->sendRequest("/api/news/get_body?id=$newsId", 'GET');
    }

    #Prices
    public function getLastTick($symbol) {
        return $this->sendRequest("/api/tick/last?symbol=$symbol", 'GET');
    }

    public function getLastGroupTick($symbol, $group) {
        return $this->sendRequest("/api/tick/last_group?symbol=$symbol&group=$group", 'GET');
    }

    public function getTickStatistics($symbol) {
        return $this->sendRequest("/api/tick/stat?symbol=$symbol", 'GET');
    }

    public function getTickHistory($symbol, $start, $end) {
        $query = http_build_query(['symbol' => $symbol, 'from' => $start, 'to' => $end]);
        return $this->sendRequest("/api/tick/history?$query", 'GET');
    }

    public function getChart($symbol, $start, $end) {
        $query = http_build_query(['symbol' => $symbol, 'from' => $start, 'to' => $end]);
        return $this->sendRequest("/api/chart/get?$query", 'GET');
    }

    public function getMarketDepth($symbol) {
        return $this->sendRequest("/api/book/get?symbol=$symbol", 'GET');
    }

    #Daily Reports
    public function getDailyReports($server, $name) {
        $query = http_build_query(['server' => $server, 'name' => $name]);
        return $this->sendRequest("/api/report/get?$query", 'GET');
    }

    public function deleteReport($server, $name) {
        $query = http_build_query(['server' => $server, 'name' => $name]);
        return $this->sendRequest("/api/report/delete?$query", 'GET');
    }

    public function shiftReport($index, $shift) {
        $query = http_build_query(['index' => $index, 'shift' => $shift]);
        return $this->sendRequest("/api/report/shift?$query", 'GET');
    }

    #Setting Files
    public function getSettings($section, $key) {
        $query = http_build_query(['section' => $section, 'key' => $key]);
        return $this->sendRequest("/api/setting/get?$query", 'GET');
    }

    public function setSettings($section, $key, $settings) {
        $query = http_build_query(['section' => $section, 'key' => $key]);
        return $this->sendRequest("/api/setting/set?$query", 'POST', json_encode($settings));
    }

    public function deleteSettings($section, $key) {
        $query = http_build_query(['section' => $section, 'key' => $key]);
        return $this->sendRequest("/api/setting/delete?$query", 'GET');
    }

    #Subscription
    public function getSubscriptions($login) {
        return $this->sendRequest("/api/subscription/get?login=$login", 'GET');
    }

    public function addSubscription($subscriptionData) {
        return $this->sendRequest('/api/subscription/add', 'POST', json_encode($subscriptionData));
    }

    public function updateSubscription($subscriptionData) {
        return $this->sendRequest('/api/subscription/update', 'POST', json_encode($subscriptionData));
    }

    public function deleteSubscription($login, $subscriptionId) {
        $query = http_build_query(['login' => $login, 'id' => $subscriptionId]);
        return $this->sendRequest("/api/subscription/delete?$query", 'GET');
    }

    public function checkSubscriptionExist($login, $subscriptionId) {
        $query = http_build_query(['login' => $login, 'id' => $subscriptionId]);
        return $this->sendRequest("/api/subscription/exist?$query", 'GET');
    }

    public function addSubscriptionHistory($historyData) {
        return $this->sendRequest('/api/subscription/history/add', 'POST', json_encode($historyData));
    }

    public function updateSubscriptionHistory($historyData) {
        return $this->sendRequest('/api/subscription/history/update', 'POST', json_encode($historyData));
    }

    public function deleteSubscriptionHistory($historyId) {
        return $this->sendRequest("/api/subscription/history/delete?id=$historyId", 'GET');
    }

    public function getSubscriptionHistory($login) {
        return $this->sendRequest("/api/subscription/history/get?login=$login", 'GET');
    }


}
