<?php

namespace App\Controllers;

class Auth extends BaseController
{
    private const MAX_ATTEMPTS = 5;
    private const LOCKOUT_MINUTES = 15;

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('aw-cp'));
        }

        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            helper('geoip');
            $ip = real_client_ip();
            $userAgent = $this->request->getUserAgent()->getAgentString();

            $db = \Config\Database::connect();

            // Check if IP is locked out from too many failed attempts
            $recentFailures = $db->table('login_attempts')
                ->where('ip_address', $ip)
                ->where('success', false)
                ->where('attempted_at >=', date('Y-m-d H:i:s', strtotime('-' . self::LOCKOUT_MINUTES . ' minutes')))
                ->countAllResults();

            if ($recentFailures >= self::MAX_ATTEMPTS) {
                $this->logAttempt($db, $username, $ip, $userAgent, false, 'IP locked out');
                return redirect()->to(base_url('aw-cp/login'))
                    ->with('error', 'Too many failed login attempts. Please try again in ' . self::LOCKOUT_MINUTES . ' minutes.');
            }

            $user = $db->table('admin_users')
                       ->where('username', $username)
                       ->get()
                       ->getRowArray();

            if (!$user) {
                $this->logAttempt($db, $username, $ip, $userAgent, false, 'User not found');
                return redirect()->to(base_url('aw-cp/login'))
                                 ->with('error', 'Invalid username or password.');
            }

            if (!$user['is_active']) {
                $this->logAttempt($db, $username, $ip, $userAgent, false, 'Account disabled');
                return redirect()->to(base_url('aw-cp/login'))
                                 ->with('error', 'Invalid username or password.');
            }

            if (!password_verify($password, $user['password_hash'])) {
                $this->logAttempt($db, $username, $ip, $userAgent, false, 'Wrong password');
                return redirect()->to(base_url('aw-cp/login'))
                                 ->with('error', 'Invalid username or password.');
            }

            // Successful login
            $this->logAttempt($db, $username, $ip, $userAgent, true);

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

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    private function logAttempt($db, string $username, string $ip, ?string $userAgent, bool $success, ?string $reason = null): void
    {
        try {
            $db->table('login_attempts')->insert([
                'username'       => substr($username, 0, 100),
                'ip_address'     => $ip,
                'user_agent'     => $userAgent ? substr($userAgent, 0, 500) : null,
                'success'        => $success,
                'failure_reason' => $reason,
                'attempted_at'   => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'Failed to log login attempt: ' . $e->getMessage());
        }
    }
}
