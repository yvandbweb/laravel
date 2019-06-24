<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Jan 2019 11:48:31 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $nameuser
 * @property \Carbon\Carbon $datetime
 * 
 * @property \Illuminate\Database\Eloquent\Collection $comments
 * @property \Illuminate\Database\Eloquent\Collection $posts
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $table = 'user';
	public $timestamps = false;


	protected $fillable = [
		'nameuser',
		'datetime'
	];

	public function comments()
	{
		return $this->hasMany(\App\Models\Comment::class);
	}

	public function posts()
	{
		return $this->hasMany(\App\Models\Post::class);
	}
}
