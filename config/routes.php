<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
$route['default_controller'] = "comments";
$route[''] = 'comments/index';
#$route['(.*)'] = "comments/index/$1";
// To be able to add customs controllers
// 1. Comment the previous line : $route['(.*)'] = "comments/index/$1";
// 2. Uncomment these lines
$route['404_override'] = 'comments';
$route['(.*)'] = "/$1";