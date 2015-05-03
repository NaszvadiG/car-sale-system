<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "home";
$route['register'] = "home/register";
$route['login'] = "home/login";
$route['logout'] = "home/logout";
$route['purchase/(:num)'] = "home/purchase/$1";

/*
 * Admin route
 */
$route['admin'] = "admin";
$route['admin/add_user']    = "admin/user_form";
$route['admin/user/(:num)'] = "admin/user_form/$1";

$route['admin/add_car']     = "admin/car_form";
$route['admin/car/(:num)']  = "admin/car_form/$1";

$route['404_override'] = '';