<?php

namespace App\Http\Controllers;

use File;
use App\Post;
use App\Category;
use Spatie\Tags\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() {
        $post = Post::paginate(10);

        return view('admin.post.index', compact('post'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
        $tag = Tag::all();
        $category = Category::all();
        // dd($tag);

        return view('admin.post.create', compact('category', 'tag'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param    \Illuminate\Http\Request    $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:100',
            'category_id' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
        ]);

        $id = Auth::user()->id;
        if ($request->hasFile('thumbnail')) {
            $tumbnail = time().'.'.$request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/post'), $tumbnail);
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'featured' => $request->featured ? true:false,
            'category_id' => $request->category_id,
            'user_id' => $id,
            'thumbnail' => $tumbnail,
            'content' => $request->content,
            'status' => $request->status,
            'views' => '0',
        ]);
        $post->syncTags($request->tag);

        return redirect()->route('posts.index')->with('success', 'Post successfully');
    }

    /**
    * Display the specified resource.
    *
    * @param    int    $id
    * @return \Illuminate\Http\Response
    */
    public function show($id) {
        $post = Post::findOrFail($id);
        
        return view('admin.post.show', compact('post'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param    int    $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param    \Illuminate\Http\Request    $request
    * @param    int    $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id) {
        $this->validate($request, [

        ]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param    int    $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id) {
        $post = Post::findOrFail($id);
        preg_match_all('/<img src=\"(.*?)\"/', $post->content, $results);

        foreach ($results[1] as $result) {
            $name = explode("/", $result);
            $file = end($name);
            File::delete(public_path('/images/post/'.$file));
        }
        File::delete(public_path('/images/post/'.$post->thumbnail));
        $post->delete();

        return redirect()->back()->with('success', $post->title.' deleted');
    }
}