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

$route['default_controller'] = "main";
$route['404_override'] = '';
$route['^(?!backend|auth|examples|msasani|upanga|training|community).*'] = "main/$0";
$route['training-center'] = "training/page/my-world-training-center";
$route['msasani-preschool'] = "msasani/page/my-world-preschool-msasani";
$route['upanga-preschool'] = "upanga/page/my-world-preschool-upanga";
$route['community-center'] = "community/page/my-world-community-centre";
$route['our-songs'] = "main/songs";
$route['contact-us'] = "main/contact";
$route['about-us'] = "main/about";
$route['the-directory'] = "main/the_directory";
$route['newsletter-archive'] = "main/newsletter";

/* End of file routes.php */
/* Location: ./application/config/routes.php */