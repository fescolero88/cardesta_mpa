<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function __construct()
    {

    }
    
    function index()
    {
        return view('admin/dashboard');
    }
}
