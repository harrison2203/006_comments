<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

		protected $fillable = [
			'commentary',
		];

		/**
		 * A comment is related to one User
		 */
		public function user(): BelongsTo
		{
			return $this->belongsTo(User::class);
		}

		/**
		 * A comment is related to one Post
		 */
		public function post(): BelongsTo
		{
			return $this->belongsTo(Post::class, 'post_id');
		}
}
