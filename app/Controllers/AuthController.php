<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function registerForm()
    {
        return $this->response->renderView('auth/register');
    }

    public function register()
    {
        $name = $this->request->post('name');
        $email = $this->request->post('email');
        $password = password_hash($this->request->post('password'), PASSWORD_BCRYPT);

        $uuid = $this->generateUuid();

        $userModel = new User();
        $userModel->create([
            'id' => $uuid,
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

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