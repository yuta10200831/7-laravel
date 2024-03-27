<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\UseCase\Comment\CommentCreateInput;
use App\UseCase\Comment\CommentCreateInteractor;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CommentCreateInteractor $commentCreateInteractor)
    {
        $request->validate([
            'comment' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $input = new CommentCreateInput($request->input('blog_id'), $request->input('comment'));
        $output = $commentCreateInteractor->handle($input);

        if ($output->isSuccess()) {
            return redirect()->route('blogs.show', $output->getBlogId())->with('status', $output->getMessage());
        } else {
            return redirect()->route('blogs.show', $output->getBlogId())->withErrors($output->getMessage());
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
        //
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
        //
    }
}