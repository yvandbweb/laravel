<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 29 Jan 2019 11:48:31 +0000.
 */

namespace App\Models;
use DB; 

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Post
 * 
 * @property int $id
 * @property string $txt
 * @property int $user_id
 * @property \Carbon\Carbon $datetime
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $comments
 *
 * @package App\Models
 */
class Post extends Eloquent
{
	protected $table = 'post';
	public $timestamps = false;

	protected $fillable = [
		'txt',
		'user_id',
		'datetime'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
        
        public function scopeFindposts($query,$offset1,$steps1){

            $result = Post::
                            offset($offset1)
                            ->limit($steps1)
                            ->orderBy('post.datetime','DESC')
                            ->get();            


            return $result;


        }        
        

        public function scopeTotalPosts(){
            return (int)DB::table('post')->count();
        }        
}
