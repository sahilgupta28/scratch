<?php

namespace App\Http\Controllers;

use App\BlogComment;
use App\Blog;
use Illuminate\Http\Request;
use Helper;

class BlogCommentsController extends Controller
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
    public function store(Request $request)
    {
        $request->validate(BlogComment::rules());
        $request['user_id'] = auth()->check() ? auth()->user()->id : NULL;
        // try{
            $blogComment = BlogComment::create($request->all());
            // $mail = Mail::to($blog->owner->email)->send(new BlogCreated($blog));
            Helper::flashCreated('Comment');
        // }catch(\Exception $e){
        //     Helper::flashError($e->getMessage());
        // }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogComment $blogComment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return BlogComment::find($id)->user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\blogComment  $blogComment
     * @return \Illuminate\Http\Response
     */
    public function edit(blogComment $blogComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\blogComment  $blogComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blogComment $blogComment)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\blogComment  $blogComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(blogComment $blogComment)
    {
        //
    }
}
