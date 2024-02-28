<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
class HomeController extends Controller
{
    //
    public function index(){
        $title = "học lập trình";
        $content  = "phải học được lập trình";
        // $dataView = [
        //     'title' => $title,
        //     'content' => $content,
        // ];
        // compact('title', 'content')
        // ->with('title', $title)->with('content', $content
        return view('home')->with(['title'=>$title ,'content'=> $content]);
            // return View::make('home',compact('title', 'content'));
        // $contentView = view('home')->render();
        // // $contentView = $contentView->render();
        //     dd($contentView);
    }
    public function getProductDetails($id){
        return view('clients.products.detail',compact('id'));
    }
}
