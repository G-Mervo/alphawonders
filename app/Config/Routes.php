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
$routes->get('/hire', 'Alphawonders::alphahires');
$routes->get('/contact-us', 'Alphawonders::contact');
$routes->post('/contact-us', 'Alphawonders::send_contact_data');
$routes->post('/subscribe', 'Alphawonders::subscriptions_email');
$routes->post('/hire-submit', 'Alphawonders::hires_details');
$routes->get('/blog', 'Alphawonders::alphablog');
$routes->get('/blog/post', 'Alphawonders::alphapost');
$routes->post('/blog/comment', 'Alphawonders::post_comments');
