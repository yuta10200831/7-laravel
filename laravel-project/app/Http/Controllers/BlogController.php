<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
         // このコントローラーの全アクションにログインを必須にする
        $this->middleware('auth');
    }

public function index(Request $request)
{
    $query = Blog::query();

    // 検索処理
    $search = $request->input('search');
    if (!empty($search)) {
        $query->where('title', 'LIKE', '%' . $search . '%')
              ->orWhere('contents', 'LIKE', '%' . $search . '%');
    }

    // 並び替え処理
    $sort = $request->input('sort');
    if ($sort === 'newest') {
        $query->orderBy('created_at', 'desc');
    } elseif ($sort === 'oldest') {
        $query->orderBy('created_at', 'asc');
    }

    $blogs = $query->get();
    return view('blogs.index', compact('blogs'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'contents' => 'required',
        ]);

        Blog::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'user_id' => Auth::id(),
        ]);

        return redirect('/')->with('status', 'ブログが投稿されました！');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::with('comments')->findOrFail($id);

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $blog->delete();
        return redirect()->route('mypage')->with('status', '記事を削除しました。');
    }

    public function myPage()
    {
        $blogs = Blog::where('user_id', Auth::id())
                     ->get()
                     ->map(function ($blog) {
                        $blog->contents = Str::limit($blog->contents, 15);
                        return $blog;
                     });
        return view('blogs.mypage', compact('blogs'));
    }

    public function myArticleDetail($id)
    {
        $blog = Blog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('blogs.myarticledetail', compact('blog'));
    }
}