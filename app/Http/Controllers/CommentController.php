<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use voku\helper\AntiXSS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Spatie\Honeypot\ProtectAgainstSpam;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
        if(Auth::check() == false) {
            $this->middleware(ProtectAgainstSpam::class)->only('store');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if(!Auth::check()) {
            $guest = [
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|string|email|max:255',
            ];
        }
        $this->validate($request, array_merge($guest ?? [], [
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|string|min:1',
            'content' => 'required|string',
        ]));
        
        if(Auth::check()){
            $auth = [
                'user_id' => Auth::user()->id,
                'parent_id' => $request->parent_id ?? NULL,
            ];
        }else{
            $guest = [
                'guest_name' => $request->guest_name,
                'guest_email' => $request->guest_email,
            ];
        }
        
        $skeleton = array_merge($auth ?? $guest, [
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
            'content' => $request->content,
        ]);
        $comment = Comment::create($skeleton);
        
        return Redirect::to(URL::previous() . '#comment-' . $comment->getKey());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required|string',
        ]);
        
        $comment = Comment::findOrFail($id);
        $comment->update([
            'content' => $request->content,
        ]);
        
        return Redirect::to(URL::previous() . '#comment-' . $comment->getKey());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
