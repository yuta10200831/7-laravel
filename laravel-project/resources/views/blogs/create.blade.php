<!DOCTYPE html>
<html lang="ja">

<head>
 <meta charset="UTF-8">
 <title>新規ブログ投稿</title>
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-100">
 <header class="bg-blue-500 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
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
  <form action="{{ route('blogs.store') }}" method="post" class="bg-white p-8 rounded-lg shadow-md">
   @csrf
   <div class="mb-4">
    <h1 class="text-lg md:text-2xl lg:text-3xl text-blue-700 font-bold mb-8">新規記事</h1>
    <label for="title" class="block text-blue-700 text-sm font-bold mb-2">タイトル:</label>
    <input type="text" id="title" name="title"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
     required>
   </div>
   <div class="mb-6">
    <label for="contents" class="block text-blue-700 text-sm font-bold mb-2">内容:</label>
    <textarea id="contents" name="contents"
     class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-40"
     required></textarea>
   </div>
   <div class="flex items-center justify-between">
    <button type="submit"
     class="bg-yellow-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     新規作成
    </button>
   </div>
  </form