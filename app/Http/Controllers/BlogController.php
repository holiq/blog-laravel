<?php

namespace App\Http\Controllers;

use File;
use App\Post;
use App\Category;
use App\User;
use Spatie\Tags\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;

class BlogController extends Controller
{
    public function index()
    {
        $post = Post::latest()->paginate(10)->appends(request()->except('page'));
        $tags = Tag::all();
        $category = Category::all();
        $popular = Post::orderByDesc('views')->limit(5)->get();
        $featured = Post::where('featured', '=', 1)->limit(5)->get();
        
        return view('index', compact('post', 'category', 'tags', 'popular', 'featured'));
    }
    
    public function post(Post $post)
    {
        $desc = e(Str::limit(strip_tags($post->content), 200));
        SEOTools::metatags();
SEOTools::twitter();
SEOTools::opengraph();
SEOTools::jsonLd();

SEOTools::setTitle($post->title);
SEOTools::setDescription($desc);
SEOTools::setCanonical(URL::current());
SEOTools::addImages(url('images/post'.$post->thumbnail));

        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $post->category->name, 'property');
        SEOMeta::addKeyword($post->tags->pluck('name'));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addImage(['url' => url('images/post'.$post->thumbnail), 'size' => 300]);
        JsonLd::setType('Article');
        $tags = Tag::all();
        $category = Category::all();
        $popular = Post::orderByDesc('views')->limit(5)->get();
        $featured = Post::where('featured', '=', 1)->get();
        $related = Post::withAnyTags($post->tags)->where('id', '!=', $post->id)->limit(5)->get();
        $post->update([
            'views' => $post->views+1,
        ]);
        
        return view('post', compact('post', 'category', 'tags', 'popular', 'featured'));
    }
    
    public function category(Category $category)
    {
        $post = Post::where('category_id', $category->id)->latest()->paginate(10)->appends(request()->except('page'));
        $tags = Tag::all();
        $category = Category::all();
        $popular = Post::orderByDesc('views')->limit(5)->get();
        
        return view('index', compact('post', 'category', 'tags', 'popular'));
    }
    
    public function tag($slug)
    {
        $post = Post::withAnyTags($slug)->latest()->paginate(10)->appends(request()->except('page'));
        $tags = Tag::all();
        $category = Category::all();
        $popular = Post::orderByDesc('views')->limit(5)->get();
        
        return view('index', compact('post', 'category', 'tags', 'popular'));
    }

    public function user()
    {
        $users = User::paginate();
        return view('admin/users/index', compact('users'));
    }
}
