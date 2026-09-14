<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
       $blogs= Blog::orderByDesc('id')->where('status', '1')->get();
        return view('index', compact("blogs"));
   }

    public function detail($id)
    {
        $blog = Blog::find($id);
        return view('detail', compact("blog"));
    }
}