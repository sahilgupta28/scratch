@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('flash')
            <div class="card">
                <div class="card-header">All Blogs
                    <a href="{{route('blogs.create')}}"><span class="float-right btn btn-primary">Create Blog</span></a> 
                </div>

                <div class="card-body">
                    @if($blogs->count() > 0)
                        @foreach($blogs as $blog)
                            <div class="card">
                                <div class="card-header"><a href="{{route('blogs.show',$blog->id)}}">{{$blog->title}}</a><span class="float-right">{{$blog->created_at->diffForHumans()}}</span></div>
                                <div class="card-body">
                                    {{$blog->description}}
                                </div>
                            </div>
                            <hr/>
                        @endforeach
                    @else
                        <div class="alert alert-danger" role="alert">
                            Plesae post your first blog. 
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
