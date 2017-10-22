<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public  function getIndex()
    {
        $post=Post::paginate(3);
        return view('blog.index',compact('post'));
    }
    public function getSingle($slug)
    {
        $post=Post::where('slug','=',$slug)->first();
        return view('blog.single',compact('post'));
    }

}
