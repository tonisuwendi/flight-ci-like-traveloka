<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'home/login';
$route['login/admin'] = 'home/login_admin';
$route['register'] = 'home/register';
$route['booking/(:num)'] = 'booking/index/$1';
