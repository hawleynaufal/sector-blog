<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Blog;

class PostController extends Controller
{
    public function getSingle($slug){
        //detching data
        $blog = Blog::where('slug','=',$slug)->first();
        $single= Blog::all();
        //return view
        return view ('post.single')->with('single',$blog);

    }
}
