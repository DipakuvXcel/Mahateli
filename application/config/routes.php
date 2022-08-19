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
$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['gallery'] = "site/gallery";
$route['testimonials'] = "site/testimonial";
$route['products'] = "site/products";
$route['product-details/(:any)'] = "site/product_details";
$route['registration'] = "site/registration";
$route['login'] = "site/login";
$route['verify_account'] = "site/verify_account";
$route['about-us'] = "site/about_us";
$route['home'] = "site/home";
$route['contact-us'] = "site/contact_us";
$route['logout'] = "site/logout";
$route['blog-details/(:any)'] = "site/blog_details";
$route['services'] ="site/services";
$route['authenticate'] ="site/authenticate";
$route['artificial-garden'] ="site/shop_grass";
$route['cart'] ="site/cart";
$route['checkout'] ="site/checkout";
$route['payu_checkout'] ="site/payu_checkout";
$route['test_payment'] ="site/test_payment";
$route['videos'] ="site/videos";
$route['profile'] ="site/profile";
$route['process_order'] ="site/process_order";
$route['my-orders'] ="site/my_orders";
$route['change_password'] ="site/change_password";
$route['forgot_password'] ="site/forgot_password";
$route['reset_password'] ="site/reset_password";
$route['privacy-policy'] ="site/privacy_policy";
$route['terms_conditions'] ="site/terms_conditions";
$route['sitemap'] ="site/sitemap";
$route['help'] ="site/help";
$route['verify_request'] ="site/verify_request";
$route['talk_with_experts'] ="site/talk_with_experts";
$route['cooming_soon'] = "site/cooming_soon";
$route['faq'] ="site/faq";
$route['offers'] ="site/offers";
$route['offer_page'] ="site/offer_page";
$route['launching_offers'] ="site/launching_offers";
