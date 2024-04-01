<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>@yield('title')</title>

 <!-- Fonts -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

 <!-- Scripts -->
 <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
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
    <a href="{{ route('bookmarks.index') }}" class="text-white hover:underline px-3">ブックマーク一覧</a>
    <a href="{{ route('mypage') }}" class="text-white hover:underline px-3">マイページ</a>
    <a href="{{ route('blogs.create') }}" class="text-wxhite hover:underline px-3">新規投稿</a>
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
 @yield('content')
</body>

</html>