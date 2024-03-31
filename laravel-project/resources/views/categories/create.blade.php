@extends('layouts.blog')

@section('title', 'カテゴリー追加')

@section('content')
<main class="container mx-auto mt-10 p-4">
 <div class="flex flex-col items-center">
  <h1 class="text-lg md:text-2xl lg:text-3xl text-blue-700 font-bold mb-8 text-center">カテゴリー追加</h1>

  <form action="{{ route('categories.store') }}" method="post" class="w-3/4 md:w-1/2 lg:w-2/5">
   @csrf
   {{-- カテゴリ追加フォーム --}}
   <div class="mb-6">
    <label for="category" class="block text-blue-700 text-sm font-bold mb-2">カテゴリ:</label>
    <input type="text" id="category" name="category"
     class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
     required>
   </div>

   <div class="flex w-full">
    <a href="{{ url()->previous() }}"
     class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     戻る
    </a>
    <button type="submit"
     class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
     追加
    </button>
   </div>
  </form>
 </div>
</main>
@endsection