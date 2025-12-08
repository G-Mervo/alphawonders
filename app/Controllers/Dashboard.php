<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function admin()
    {
        $data['title'] = 'Dashboard | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/index', $data) . 
               view('dashboard/inc/footer');
    }

    public function services()
    {
        $data['title'] = 'Services Management | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/services', $data) . 
               view('dashboard/inc/footer');
    }

    public function messages()
    {
        $data['title'] = 'Messages | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/messages', $data) . 
               view('dashboard/inc/footer');
    }

    public function blog()
    {
        $data['title'] = 'Blog Management | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/blog', $data) . 
               view('dashboard/inc/footer');
    }

    public function users_analytics()
    {
        $data['title'] = 'Users Analytics | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/analytics/users', $data) . 
               view('dashboard/inc/footer');
    }

    public function visits_analytics()
    {
        $data['title'] = 'Visits Analytics | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/analytics/visits', $data) . 
               view('dashboard/inc/footer');
    }

    public function interactions_analytics()
    {
        $data['title'] = 'Interactions Analytics | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/analytics/interactions', $data) . 
               view('dashboard/inc/footer');
    }

    public function products()
    {
        $data['title'] = 'Products | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/products', $data) . 
               view('dashboard/inc/footer');
    }

    public function settings()
    {
        $data['title'] = 'Settings | Alphawonders';
        
        return view('dashboard/inc/header', $data) . 
               view('dashboard/settings', $data) . 
               view('dashboard/inc/footer');
    }
}

