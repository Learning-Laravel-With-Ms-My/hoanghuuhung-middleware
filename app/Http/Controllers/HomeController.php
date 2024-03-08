<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
    class HomeController extends Controller
    {
        public $data = [];
        public function index(){
            $this->data['title'] = 'Đào tạo lập trình';

            // $user = DB::select('SELECT * FROM users WHERE id > ?',[1]);
            // dd($user);
            return view('clients.home', $this->data);
        }
        public function products(){
            $this->data['title'] = 'Sản phẩm';
            return view('clients.products', $this->data);}
        public function getAdd(){
            $this->data['title'] = 'Them Sản phẩm';

            return view('clients.add', $this->data);
        }
        public function postAdd(Request $request){
            dd($request);
        }
        public function putAdd(Request $request){
            dd($request);
        }
}
