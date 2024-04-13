<?php

namespace App\Controllers;

class InicioController extends BaseController
{
    public function index(): string
    {
        return view('inicio/index');
    }
}
