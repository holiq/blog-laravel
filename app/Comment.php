<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'parent_id', 'user_id', 'guest_name', 'guest_email', 'content', 'commentable_id', 'commentable_type', 
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    
    function getTitle()
    {
    	return $this->hasMany(Discussion::class, 'id', 'commentable_id');
	}
	
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
