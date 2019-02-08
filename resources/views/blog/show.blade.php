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
        </div>
    </div>
</div>
@endsection
