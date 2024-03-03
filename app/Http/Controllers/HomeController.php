<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

    class HomeController extends Controller
    {
        public $data = [];
        public function index(){
            $this->data['welcome'] = 'Học lập trình laravel tại Unicode';
            $this->data['content'] = '<h3>Chương 1: Nhập môn laravel</h3>
            <p>Kiến thức 1</p>
            <p>Kiến thức 2</p>
            <p>Kiến thức 3</p>';
            $this->data['index'] = 0;
    
            $this->data['dataArr'] = [
                'Item 1',
                'Item 2',
                'Item 3'
            ];
    
            $this->data['number'] = 0;
            return view('home', $this->data);}
}
