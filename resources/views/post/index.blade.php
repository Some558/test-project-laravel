<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>
    @extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    <!-- ポケモン検索フォーム -->
    <form action="{{ route('posts.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="pokemon_name" class="form-control" placeholder="Search Pokemon" value="{{ request('pokemon_name') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <!-- ポケモン情報の表示 -->
    @if(isset($pokemonData) && !empty($pokemonData))
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ ucfirst($pokemonData['name']) }}</h5>
                <img src="{{ $pokemonData['sprites']['front_default'] }}" alt="{{ $pokemonData['name'] }}">
                <p>Types: {{ implode(', ', array_column($pokemonData['types'], 'type.name')) }}</p>
            </div>
        </div>
    @elseif(request('pokemon_name'))
        <p class="alert alert-warning">No Pokemon found with that name.</p>
    @endif

    <!-- 投稿一覧 -->
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection
        <!-- 検索フォーム -->
        <form action="{{ route('posts.search') }}" method="GET" class="mb-4">
            <div class="input-group m-10 font-bold text-gray-600 ">
                <input type="text" name="query" class="form-control rounded" placeholder="キーワードを入力" value="{{ request('query') }}">
                <button type="submit" class="ml-4">検索</button>
            </div>
        </form>
    
        <!-- 検索結果の表示 -->
        @if(request()->has('query'))
            <h2>「{{ request('query') }}」の検索結果</h2>
        @endif

    <div class="mx-auto px-6">
        <x-message :message="session('message')" />
    </div>
        @foreach($posts as $post)
        <div class="mt-4 p-8 bg-white w-full rounded-2xl">
            <h1 class="p-4 text-lg font-semibold">
                件名:
                <a href="{{route('post.show',$post)}}"
                class=text-blue-600>
                {{$post->title}}
                </a>
            </h1>
            <hr class="w-full">
            <p class="mt-4 p-4">
                {{$post->body}}
            </p>
            <div class="p-4 text-sm font-semibold">
                <p>
                    {{$post->created_at}} / {{$post->user->name??'匿名'}}
                </p>
            </div>
        </div>
    @endforeach
    <div class="mb-4">
        {{ $posts->links()}}
    </div>
</x-app-layout>
