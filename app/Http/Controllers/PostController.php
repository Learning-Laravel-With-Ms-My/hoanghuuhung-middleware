<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    //
    public function index(){
        // $allPost = Post::all();
        // dd($allPost);
        // $post  = Post::find('c1');
        // dd($post);
        $post = new Post;
        $post->title = "bai viet 3";
        $post->content = "noi dung bai vbiet 3";
        $post->status = 1;
        $post->save();
    }
}
