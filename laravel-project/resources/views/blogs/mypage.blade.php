@extends('layouts.blog')

@section('title', 'マイページ')

@section('content')
<main class="container mx-auto mt-10">
 <h1 class="text-xl font-bold mb-4">マイページ</h1>

 @if(session('status'))
 <div class="bg-green-500 text-white py-2 px-4 rounded">
  {{ session('status') }}
 </div>
 @endif

 <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  @forelse($blogs as $blog)
  <div class="bg-white p-6 rounded shadow">
   <h2 class="font-bold text-lg mb-2">{{ $blog->title }}</h2>
   <p class="text-gray-700 text-sm">{{ Str::limit($blog->contents, 100) }}</p>
   <span class="text-gray-500 text-xs">{{ $blog->created_at->format('Y-m-d') }}</span>
   <div class="mt-4">
    <a href="{{ route('blogs.myarticledetail', $blog->id) }}"
     class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">記事詳細へ</a>
   </div>
  </div>
  @empty
  <p>投稿されたブログはありません。</p>
  @endforelse
 </div>
</main>
@endsection