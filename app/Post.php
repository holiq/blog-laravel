<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
	
	/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    protected $fillable = [
        'title', 'slug', 'category_id', 'user_id', 'thumbnail', 'content', 'views',
    ];
    
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //buat count comment di index
    public function countComment()
    {
        return $this->hasMany(Comment::class, 'commentable_id');
    }
    //buat comment & reply di diskusi
    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
    
}
