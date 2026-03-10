<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/sitemap.xml', 'Alphawonders::sitemap');
$routes->get('/', 'Alphawonders::index');
$routes->get('/home', 'Alphawonders::home');
$routes->get('/softwares', 'Alphawonders::alphasoftwares');
$routes->get('/system-administration', 'Alphawonders::alphasystems');
$routes->get('/design', 'Alphawonders::alphadesign');
$routes->get('/seo', 'Alphawonders::alphamarketing');
$routes->get('/ict-consultancy', 'Alphawonders::alphaconsultancy');
$routes->get('/it-support', 'Alphawonders::alphasupport');
$routes->get('/ai-services', 'Alphawonders::alphaiservices');
$routes->get('/hire', 'Alphawonders::alphahires');
$routes->get('/contact-us', 'Alphawonders::contact');
$routes->post('/contact-us', 'Alphawonders::send_contact_data');
$routes->get('/privacy-policy', 'Alphawonders::privacyPolicy');
$routes->get('/terms-of-service', 'Alphawonders::termsOfService');
$routes->post('/subscribe', 'Alphawonders::subscriptions_email');
$routes->post('/hire-submit', 'Alphawonders::hires_details');

// Blog routes
$routes->get('/blog', 'Alphawonders::alphablog');
$routes->get('/blog/category/(:segment)', 'Alphawonders::blogCategory/$1');
$routes->get('/blog/tag/(:segment)', 'Alphawonders::blogTag/$1');
$routes->post('/blog/comment', 'Alphawonders::post_comments');
$routes->get('/blog/(:segment)', 'Alphawonders::blogPost/$1');

// Auth routes (outside auth filter)
$routes->get('/aw-cp/login', 'Auth::login');
$routes->post('/aw-cp/login', 'Auth::login');
$routes->get('/aw-cp/logout', 'Auth::logout');

// Admin/Dashboard routes - using ambiguous paths for security
$routes->get('/aw-cp', 'Dashboard::admin');
$routes->get('/aw-cp/services', 'Dashboard::services');
$routes->get('/aw-cp/services/preview/(:segment)', 'Dashboard::servicePreview/$1');
$routes->get('/aw-cp/messages', 'Dashboard::messages');
$routes->get('/aw-cp/blog', 'Dashboard::blog');
$routes->get('/aw-cp/blog/create', 'Dashboard::blogCreate');
$routes->post('/aw-cp/blog/save', 'Dashboard::blogSave');
$routes->get('/aw-cp/blog/edit/(:num)', 'Dashboard::blogEdit/$1');
$routes->post('/aw-cp/blog/update/(:num)', 'Dashboard::blogUpdate/$1');
$routes->get('/aw-cp/blog/delete/(:num)', 'Dashboard::blogDelete/$1');
$routes->post('/aw-cp/blog/category/store', 'Dashboard::categoryStore');
$routes->get('/aw-cp/blog/preview/(:num)', 'Dashboard::blogPreview/$1');
$routes->post('/aw-cp/blog/preview-unsaved', 'Dashboard::blogPreviewUnsaved');
$routes->get('/aw-cp/users_analytics', 'Dashboard::users_analytics');
$routes->get('/aw-cp/visits_analytics', 'Dashboard::visits_analytics');
$routes->get('/aw-cp/interactions_analytics', 'Dashboard::interactions_analytics');
$routes->get('/aw-cp/products', function() {
    return redirect()->to(base_url('aw-cp/github'));
});
$routes->get('/aw-cp/login-attempts', 'Dashboard::loginAttempts');
$routes->get('/aw-cp/settings', 'Dashboard::settings');
$routes->post('/aw-cp/settings', 'Dashboard::settings');
$routes->post('/aw-cp/settings/save-field', 'Dashboard::settingsSaveField');
$routes->post('/aw-cp/change-password', 'Dashboard::changePassword');

// Social Media Hub
$routes->get('/aw-cp/social', 'SocialMedia::index');
$routes->get('/aw-cp/social/create', 'SocialMedia::create');
$routes->get('/aw-cp/social/create/(:segment)', 'SocialMedia::create/$1');
$routes->post('/aw-cp/social/save', 'SocialMedia::save');
$routes->get('/aw-cp/social/edit/(:num)', 'SocialMedia::edit/$1');
$routes->post('/aw-cp/social/update/(:num)', 'SocialMedia::update/$1');
$routes->get('/aw-cp/social/delete/(:num)', 'SocialMedia::delete/$1');
$routes->get('/aw-cp/social/from-blog/(:num)', 'SocialMedia::generateFromBlog/$1');
$routes->post('/aw-cp/social/bulk-generate', 'SocialMedia::bulkGenerate');

// Content Calendar
$routes->get('/aw-cp/calendar', 'ContentCalendar::index');
$routes->get('/aw-cp/calendar/events', 'ContentCalendar::getEvents');
$routes->post('/aw-cp/calendar/add', 'ContentCalendar::addEvent');
$routes->post('/aw-cp/calendar/update/(:num)', 'ContentCalendar::updateEvent/$1');
$routes->get('/aw-cp/calendar/delete/(:num)', 'ContentCalendar::deleteEvent/$1');

// Hires/Projects management
$routes->get('/aw-cp/hires', 'Dashboard::hires');
$routes->get('/aw-cp/hires/view/(:num)', 'Dashboard::hireView/$1');
$routes->post('/aw-cp/hires/update/(:num)', 'Dashboard::hireUpdateStatus/$1');
$routes->get('/aw-cp/hires/spam/(:num)', 'Dashboard::hireToggleSpam/$1');

// Messages management
$routes->get('/aw-cp/messages/toggle/(:num)', 'Dashboard::messageToggleRead/$1');
$routes->get('/aw-cp/messages/delete/(:num)', 'Dashboard::messageDelete/$1');

// Subscribers
$routes->get('/aw-cp/subscribers', 'Dashboard::subscribers');
$routes->get('/aw-cp/subscribers/view/(:num)', 'Dashboard::subscriberView/$1');
$routes->get('/aw-cp/subscribers/spam/(:num)', 'Dashboard::subscriberToggleSpam/$1');
$routes->get('/aw-cp/subscribers/delete/(:num)', 'Dashboard::subscriberDelete/$1');

// Comments Management
$routes->get('/aw-cp/comments', 'Dashboard::comments');
$routes->get('/aw-cp/comments/spam/(:num)', 'Dashboard::commentToggleSpam/$1');
$routes->get('/aw-cp/comments/delete/(:num)', 'Dashboard::commentDelete/$1');
$routes->post('/aw-cp/comments/reply/(:num)', 'Dashboard::commentReply/$1');

// AI endpoints (Groq)
$routes->post('/aw-cp/ai/generate-blog', 'Dashboard::aiGenerateBlog');
$routes->post('/aw-cp/ai/suggest-title', 'Dashboard::aiSuggestTitle');
$routes->post('/aw-cp/ai/suggest-slug', 'Dashboard::aiSuggestSlug');
$routes->post('/aw-cp/ai/suggest-category', 'Dashboard::aiSuggestCategory');
$routes->post('/aw-cp/ai/draft-reply', 'Dashboard::aiDraftReply');
$routes->post('/aw-cp/ai/project-insights', 'Dashboard::aiProjectInsights');
$routes->post('/aw-cp/ai/generate-social', 'Dashboard::aiGenerateSocial');
$routes->post('/aw-cp/ai/generate-all-social', 'Dashboard::aiGenerateAllSocial');
$routes->post('/aw-cp/ai/generate-video-script', 'Dashboard::aiGenerateVideoScript');
$routes->post('/aw-cp/ai/suggest-hashtags', 'Dashboard::aiSuggestHashtags');
$routes->post('/aw-cp/ai/generate-meta-description', 'Dashboard::aiGenerateMetaDescription');
$routes->post('/aw-cp/ai/repurpose-content', 'Dashboard::aiRepurposeContent');

// GitHub Projects
$routes->get('/aw-cp/github', 'Dashboard::github');
$routes->get('/aw-cp/github/create', 'Dashboard::githubCreateRepo');
$routes->post('/aw-cp/github/create', 'Dashboard::githubCreateRepo');
$routes->get('/aw-cp/github/repo/(:segment)/(:segment)', 'Dashboard::githubRepo/$1/$2');
$routes->get('/aw-cp/github/repo/(:segment)/(:segment)/issues/create', 'Dashboard::githubCreateIssue/$1/$2');
$routes->post('/aw-cp/github/repo/(:segment)/(:segment)/issues/create', 'Dashboard::githubCreateIssue/$1/$2');
$routes->get('/aw-cp/github/repo/(:segment)/(:segment)/releases/create', 'Dashboard::githubCreateRelease/$1/$2');
$routes->post('/aw-cp/github/repo/(:segment)/(:segment)/releases/create', 'Dashboard::githubCreateRelease/$1/$2');

// Microapps
$routes->get('/aw-cp/microapps', 'Dashboard::microapps');
$routes->get('/aw-cp/microapps/(:segment)', 'Dashboard::microappPreview/$1');

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
