<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
				'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

		//One user has many posts.
		public function posts(): HasMany
		{
			 return $this->hasMany(Post::class);
		}

		//one user has many comments.
		public function comments(): HasMany
		{
			return $this->HasMany(Comment::class);
		}
		/**
		 * one user can have many favorite posts
		 */
		public function favoritePosts(): BelongsToMany
		{
			return $this->belongsToMany(Post::class, 'user_favorite_posts', 'user_id', 'post_id')
										->as('favoritePosts')
										->withTimestamps()
										->orderByPivot('created_at', 'desc');
		}
}
