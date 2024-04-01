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
        // $post = new Post;
        // $post->title = "bai viet 3";
        // $post->content = "noi dung bai vbiet 3";
        // $post->status = 1;
        // $post->save();

        echo '<h2>Post ORM</h2>';
        // $allPost = Post::all();
        // if($allPost->count() > 0){
        //     foreach($allPost as $post){
        //         echo '<h2>' . $post->title . '</h2>';
        //     }
        // }
            // $detail = Post::find(1);
            // dd($detail);
        // $activePost = Post::where('status',1)->orderBy('id','DESC')->get();
    
        // dd($activePost);
        
        // $allPost = Post::all();
        // $activePost = $allPost->reject(function($post){
        //     return $post->status =0;
        // });

        // dd($activePost);
        Post::chunk(2, function ($posts){
            foreach($posts as $post){
                echo '<h2>' . $post->title . '</h2>';
            }
            echo 'ket thuc chuk';
        });
        $allPost = Post::where('status',1)->cursor();
        foreach ($allPost as $post){
            echo $post->title;
        }
    }
}
