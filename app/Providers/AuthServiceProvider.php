<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
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
        // You can link the Post policy here if you have one, otherwise we'll use Gate directly
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define a Gate for editing posts
        Gate::define('edit-post', function (User $user, Post $post) {
            return $user->id === $post->user_id || $user->hasRole('admin');
        });

        // Define a Gate for deleting posts
        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->id === $post->user_id || $user->hasRole('admin');
        });
    }
}
