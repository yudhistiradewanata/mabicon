<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin routes
$route['admin'] = 'Admin/DashboardController';
$route['admin/auth'] = 'Admin/AuthController';
$route['admin/dashboard'] = 'Admin/DashboardController';
$route['admin/client-management'] = 'Admin/ClientManagementController';
$route['admin/trading-management'] = 'Admin/TradingManagementController';
$route['admin/trading-account-management'] = 'Admin/TradingAccountManagementController';
$route['admin/transaction-management'] = 'Admin/TransactionManagementController';
$route['admin/bonus-management'] = 'Admin/BonusManagementController';
$route['admin/balance-management'] = 'Admin/BalanceManagementController';
$route['admin/support'] = 'Admin/SupportController';
$route['admin/kyc-management'] = 'Admin/KYCManagementController';

$route['admin/auth/(:any)'] = 'Admin/AuthController/$1';
$route['admin/dashboard/(:any)'] = 'Admin/DashboardController/$1';
$route['admin/client-management/(:any)'] = 'Admin/ClientManagementController/$1';
$route['admin/trading-management/(:any)'] = 'Admin/TradingManagementController/$1';
$route['admin/trading-account-management/(:any)'] = 'Admin/TradingAccountManagementController/$1';
$route['admin/transaction-management/(:any)'] = 'Admin/TransactionManagementController/$1';
$route['admin/bonus-management/(:any)'] = 'Admin/BonusManagementController/$1';
$route['admin/support/(:any)'] = 'Admin/SupportController/$1';
$route['admin/kyc-management/(:any)'] = 'Admin/KYCManagementController/$1';
$route['admin/balance-management/(:any)'] = 'Admin/BalanceManagementController/$1';

$route['member'] = 'Member/DashboardController';
$route['member/auth'] = 'Member/AuthController';
$route['member/dashboard'] = 'Member/DashboardController';
$route['member/trading'] = 'Member/TradingController';
$route['member/tradingaccount'] = 'Member/TradingAccountController';
$route['member/topup'] = 'Member/TradingController/topuphistory';
$route['member/withdrawal'] = 'Member/TradingController/withdrawalhistory';
$route['member/account'] = 'Member/AccountController';
$route['member/profile'] = 'Member/ProfileController/edit';
$route['member/support'] = 'Member/SupportController';
$route['member/news'] = 'Member/NewsController';
$route['member/bonus'] = 'Member/BonusController';

$route['member/auth/(:any)/(:any)'] = 'Member/AuthController/$1/$2';
$route['member/auth/(:any)'] = 'Member/AuthController/$1';
$route['member/dashboard/(:any)'] = 'Member/DashboardController/$1';
$route['member/trading/(:any)'] = 'Member/TradingController/$1';
$route['member/tradingaccount/(:any)'] = 'Member/TradingAccountController/$1';
$route['member/account/(:any)'] = 'Member/AccountController/$1';
$route['member/profile/(:any)'] = 'Member/ProfileController/$1';
$route['member/profile/(:any)/(:any)'] = 'Member/ProfileController/$1/$2';
$route['member/support/(:any)'] = 'Member/SupportController/$1';
$route['member/news/(:any)'] = 'Member/NewsController/$1';
$route['member/bonus/(:any)'] = 'Member/BonusController/$1';


// Tool routes
$route['tool'] = 'ToolController/index';
$route['tool/(:any)'] = 'ToolController/$1';
$route['tool/(:any)/(:any)'] = 'ToolController/$1/$2';
$route['createTestData'] = 'ToolController/createTestData';