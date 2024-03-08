<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(){
        $title = "danh sách người dùng";
        $user = DB::select('SELECT * FROM users WHERE id');

        return view('users.lists', compact('title','user'));
    }
}
