<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return $this->response->renderView('auth/login');
    }

    public function login()
    {
        $csrf = $this->request->post('csrf_token');
        if (!$csrf || $csrf !== $_SESSION['csrf_token']) {
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
        // Límite de intentos fallidos
        $attempts = $_SESSION['login_attempts'] ?? 0;
        $lastAttempt = $_SESSION['last_attempt_time'] ?? 0;
        if ($attempts >= 5 && (time() - $lastAttempt) < 900) {
            header('HTTP/1.1 429 Too Many Requests');
            return $this->response->renderView('auth/login', ['error' => 'Demasiados intentos. Intente de nuevo en 15 minutos.']);
        }
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $userModel = new User();
        $user = $userModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            // Incrementar intentos fallidos
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            $_SESSION['last_attempt_time'] = time();
            return $this->response->renderView('auth/login', ['error' => 'Credenciales inválidas']);
        }
        session_regenerate_id(true);
        unset($_SESSION['login_attempts'], $_SESSION['last_attempt_time']);
        $_SESSION['user'] = $user['id'];
        $this->response->redirect('/dashboard');
    }

    public function registerForm()
    {
        return $this->response->renderView('auth/register');
    }

    public function register()
    {
        $csrf = $this->request->post('csrf_token');
        if (!$csrf || $csrf !== $_SESSION['csrf_token']) {
            header('HTTP/1.1 403 Forbidden');
            exit;
        }
        $name = $this->request->post('name');
        $email = $this->request->post('email');
        $password = password_hash($this->request->post('password'), PASSWORD_BCRYPT);

        $uuid = $this->generateUuid();

        $userModel = new User();
        try {
            $userModel->create([
                'id' => $uuid,
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
        } catch (\PDOException $e) {
            if ($e->getCode() === '23505') {
                return $this->response->renderView('auth/register', ['error' => 'El email ya está registrado']);
            }
            throw $e;
        }

        $this->response->redirect('/');
    }

    private function generateUuid(): string
    {
        $data = random_bytes(16);
        // set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}