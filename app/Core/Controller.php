<?php
namespace App\Core;

use App\Core\Request;
use App\Core\Response;

class Controller
{
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }
}