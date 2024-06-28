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
$route['admin'] = 'admin/dashboardcontroller';
$route['admin/auth'] = 'admin/authcontroller';
$route['admin/dashboard'] = 'admin/dashboardcontroller';
$route['admin/client-management'] = 'admin/clientmanagementcontroller';
$route['admin/trading-management'] = 'admin/tradingmanagementcontroller';
$route['admin/transaction-management'] = 'admin/transactionmanagementcontroller';
$route['admin/bonus-management'] = 'admin/bonusmanagementcontroller';
$route['admin/balance-management'] = 'admin/balancemanagementcontroller';
$route['admin/support'] = 'admin/supportcontroller';
$route['admin/kyc-management'] = 'admin/kycmanagementcontroller';

$route['admin/auth/(:any)'] = 'admin/authcontroller/$1';
$route['admin/dashboard/(:any)'] = 'admin/dashboardcontroller/$1';
$route['admin/client-management/(:any)'] = 'admin/clientmanagementcontroller/$1';
$route['admin/trading-management/(:any)'] = 'admin/tradingmanagementcontroller/$1';
$route['admin/transaction-management/(:any)'] = 'admin/transactionmanagementcontroller/$1';
$route['admin/bonus-management/(:any)'] = 'admin/bonusmanagementcontroller/$1';
$route['admin/support/(:any)'] = 'admin/supportcontroller/$1';
$route['admin/kyc-management/(:any)'] = 'admin/kycmanagementcontroller/$1';
$route['admin/balance-management/(:any)'] = 'admin/balancemanagementcontroller/$1';

// Member routes
$route['member'] = 'member/dashboardcontroller';
$route['member/auth'] = 'member/authcontroller';
$route['member/dashboard'] = 'member/dashboardcontroller';
$route['member/trading'] = 'member/tradingcontroller';
$route['member/topup'] = 'member/tradingcontroller/topuphistory';
$route['member/withdrawal'] = 'member/tradingcontroller/withdrawalhistory';
$route['member/account'] = 'member/accountcontroller';
$route['member/profile'] = 'member/profilecontroller/edit';
$route['member/support'] = 'member/supportcontroller';
$route['member/news'] = 'member/newscontroller';
$route['member/bonus'] = 'member/bonuscontroller';

// $route['login']='home';
$route['member/auth/(:any)/(:any)'] = 'member/authcontroller/$1/$2';
$route['member/auth/(:any)'] = 'member/authcontroller/$1';
$route['member/dashboard/(:any)'] = 'member/dashboardcontroller/$1';
$route['member/trading/(:any)'] = 'member/tradingcontroller/$1';
$route['member/account/(:any)'] = 'member/accountcontroller/$1';
$route['member/profile/(:any)'] = 'member/profilecontroller/$1';
$route['member/support/(:any)'] = 'member/supportcontroller/$1';
$route['member/news/(:any)'] = 'member/newscontroller/$1';
$route['member/bonus/(:any)'] = 'member/bonuscontroller/$1';

// Tool routes
$route['tool'] = 'toolcontroller/index';
$route['tool/(:any)'] = 'toolcontroller/$1';
$route['tool/(:any)/(:any)'] = 'toolcontroller/$1/$2';
$route['createTestData'] = 'tool/createTestData';