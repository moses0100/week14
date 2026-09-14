<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class AdminController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blogs()
    {
        $blogs = Blog::latest()->paginate(5);
        return view('blogs', compact('blogs'));
    }

    public function abouts()
    {
        $name = 'Tanawat';
        $date = '6 กรกฏาคม 2026';

        return view('abouts', compact('name', 'date'));
    }

    public function create()
    {
        return view('form');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ], [
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณากรอกเนื้อหา',
        ]);

        Blog::create($request->only(['title', 'content']));

        return redirect()->route('author.blogs');
    }

    public function delete($id)
    {
        Blog::findOrFail($id)->delete();

        return redirect()->route('author.blogs');
    }

    public function change($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = !$blog->status;
        $blog->save();

        return redirect()->route('author.blogs');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ], [
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'ชื่อบทความต้องไม่เกิน 50 ตัวอักษร',
            'content.required' => 'กรุณากรอกเนื้อหา',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('author.blogs');
    }
}
