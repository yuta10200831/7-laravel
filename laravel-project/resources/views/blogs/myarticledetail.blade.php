@extends('layouts.blog')

@section('title', $blog->title)

@section('content')
<main class="container mx-auto mt-10">
 <article class="bg-white p-6 rounded shadow">
  <h1 class="font-bold text-xl mb-4">{{ $blog->title }}</h1>
  <p class="text-gray-700">{{ $blog->contents }}</p>
  <span class="text-gray-500">{{ $blog->created_at->format('Y-m-d H:i') }}</span>
  <div class="flex items-center gap-2 mt-4">
   <a href="{{ route('blogs.edit', $blog->id) }}"
    class="bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded">編集</a>
   <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('削除してよろしいですか？');">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">削除</button>
   </form>
   <a href="{{ route('mypage') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">マイページへ戻る</a>
  </div>
 </article>
</main>
@endsection