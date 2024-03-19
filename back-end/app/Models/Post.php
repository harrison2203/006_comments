<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
		use HasFactory;

		protected $fillable = [
			'title',
			'content',
		];

		/**
		 * Get the user than owns the post (one post belongs to one user)
		 */
		public function user(): BelongsTo
		{
			return $this->belongsTo(User::class, 'user_id')->select('id', 'name');
		}

		/**
		 * A post can have many comments
		 */
		public function comments(): HasMany
		{
			return $this-> hasMany(Comment::class, 'post_id');
		}
		/**
		 * one favorite post can have many users
		 */
		public function users(): BelongsToMany
		{
			return $this->belongsToMany(User::class, 'user_favorite_posts','post_id', 'user_id');
		}
}


