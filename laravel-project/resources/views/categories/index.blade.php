@extends('layouts.blog')

@section('title', 'カテゴリー一覧')

@section('content')
<main class="container mx-auto mt-10 p-4">
 <div class="flex justify-between items-center">
  <h1 class="text-2xl font-semibold text-gray-800">カテゴリ一覧</h1>
  <a href="{{ route('categories.create') }}"
   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
   新規カテゴリ追加
  </a>
 </div>
 <div class="mt-6">
  <div class="bg-white shadow-md rounded my-6">
   <table class="text-left w-full border-collapse">
    <thead>
     <tr>
      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">カテゴリ名
      </th>
      <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">アクション
      </th>
     </tr>
    </thead>
    <tbody>
     @foreach ($categories as $category)
     <tr class="hover:bg-grey-lighter">
      <td class="py-4 px-6 border-b border-grey-light">{{ $category->name }}</td>
      <td class="py-4 px-6 border-b border-grey-light">
       <!-- アクションボタンの例 -->
       <a href="#" class="text-blue-500 hover:text-blue-800">編集</a>
       <!-- 他のアクションボタンもここに追加 -->
      </td>
     </tr>
     @endforeach
    </tbody>
   </table>
  </div>
 </div>
</main>
@endsection