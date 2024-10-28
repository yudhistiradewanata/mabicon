<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mt5Model extends CI_Model
{
    private $_auth=[
        '1059'=>'-bA0ToEu',
        '1060'=>'5cTbEi-k'
    ];
    private $_group=[
        '1059'=>'',
        '1060'=>''
    ];
    public function __construct(){
        parent::__construct();
        $this->load->library('CMT5Request');
    }
    public function test($authid){
        // Example of use
        $request = new CMT5Request();
        // authenticate on the server using the auth command
        if ($request->init() && $request->auth($authid, $this->_auth[$authid], 1985, "WebManager")) {
            // Let us request the symbol named TEST using the symbol_get command
            $result = $request->get('/api/common/get');
            if ($result != false) {
                echo $result;
                $json = json_decode($result);
            }
        }
        $request->shutdown();
    }
    private function post($authid,$path,$data){
        $json=false;
        $request = new CMT5Request();
        if ($request->init() && $request->auth($authid, $this->_auth[$authid], 1985, "WebManager")) {
            $result = $request->post($path,json_encode($data));
            if ($result != false) {
                // echo $result;
                $json = json_decode($result);

            }
            else{
                $json=false;
            }
        }
        $request->shutdown();
        return $json;
    }
    public function createUser($authid,$account){
        $path="/api/user/add";
        $passmain=generateRandomString(8);
        $passinvestor=generateRandomString(8);
        $post=[
            'login'=>'0',
            'group'=>'',
            'pass_main'=>$passmain,
            'pass_investor'=>$passinvestor,
            'group'=>$this->_group[$authid],
            'id'=>$account->kyc_id_number,
            'name'=>$account->account_name,
            'leverage'=>100
        ];

        try{
            $response=$this->post($authid,$path,$post);    
            if($response==false){
                return false;
            }
            $updatedata=[
                'mt5_login'=>$response->login,
                'mt5_passmain'=>$passmain,
                'mt5_passinvenstor'=>$passinvestor,
                'group'=>$this->_group[$authid]
            ];
            $this->db->where('trading_account',$account->id)->set($updatedata);
            $this->session->set_flashdata('success', 'Account have been created in MT5, on ID: '.$response->login);
            return $updatedata;
        }
        catch(Exception $e){
            return false;
        }
    }
    public function createClient($authid,$user){
        return true;
    }

}
