<!DOCTYPE html>
<html lang="ja">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>ログイン</title>
 <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center px-6">
 <div class="max-w-lg w-full space-y-8">
  <div class="bg-white shadow-xl rounded-2xl p-8 sm:p-12">
   <form class="space-y-6" action="{{ route('login') }}" method="POST">
    @csrf
    <div>
     <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
     <input id="email" name="email" type="email" required
      class="mt-1 block w-full border border-gray-300 bg-gray-50 rounded-lg shadow-sm p-3 text-gray-700">
    </div>
    <div>
     <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
     <input id="password" name="password" type="password" required
      class="mt-1 block w-full border border-gray-300 bg-gray-50 rounded-lg shadow-sm p-3 text-gray-700">
    </div>
    <div>
     <button type="submit"
      class="w-full flex justify-center py-3 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700">
      ログイン
     </button>
     <a href="{{ route('register') }}" class="underline text-sm text-indigo-600 hover:text-indigo-900">
      ログイン画面へ
     </a>
    </div>
   </form>
  </div>
 </div>
</body>

</html>