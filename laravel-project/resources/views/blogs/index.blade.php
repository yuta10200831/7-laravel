@extends('layouts.blog')

@section('title', 'ブログ一覧')

@section('content')
<main class="container mx-auto mt-10 p-4">
 <section class="mb-10">
  <form class="flex gap-4 mb-4" action="{{ url('/') }}" method="GET">
   <input type="text" name="search" placeholder="キーワードを入力" class="border p-2 rounded flex-grow"
    value="{{ request('search') }}">
   <button type="submit"
    class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded transition duration-300 ease-in-out">検索</button>
  </form>
  <div class="flex gap-4">
   <a href="{{ url('/') }}?sort=newest"
    class="bg-blue-200 px-4 py-2 rounded hover:bg-blue-300 transition duration-300 ease-in-out">新しい順</a>
   <a href="{{ url('/') }}?sort=oldest"
    class="bg-blue-200 px-4 py-2 rounded hover:bg-blue-300 transition duration-300 ease-in-out">古い順</a>
  </div>
 </section>
 {{-- カテゴリ作成ページへのボタン --}}
 <div class="mb-4">
  <a href="{{ route('categories.create') }}"
   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out">
   カテゴリ作成
  </a>
 </div>
 <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
  @foreach ($blogs as $blog)
  <article class="bg-white rounded-lg shadow overflow-hidden">
   <div class="p-4">
    {{-- ブックマークボタン --}}
    <form action="{{ route('blogs.bookmark', $blog->id) }}" method="POST" class="ml-4">
     @csrf
     <button type="submit"
      class="{{ $blog->isBookmarkedBy(Auth::user()) ? 'text-blue-500' : 'text-gray-500' }} hover:text-blue-600">
      <i class="fas fa-bookmark"></i>
     </button>
    </form>
    <h3 class="font-bold mb-2">{{ $blog->title }}</h3>
    <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('Y年m月d日') }}</time>
    <p class="text-gray-700 mt-3">{{ Str::limit($blog->contents, 100) }}</p>
    <a href="{{ route('blogs.show', $blog->id) }}" class="block mt-4 text-blue-500 hover:underline">記事詳細へ</a>
    {{-- お気に入りボタン --}}
    <form action="{{ route('blogs.favorite', $blog->id) }}" method="POST" class="ml-4">
     @csrf
     <button type="submit"
      class="{{ $blog->isFavoritedBy(Auth::user()) ? 'text-yellow-500' : 'text-gray-500' }} hover:text-yellow-600">
      <i class="fas fa-star"></i>
     </button>
     {{-- カテゴリ表示 --}}
     <span class="text-sm font-semibold mr-2 px-2.5 py-0.5 rounded bg-blue-100 text-blue-800">
      {{ $blog->category->name }}
     </span>
    </form>
   </div>
  </article>
  @endforeach
 </section>
</main>
@endsection