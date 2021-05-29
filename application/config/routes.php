<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['maskapai'] = 'home/maskapai';
$route['bandara'] = 'home/bandara';
$route['login'] = 'home/login';
$route['login/admin'] = 'home/login_admin';
$route['register'] = 'home/register';
$route['admin'] = 'admin';
$route['booking'] = 'booking';
$route['booking/(:num)'] = 'booking/index/$1';
$route['payment'] = 'payment';
$route['search'] = 'search';
$route['user'] = 'user';
$route['(:any)'] = 'home/other_page/$1';
