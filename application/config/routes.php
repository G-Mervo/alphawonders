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
$route['default_controller'] = 'alphawonders';
$route['services'] = 'alphawonders/services';
$route['contact-us'] = 'alphawonders/contact';
$route['send'] = 'alphawonders/send_contact_data';
$route['softwares'] = 'alphawonders/alphasoftwares';
$route['system-administration'] = 'alphawonders/alphasystems';
$route['digital-marketing'] = 'alphawonders/alphamarketing';
$route['design'] = 'alphawonders/alphadesign';
$route['ict-consultancy'] = 'alphawonders/alphaconsultancy';
$route['it-support'] = 'alphawonders/alphasupport';

// $route['blog'] = 'alphawonders/alphablog';
$route['post'] = 'alphawonders/alphapost';
$route['post-comments'] = 'alphawonders/post_comments';

$route['hire'] = 'alphawonders/alphahires';
$route['hires'] = 'alphawonders/hires_details';
$route['subscribe'] = 'alphawonders/subscriptions_email';

$route['quantum-computing'] = 'blog/qtm_comp';
$route['data-science'] = 'blog/dtsci';
$route['privacy-policy'] = 'blog/privacy';
$route['robotics'] = 'blog/robotics';

// Load default controller when have only currency from multilanguage
$route['shop'] = 'marketplace';
$route['^(\w{2})$'] = $route['shop'];
// Shop page (greenlabel template)
// $route['shop'] = "home/index";
// $route['(\w{2})/shop'] = "home/index";

// home page pagination
$route[rawurlencode('shop') . '/(:num)'] = "marketplace/index/$1";
// load javascript language file
$route['loadlanguage/(:any)'] = "Loader/jsFile/$1";
// load default-gradient css
$route['cssloader/(:any)'] = "Loader/cssStyle";

// Template Routes
$route['template/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/(:any)'] = "Loader/templateCss/$1";
$route['templatejs/(:any)'] = "Loader/templateJs/$1";

// blog urls style and pagination
$route['blog'] = 'blog/index';
// $route['blog/(:any)'] = "blog/index/$1";
$route['blog/(:any)'] = "blog/viewPostNoyear/$2";
$route['blog/(:num)/(:any)'] = "blog/viewPost/$4/$2";
$route['(\w{2})/blog/(:any)'] = "blog/viewPost/$3";


$route['sitemap.xml'] = "home/sitemap";

/*
 * Admin Controllers Routes
 */
// HOME / LOGIN
$route['admin'] = "admin/home/login";
$route['admin/home'] = "admin/home/home";

// ECOMMERCE GROUP
$route['admin/publish'] = "admin/ecommerce/publish";
$route['admin/publish/(:num)'] = "admin/ecommerce/publish/index/$1";
$route['admin/removeSecondaryImage'] = "admin/ecommerce/publish/removeSecondaryImage";
$route['admin/products'] = "admin/ecommerce/products";
$route['admin/products/(:num)'] = "admin/ecommerce/products/index/$1";
$route['admin/productStatusChange'] = "admin/ecommerce/products/productStatusChange";
$route['admin/shopcategories'] = "admin/ecommerce/ShopCategories";
$route['admin/shopcategories/(:num)'] = "admin/ecommerce/ShopCategories/index/$1";
$route['admin/editshopcategorie'] = "admin/ecommerce/ShopCategories/editShopCategorie";
$route['admin/orders'] = "admin/ecommerce/orders";
$route['admin/orders/(:num)'] = "admin/ecommerce/orders/index/$1";
$route['admin/changeOrdersOrderStatus'] = "admin/ecommerce/orders/changeOrdersOrderStatus";
$route['admin/brands'] = "admin/ecommerce/brands";
$route['admin/changePosition'] = "admin/ecommerce/ShopCategories/changePosition";
$route['admin/discounts'] = "admin/ecommerce/discounts";
$route['admin/discounts/(:num)'] = "admin/ecommerce/discounts/index/$1";
// BLOG GROUP
$route['admin/blogpublish'] = "admin/blog/BlogPublish";
$route['admin/blogpublish/(:num)'] = "admin/blog/BlogPublish/index/$1";
$route['admin/blog'] = "admin/blog/blog";
$route['admin/blog/(:num)'] = "admin/blog/blog/index/$1";
// SETTINGS GROUP
$route['admin/settings'] = "admin/settings/settings";
$route['admin/styling'] = "admin/settings/styling";
$route['admin/templates'] = "admin/settings/templates";
$route['admin/titles'] = "admin/settings/titles";
$route['admin/pages'] = "admin/settings/pages";
$route['admin/emails'] = "admin/settings/emails";
$route['admin/emails/(:num)'] = "admin/settings/emails/index/$1";
$route['admin/history'] = "admin/settings/history";
$route['admin/history/(:num)'] = "admin/settings/history/index/$1";
// // ADVANCED SETTINGS
$route['admin/languages'] = "admin/advanced_settings/languages";
// $route['admin/filemanager'] = "admin/advanced_settings/filemanager";
$route['admin/adminusers'] = "admin/advanced_settings/adminusers";
// TEXTUAL PAGES
$route['admin/pageedit/(:any)'] = "admin/textual_pages/TextualPages/pageEdit/$1";
$route['admin/changePageStatus'] = "admin/textual_pages/TextualPages/changePageStatus";
// LOGOUT
$route['admin/logout'] = "admin/home/home/logout";
// $route['admin/logout'] = "admin/home/logout";
// Admin pass change ajax
// $route['admin/changePass'] = "admin/home/home/changePass";
$route['admin/uploadOthersImages'] = "admin/ecommerce/publish/do_upload_others_images";
$route['admin/loadOthersImages'] = "admin/ecommerce/publish/loadOthersImages";

$route['groove'] = "valiant/home";
$route['vvc'] = "valiant/index";
$route['vvc/login']= "valiant/index";
$route['vvc/home'] = "valiant/vcc_index";
$route['vvc/logout'] = "valiant/logout";
$route['vvc/register'] = "valiant/create";
$route['vvc/voting'] = "valiant/vote";
$route['vvc/voting/save'] = "valiant/saveVote";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
