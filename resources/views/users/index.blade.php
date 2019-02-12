@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('flash')
            <div class="card">
                <div class="card-header">All Users
                    <a href="#{{route('user.create')}}"><span class="float-right btn btn-primary">Create User</span></a> 
                </div>

                <div class="card-body">
                    @if($users->count() > 0)
                        @foreach($users as $user)
                            <div class="card">
                                <div class="card-header"><a href="#{{route('blogs.show',$user->id)}}">{{$user->name}}</a><span class="float-right">{{$user->created_at->diffForHumans()}}</span></div>
                                <div class="card-body">
                                    <ul>
                                        <li>{{$user->email}}</li>
                                        <li>{{ucFirst($user->getRole())}}
                                            @if(!$user->isAdmin())
                                                <form method="post" action="{{route('user.update',$user->id)}}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="hidden" name="role" value="@if($user->getRole() == 'user') 2 @else 3 @endif">
                                                    <button type="submit" class="btn btn-primary">Make @if($user->getRole() == 'user') Writer @else User @endif</button>
                                                </form>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
                    @else
                        <div class="alert alert-danger" role="alert">
                            No Users found. 
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
