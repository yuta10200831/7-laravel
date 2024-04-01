<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\UseCase\Blog\CreateBlogInput;
use App\UseCase\Blog\CreateBlogInteractor;
use App\UseCase\Blog\EditBlogInput;
use App\UseCase\Blog\EditBlogInteractor;
use App\UseCase\Blog\BlogPageInteractor;
use App\UseCase\Blog\MyBlogsInteractor;
use App\UseCase\Blog\MyBlogDetailInteractor;
use App\Models\ValueObjects\Title;
use App\Models\ValueObjects\Content;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(
        CreateBlogInteractor $createBlogInteractor,
        EditBlogInteractor $editBlogInteractor,
        BlogPageInteractor $blogPageInteractor,
        MyBlogsInteractor $myBlogsInteractor,
        MyBlogDetailInteractor $myBlogDetailInteractor
    ) {
        $this->middleware('auth');
        $this->createBlogInteractor = $createBlogInteractor;
        $this->editBlogInteractor = $editBlogInteractor;
        $this->blogPageInteractor = $blogPageInteractor;
        $this->myBlogsInteractor = $myBlogsInteractor;
        $this->myBlogDetailInteractor = $myBlogDetailInteractor;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category_id');
        $sort = $request->input('sort');

        $blogs = $this->blogPageInteractor->handle($search, $category, $sort);
        $categories = Category::all();

        return view('blogs.index', compact('blogs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $contents = $request->input('contents');
        $category_id = (int) $request->input('category_id');
        $input = new CreateBlogInput($title, $contents, $category_id);
        $interactor = new CreateBlogInteractor();
        $output = $interactor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('blogs.index')->with('status', $output->getMessage());
        } else {
            return redirect()->route('blogs.create')->withErrors('ブログの投稿に失敗しました。');
        }
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
        $blog = Blog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('blogs.edit', compact('blog'));
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
        $title = new Title($request->input('title'));
        $contents = new Content($request->input('contents'));
        $is_published = $request->input('is_published') === '1' ? true : false;

        $input = new EditBlogInput($id, $title, $contents, $is_published);
        $output = $this->editBlogInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('blogs.myarticledetail', $id)->with('status', $output->getMessage());
        } else {
            return redirect()->route('blogs.edit', $id)
                             ->withErrors(['message' => $output->getMessage()])
                             ->withInput();
        }
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
        $userId = Auth::id();
        $blogs = $this->myBlogsInteractor->handle($userId);
        return view('blogs.mypage', compact('blogs'));
    }

    public function myArticleDetail($id)
    {
        $blog = $this->myBlogDetailInteractor->handle($id);
        return view('blogs.myarticledetail', compact('blog'));
    }

    public function favorite(Request $request, Blog $blog)
    {
        $user = Auth::user();

        if (!$blog) {
            return back()->with('error', 'ブログが見つかりませんでした。');
        }

        $user->favorites()->toggle($blog->id);

        return back()->with('status', 'お気に入りの状態を変更しました。');
    }
}