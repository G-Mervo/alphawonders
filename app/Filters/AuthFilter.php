<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = $request->getUri()->getPath();

        // Don't protect login/logout routes
        if (in_array(ltrim($uri, '/'), ['aw-cp/login', 'aw-cp/logout'])) {
            return;
        }

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('aw-cp/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No-op
    }
}
