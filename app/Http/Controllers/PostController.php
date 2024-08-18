<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Services\PokeApiService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $pokeApiService;

    public function __construct(PokeApiService $pokeApiService)
    {
        $this->pokeApiService = $pokeApiService;
    }

    public function index(Request $request)
    {
        $posts = Post::latest()->paginate(10);
        $pokemonName = $request->input('pokemon_name');
        $pokemonData = null;

        if ($pokemonName) {
            $pokemonData = $this->pokeApiService->getPokemon($pokemonName);
        }

        return view('post.show', compact('posts', 'pokemonData'));

        {
            // $posts=Post::all();
            $posts=Post::paginate(10);
            return view('post.show' , compact('posts'));
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title','like',"%{$query}%")
                ->orWhere('body', 'like', "%{$query}%")
                ->paginate(10);

                return view('post.show', compact('posts', 'query'));
    }

    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required | max:20',
            'body' => 'required | max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        $request->session()->flash('message' , '保存しました');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required | max:20',
            'body' => 'required | max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $request->session()->flash('message', '更新しました');
        return redirect()->route('post.show' , compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Post $post)
    {
        $post->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('post.index');
    }
}
