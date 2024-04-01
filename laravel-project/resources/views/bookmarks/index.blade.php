@extends('layouts.blog')

@section('title', 'ブックマーク一覧')

@section('content')
<main class="container mx-auto mt-10 p-4">
 <h1 class="text-xl font-bold mb-4">ブックマーク一覧
 </h1>
 <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
  @forelse ($bookmarks as $blog)
  <article class="bg-white rounded-lg shadow overflow-hidden">
   <div class="p-4">
    <h2 class="font-bold text-lg mb-2">{{ $blog->title }}</h2>
    <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('Y年m月d日') }}</time>
    <p class="text-gray-700 mt-3">{{ Str::limit($blog->contents, 100) }}</p>
    <a href="{{ route('blogs.show', $blog->id) }}" class="block mt-4 text-blue-500 hover:underline">記事詳細へ</a>
   </div>
  </article>
  @empty
  <p>ブックマークされた投稿はありません。</p>
  @endforelse
 </section>
</main>
@endsection