<?php

namespace App\Providers;

use App\Comment;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Comment' => 'App\Policies\CommentPolicy',
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-comment', function($user, $comment) {
            return $user->getKey() == $comment->user_id;
         });

        Gate::define('delete-comment', function($user, $comment) {
            return $user->getKey() == $comment->user_id;
         });

        Gate::define('reply-comment', function($user, $comment) {
            return $user->getKey() != $comment->user_id;
         });
    }
}
