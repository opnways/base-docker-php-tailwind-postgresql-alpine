<?php
namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $this->response->redirect('/');
            exit;
        }
        return $this->response->renderView('dashboard/index');
    }
}