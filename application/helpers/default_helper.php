<?php
if (!function_exists('getRequestMethod')) {
    function getRequestMethod()
    {
        $method=$_SERVER['REQUEST_METHOD'];
        return strtolower($method);
    }
}
if (!function_exists('getSession')) {
    function getSession($key=null)
    {
        $ci=&get_instance();
        return $ci->session->userdata($key);
    }
}
if (!function_exists('pre')) {
    function pre($data, $next = 0)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if (!$next) {
            exit;
        }
    }
}

function dmy($date,$default=''){
    if(strtotime($date)){
        $dt=new DateTime($date);
        return $dt->format("d M y");
    }
    else return $default;
}
function his($date,$default=''){
    if(strtotime($date)){
        $dt=new DateTime($date);
        return $dt->format("h:i:s");
    }
    else return $default;
}
function format_str($str,$separator="_"){
    $str=str_replace($separator, " ", $str);
    return ucwords($str);
}

function getCompanyUSDT(){
    $ci=&get_instance();
    $address=$ci->db->where('is_broker_account',1)->where('is_default',1)->get('usdt_addresses')->row();
    return $address->usdt_address;
}
function showFlashData(){
    $ci=&get_instance();
    if ($ci->session->flashdata('warning')){
        echo '<div class="alert alert-warning">WARNING: '.ucwords($ci->session->flashdata('warning')).'</div>';
    }
    if ($ci->session->flashdata('error')){
        echo '<div class="alert alert-danger">ERROR:'.ucwords($ci->session->flashdata('error')).'</div>';
    }
    if ($ci->session->flashdata('success')){
        echo '<div class="alert alert-success">SUCCESS: '.ucwords($ci->session->flashdata('success')).'</div>';
    }
}
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getAdminCountBadge(){
    $ci=&get_instance();
    $countPendingKyc=$ci->db->where('status','pending')->count_all_results('kyc');
    $countPendingWithdrawal=$ci->db->where('status','pending')->count_all_results('withdrawal_requests');
    $countPendingTopup=$ci->db->where('status','pending')->count_all_results('top_up_requests');
    return [
        'countPendingKyc'=>$countPendingKyc?:0,
        'countPendingTransaction'=>($countPendingWithdrawal?:0)+($countPendingTopup?:0)
    ];
}