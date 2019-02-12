@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('flash')
            <div class="card">
                <div class="card-header">
                    {{$blog->title}}
                    @can('onlyOwnerHasAccess',$blog)
                        <a href="{{route('blogs.edit',$blog->id)}}" class="btn btn-success">Edit</a>
                        <form action="{{route('blogs.destroy',$blog->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                    <span class="float-right">{{$blog->created_at->diffForHumans()}}</span>
                </div>

                <div class="card-body">
                    {{$blog->description}}
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">
                    Comments
                </div>

                <div class="card-body">
                    <form method="POST"action="{{ route('blog.comments.store') }}">
                        @csrf
                        <input type="hidden" name="blog_id" value="{{$blog->id}}">
                        <div class="form-group">  
                            <textarea name="comment" id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="Say Something..." required autofocus></textarea>
                            @if ($errors->has('comment'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>    
                    @foreach($blog->comments as $comment)                      
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            {{$comment->owner}}
                            <span class="float-right">{{$comment->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="card-body">
                            {{$comment->comment}}
                        </div>
                    </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
