<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            一覧表示
        </h2>
    </x-slot>
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
