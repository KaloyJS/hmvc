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
|	https://codeigniter.com/user_guide/general/routing.html
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

// $route['default_controller'] = 'home';
$route['default_controller'] = 'welcome';
$route['login'] = 'login/index';
$route['login'] = 'login';
$route['addproject'] = 'home/addproject';
$route['projects'] = 'home/projects';
$route['saveproject'] = 'home/saveproject';
$route['pallet'] = 'home/pallet';
$route['shipment'] = 'home/shipment';
$route['addshipment'] = 'home/shipment/addshipment';
$route['saveshipment'] = 'home/shipment/saveshipment';
$route['editshipment/(:num)'] = 'home/shipment/editshipment/$1';
$route['updateshipment/(:num)'] = 'home/shipment/updateshipment/$1';
$route['addbox'] = 'home/pallet/addbox';
$route['editbox/(:num)'] = 'home/pallet/editbox/$1';
$route['updatebox/(:num)'] = 'home/pallet/updatebox/$1';
$route['savebox'] = 'home/pallet/savebox';
$route['setapproved'] = 'home/pallet/setapproved';
$route['partsinfo'] = 'home/partsinfo';
$route['stocksinfo'] = 'home/stocksinfo';
$route['editproject/(:num)'] = 'home/editproject/$1';
$route['updateproject/(:num)'] = 'home/updateproject/$1';
// $route['404_override'] = '';

//pillot portal 
$route['pillot'] = 'pillot/pillot';
$route['portal1'] = 'pillot/pillot/portal1';
$route['portal2'] = 'pillot/pillot/portal2';
$route['downloadreport/(:num)'] = 'pillot/pillot/downloadreport/$1';
$route['getprocess'] = 'pillot/pillot/Getprocess/index';


// sim handover
$route['simhandover'] = 'simhandover/sim';

//stopwatch
// $route['stopwatch'] = 'stopwatch/stopwatch';
$route['stopwatch'] = 'stopwatch/stopwatch/startnewprocess';
$route['stopwatch/home/(:num)'] = 'stopwatch/stopwatch/home/$1';
$route['stopwatch/addnotes/(:num)'] = 'stopwatch/stopwatch/addnotes/$1';
$route['stopwatch/updateprocess/(:num)'] = 'stopwatch/stopwatch/updateprocess/$1';
$route['stopwatch/generatereport/(:num)'] = 'stopwatch/stopwatch/generatereport/$1';
$route['stopwatch/start-new-process'] = 'stopwatch/stopwatch/startnewprocess';
$route['stopwatch/save-time-motion/(:num)'] = 'stopwatch/stopwatch/save_time_motion/$1';
$route['stopwatch/saveprocess'] = 'stopwatch/stopwatch/saveprocess';

//brs
$route['brs'] = 'brs/brs';
$route['brs/adddetails'] = 'brs/brs/adddetails';
$route['brs/savedetails'] = 'brs/brs/savedetails';
$route['brs/editdetails/(:num)'] = 'brs/brs/editdetails/$1';
$route['brs/updatedetails/(:num)'] = 'brs/brs/updatedetails/$1';

//projects
$route['projects'] = 'projects/projects';
$route['projects/overview/(:num)'] = 'projects/projects/overview/$1';
$route['projects/actions'] = 'projects/projects/actions';


//npi
$route['npi'] = 'npi/npi';
$route['npi/add_person'] = 'npi/add_person';
$route['npi/actions'] = 'npi/npi/actions';



$route['translate_uri_dashes'] = FALSE;
