<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('aw-cp'));
        }

        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $db = \Config\Database::connect();
            $user = $db->table('admin_users')
                       ->where('username', $username)
                       ->where('is_active', true)
                       ->get()
                       ->getRowArray();

            if ($user && password_verify($password, $user['password_hash'])) {
                session()->set([
                    'isLoggedIn' => true,
                    'userId'     => $user['id'],
                    'username'   => $user['username'],
                    'fullName'   => $user['full_name'],
                    'userRole'   => $user['role'],
                ]);

                $db->table('admin_users')
                   ->where('id', $user['id'])
                   ->update(['last_login' => date('Y-m-d H:i:s')]);

                return redirect()->to(base_url('aw-cp'));
            }

            return redirect()->to(base_url('aw-cp/login'))
                             ->with('error', 'Invalid username or password.');
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
