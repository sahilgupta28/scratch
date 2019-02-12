<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
Use Helper;
Use Session;
Use Auth;
use Mail;
use App\Mail\BlogCreated;

class BlogsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where('owner_id',auth()->id())->latest()->get();
        return view('blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Blog::rules());
        $request['slug'] = Helper::create_slug($request->title,Blog::class);
        $request['owner_id'] = auth()->user()->id;
        try{
            $blog = Blog::create($request->all());
            $mail = Mail::to($blog->owner->email)->send(new BlogCreated($blog));
            Helper::flashCreated('Blog');
        }catch(\Exception $e){
            Helper::flashError($e->getMessage());
        }
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $this->authorize('onlyOwnerHasAccess',$blog);
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('onlyOwnerHasAccess',$blog);
        $request->validate(Blog::rules());
        $request['slug'] = Helper::create_slug($request->title,Blog::class);
        if($blog->update($request->all())){
            Helper::flashUpdated('Blog'); 
            return redirect()->route('blogs.index');
        }
        Helper::flashError();         
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('onlyOwnerHasAccess',$blog);
        if($blog->delete()){
            Helper::flashDelete('Blog'); 
            return redirect()->route('blogs.index');
        }
        Helper::flashError();         
        return back();
    }
}