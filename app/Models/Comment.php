<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Jan 2019 11:48:31 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Comment
 * 
 * @property int $id
 * @property string $text
 * @property \Carbon\Carbon $datetime
 * @property int $user_id
 * @property int $post_id
 * 
 * @property \App\Models\Post $post
 * @property \App\Models\User $user
 *
 * @package App\Models
 */
class Comment extends Eloquent
{
	protected $table = 'comment';
	public $timestamps = false;


	protected $fillable = [
		'text',
		'datetime',
		'user_id',
		'post_id'
	];

	public function post()
	{
		return $this->belongsTo(\App\Models\Post::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
