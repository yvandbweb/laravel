<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\Comment;
use \App\Models\User;

class Index extends Controller
{
    private $req;
    function __construct(Request $request){
        $this->req=$request;    
    }
    
    public function first()
    {
        $vararr=array();     
         
        $offset=0;
        $vararr["steps"]=4;
        $vararr["totalrest"]=ceil(Post::TotalPosts()/$vararr["steps"]);    
        $vararr["i1"]=1;
        $vararr["total"]=Post::TotalPosts();            

        if ($this->req->has("i1")){        
            $vararr["i1"]=$this->req->get("i1");
            $offset = ($vararr["i1"] - 1) * $vararr["steps"];             
        }
        
                                 
        $vararr["posts"] = Post::Findposts($offset,$vararr["steps"]);
        
        //dd($vararr["posts"]);
        
        return view('Index.first', ['vararr' => $vararr]);
    }
    
    public function addcomment()
    {
        $vararr["id"]=$this->req->get("id");
        $vararr["users"] = User::all();
        return view('Index.addcomment', array("vararr"=>$vararr));
    }     
    
    public function addformcoment()
    {
        $vararr=array();               

        $validate=$this->req->validate([
            'text' => 'required'
        ]);
        
        //$dd($validate);
   
        if ($validate){
            $comment=new Comment();
            $user = User::findOrFail($this->req->get("user"));
            $post = Post::findOrFail($this->req->get("id"));

            $comment->user()->associate($user);
            $comment->post()->associate($post);
            $comment->datetime=new \DateTime();
            $comment->text=$this->req->get('text');
            //$comment->save();                   
            
            return response()->json(array('saved' => true,
                'text'=>$comment->text,'user'=>$comment->user->nameuser,'idcom'=>$comment->id,'datetime'=>$comment->datetime->format('Y-m-d H:i:s')
            )); 
         }                 
    }        
    
    public function addpost()
    {
        $vararr["users"] = User::all();

        return view('Index.addpost', ['vararr' => $vararr]);
    } 
    
    public function addformpost()
    {
        $validate=$this->req->validate([
            'txt' => 'required'
        ]);
        if ($validate){
            $input = $this->req->all();
            $input["datetime"]=new \DateTime();
            //Post::create($input);
            return redirect()->route('default');
        }
    }     
    
    
    public function adduser()
    {
        return view('Index.adduser', ['user' => null]);
    } 
    
    
    public function addformuser()
    {
        $validate=$this->req->validate([
            'nameuser' => 'required'
        ]);
        if ($validate){
            $input = $this->req->all();
            //$input["datetime"]=new \DateTime();
            User::create($input);
            return redirect()->route('default');
        }
    }     
    
    
 
    public function deletecomment()
    {
        
        //Comment::destroy($this->req->get("id"));
        
        return redirect()->route('default');

        
    }   
        

    public function deletepost()
    {       

        $post = Comment::where('post_id', $this->req->get("id"));
        
        //$post->delete();

        Post::destroy($this->req->get("id"));
        
        return redirect()->route('default');
        
    }     
    
}
