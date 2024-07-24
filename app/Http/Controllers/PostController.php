<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;

class PostController extends Controller
{

    public function show ($id){
        $post=Post::find($id);
        return view('post.show',compact('post'));
    }

    public function index(){
        $posts=Post::where('user_id' , auth()->id())->get();
        return view('post.index',compact('posts'));
    }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){
        Gate::authorize('test');

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        $request->session()->flash('message','保存しました');


        return back();
    }

}
