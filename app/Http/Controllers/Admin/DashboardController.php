<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        // echo 'Starting Dashboard';
        //return 'Khởi động';
        //check login bang  session

    }
    public function index(){
        return '<h2> Dashboard Welcome</h2>';
    }
}
