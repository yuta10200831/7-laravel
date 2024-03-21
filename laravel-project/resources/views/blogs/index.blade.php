<!DOCTYPE html>
<html lang="ja">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>ブログ一覧</title>
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-100">
 <header class="bg-blue-500 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
   <h1 class="text-2xl font-bold">ブログ一覧</h1>
   @if(Auth::check())
   <div>こんにちは、{{ Auth::user()->name }}さん！</div>
   @endif
   <nav>
    <a href="{{ url('/') }}" class="text-white hover:underline px-3">ホーム</a>
    <a href="{{ url('/mypage') }}" class="text-white hover:underline px-3">マイページ</a>
    <a href="{{ route('blogs.create') }}" class="text-white hover:underline px-3">新規投稿</a>
    @auth
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
     class="text-white hover:underline px-3">ログアウト</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
     @csrf
    </form>
    @else
    <a href="{{ route('login') }}" class="text-white hover:underline px-3">ログイン</a>
    @endauth
   </nav>
  </div>
 </header>
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
  <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
   @foreach ($blogs as $blog)
   <article class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4">
     <h3 class="font-bold mb-2">{{ $blog->title }}</h3>
     <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('Y年m月d日') }}</time>
     <p class="text-gray-700 mt-3">{{ Str::limit($blog->contents, 100) }}</p>
     <a href="{{ route('blogs.show', $blog->id) }}" class="block mt-4 text-blue-500 hover:underline">記事詳細へ</a>
    </div>
   </article>
   @endforeach
  </section>
 </main>
</body>

</html>