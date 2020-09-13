<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $post = Post::latest()->paginate(10)->appends(request()->except('page'));
        $tag = Tag::all();
        $category = Category::all();
        
        return view('index', compact('post', 'category', 'tag'));
    }
    
    public function post(Post $post)
    {
        $tag = Tag::all();
        $category = Category::all();
        
        return view('post', compact('post', 'category', 'tag'));
    }
    
    public function category(Category $category)
    {
        $post = Post::where('category_id', $category->id)->latest()->paginate(10)->appends(request()->except('page'));
        $tag = Tag::all();
        $category = Category::all();
        
        return view('index', compact('post', 'category', 'tag'));
    }
    
    public function tag(Tag $tag)
    {
        $post = Post::withAnyTags('baru')->latest()->paginate(10)->appends(request()->except('page'));
        $tag = Tag::all();
        $category = Category::all();
        
        return view('index', compact('post', 'category', 'tag'));
    }
}
