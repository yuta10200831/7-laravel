@extends('layouts.blog')

@section('title', '編集ページ')

@section('content')
<div class="flex justify-center mt-10">
 <div class="w-full max-w-xl bg-blue-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
  <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
   @csrf
   @method('PUT')

   <div class="mb-4">
    <label for="title" class="block text-blue-700 text-sm font-bold mb-2">タイトル</label>
    <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
     class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline">
   </div>

   <div class="mb-6">
    <label for="contents" class="block text-blue-700 text-sm font-bold mb-2">内容</label>
    <textarea name="contents" required
     class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline h-48">{{ old('contents', $blog->contents) }}</textarea>
   </div>

   <!-- 公開・非公開選択のラジオボタンを追加 -->
   <div class="mb-4">
    <label for="is_published_yes" class="inline-flex items-center mr-6">
     <input id="is_published_yes" type="radio" name="is_published" value="1" {{ $blog->is_published ? 'checked' : '' }}
      class="form-radio text-blue-600">
     <span class="ml-2">公開</span>
    </label>
    <label for="is_published_no" class="inline-flex items-center">
     <input id="is_published_no" type="radio" name="is_published" value="0" {{ !$blog->is_published ? 'checked' : '' }}
      class="form-radio text-blue-600">
     <span class="ml-2">非公開</span>
    </label>
   </div>

   <div class="flex items-center justify-center">
    <button type="submit"
     class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新する</button>
   </div>
  </form>
 </div>
</div>
@endsection