<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['default_controller']    = "frontend/home";
$route['admin']                 = "access/users/login";
$route['user']                  = "access/subscriber/login";
$route['login']                 = "access/subscriber/login_form";
$route['reset_password']        = "access/subscriber/reset_password";
$route['signup']                = "access/subscriber/signup_form";
$route['sr']                    = "access/sr/login";
$route['']                      = "frontend/home";
$route['about']                 = "frontend/home/about";
$route['faq']                   = "frontend/home/faq";
$route['order']                 = "frontend/home/order";
$route['affiliate_product']     = "frontend/home/affiliate_product";
$route['global_method']         = "frontend/home/global_method";
$route['brandAll']              = "frontend/home/brandAll";
$route['categoryAll']           = "frontend/home/categoryAll";
$route['singlePage']            = "frontend/home/singlePage";


//footer
$route['pp']      = "frontend/home/pp";
$route['order']   = "frontend/home/order";
$route['returns'] = "frontend/home/returns";
$route['delivery']= "frontend/home/delivery";



$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
