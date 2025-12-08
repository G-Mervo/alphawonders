<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Alphawonders::index');

// Service routes
$routes->get('softwares', 'Alphawonders::alphasoftwares');
$routes->get('system-administration', 'Alphawonders::alphasystems');
$routes->get('digital-marketing', 'Alphawonders::alphamarketing');
$routes->get('design', 'Alphawonders::alphadesign');
$routes->get('ict-consultancy', 'Alphawonders::alphaconsultancy');
$routes->get('it-support', 'Alphawonders::alphasupport');

// Contact routes
$routes->get('contact-us', 'Alphawonders::contact');
$routes->post('send', 'Alphawonders::send_contact_data');

// Hire routes
$routes->get('hire', 'Alphawonders::alphahires');
$routes->post('hires', 'Alphawonders::hires_details');

// Subscription
$routes->post('subscribe', 'Alphawonders::subscriptions_email');

// Blog routes
$routes->get('blog', 'Alphawonders::alphablog');
$routes->get('post', 'Alphawonders::alphapost');
$routes->post('post-comments', 'Alphawonders::post_comments');

// Blog post routes with slugs
$routes->get('blog/(:segment)', 'Blog::viewPost/$1');
$routes->get('blog/introduction-to-quantum-computers', 'Blog::qtm_comp');
$routes->get('blog/data-science-building-a-career-in-data-analytics', 'Blog::dtsci');
$routes->get('blog/privacy-policies-more-data-regulations', 'Blog::privacy');
$routes->get('blog/what-is-robotics', 'Blog::robotics');

