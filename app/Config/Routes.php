<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Alphawonders::index');
$routes->get('/home', 'Alphawonders::home');
$routes->get('/softwares', 'Alphawonders::alphasoftwares');
$routes->get('/system-administration', 'Alphawonders::alphasystems');
$routes->get('/design', 'Alphawonders::alphadesign');
$routes->get('/digital-marketing', 'Alphawonders::alphamarketing');
$routes->get('/ict-consultancy', 'Alphawonders::alphaconsultancy');
$routes->get('/it-support', 'Alphawonders::alphasupport');
$routes->get('/ai-services', 'Alphawonders::alphaiservices');
$routes->get('/hire', 'Alphawonders::alphahires');
$routes->get('/contact-us', 'Alphawonders::contact');
$routes->post('/contact-us', 'Alphawonders::send_contact_data');
$routes->post('/subscribe', 'Alphawonders::subscriptions_email');
$routes->post('/hire-submit', 'Alphawonders::hires_details');

// Blog routes
$routes->get('/blog', 'Alphawonders::alphablog');
$routes->get('/blog/category/(:segment)', 'Alphawonders::blogCategory/$1');
$routes->post('/blog/comment', 'Alphawonders::post_comments');
$routes->get('/blog/(:segment)', 'Alphawonders::blogPost/$1');

// Admin/Dashboard routes - using ambiguous paths for security
$routes->get('/aw-cp', 'Dashboard::admin');
$routes->get('/aw-cp/services', 'Dashboard::services');
$routes->get('/aw-cp/messages', 'Dashboard::messages');
$routes->get('/aw-cp/blog', 'Dashboard::blog');
$routes->get('/aw-cp/blog/create', 'Dashboard::blogCreate');
$routes->post('/aw-cp/blog/save', 'Dashboard::blogSave');
$routes->get('/aw-cp/blog/edit/(:num)', 'Dashboard::blogEdit/$1');
$routes->post('/aw-cp/blog/update/(:num)', 'Dashboard::blogUpdate/$1');
$routes->get('/aw-cp/blog/delete/(:num)', 'Dashboard::blogDelete/$1');
$routes->get('/aw-cp/users_analytics', 'Dashboard::users_analytics');
$routes->get('/aw-cp/visits_analytics', 'Dashboard::visits_analytics');
$routes->get('/aw-cp/interactions_analytics', 'Dashboard::interactions_analytics');
$routes->get('/aw-cp/products', 'Dashboard::products');
$routes->get('/aw-cp/settings', 'Dashboard::settings');

// Legacy admin routes (redirect to new ambiguous routes for backward compatibility)
$routes->get('/admin', function() {
    return redirect()->to(base_url('aw-cp'));
});
$routes->get('/dashboard/admin', function() {
    return redirect()->to(base_url('aw-cp'));
});
$routes->get('/dashboard/admin/(:any)', function($segment) {
    return redirect()->to(base_url('aw-cp/' . $segment));
});
