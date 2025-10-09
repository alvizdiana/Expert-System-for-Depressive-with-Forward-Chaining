<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        helper('auth');
    }

    public function index(): string
    {
        return view('home');
    }
}
