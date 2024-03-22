@extends('layouts.blog')

@section('title', 'ブログ一覧')

@section('content')

<main class="container mx-auto mt-10">
 <article class="bg-white rounded-lg shadow p-4 mb-8">
  <h1 class="text-2xl font-semibold mb-4">{{ $blog->title }}</h1>
  <p class="text-gray-500 mb-4">{{ $blog->created_at->format('Y-m-d H:i:s') }}</p>
  <div>{{ $blog->content }}</div>
  <div class="mt-4">
   <a href="{{ route('blogs.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">記事一覧へ戻る</a>
  </div>
 </article>

 <!-- コメントフォーム -->
 <form action="{{ route('comments.store') }}" method="POST">
  @csrf
  <input type="hidden" name="blog_id" value="{{ $blog->id }}">
  <div class="mb-4">
   <label for="comment" class="sr-only">コメント</label>
   <textarea name="comment" id="comment"
    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('comment') border-red-500 @enderror"
    placeholder="コメントを入力"></textarea>

   @error('comment')
   <div class="text-red-500 mt-2 text-sm">
    {{ $message }}
   </div>
   @enderror
  </div>

  <div>
   <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">コメント投稿</button>
  </div>
 </form>

 <!-- コメント一覧 -->
 <section class="mt-10">
  <h2 class="text-xl font-bold mb-5">コメント一覧</h2>
  @foreach ($blog->comments as $comment)
  <div class="mb-4 p-4 bg-gray-100 rounded">
   <strong>{{ $comment->commenter_name }}:</strong>
   <p>{{ $comment->comments }}</p>
   <p class="text-xs text-gray-600">{{ $comment->created_at->format('Y-m-d H:i:s') }}</p>
  </div>
  @endforeach
 </section>
</main>
</body>

</html>
@endsection