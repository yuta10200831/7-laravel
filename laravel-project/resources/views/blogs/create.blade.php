@extends('layouts.blog')

@section('title', '新規登録ページ')

@section('content')
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
  {{-- カテゴリを選択するセレクトボックスを追加 --}}
  <div class="mb-4">
   <label for="category_id" class="block text-blue-700 text-sm font-bold mb-2">カテゴリ:</label>
   <select name="category_id" id="category_id" class="border p-2 rounded flex-grow" required>
    <option value="">選択してください</option>
    @foreach ($categories as $category)
    <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
   </select>
  </div>
  <div class="flex items-center justify-between">
   <button type="submit"
    class="bg-yellow-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
    新規作成
   </button>
  </div>
 </form>
 @endsection