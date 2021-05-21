@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="{{route("post.index")}}">{{ __('Posts') }}</a>
@endsection
@section('content')

    <div class="container align-content-center">
        <div class="d-flex flex-column align-items-lg-center">
            <div class="flex-column">
                <div class="  flex-column align-items-center">
                    <img class="img-thumbnail rounded-circle"
                         src="{{ $avatar ? asset('/storage/'.$avatar->path) : asset('/images/postDefault.png') }}"
                         alt="Card image cap" style="width: 100px;height: 100px">
                    <p>Name: {{$post->user->name}}</p>
                    <a  href="{{route('profile.guest',['guest'=>$post->user->id])}}" class="btn btn-primary align-self-end">See Profile</a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="mr-auto p-2">Created at {{$post->created_at}}</div>
                            <div class="p-2">Updated at {{$post->updated_at}}</div>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="p-2">
                            <div class="card" style="width: 18rem">

                                <img class="card-img-top"
                                     src="{{ $post->postImage ? asset('/storage/'.$post->postImage->path) : asset('/images/postDefault.png') }}"
                                     alt="Card image cap">
                            </div>
                        </div>

                        <div class="card-body">
                            <h4>Title :{{$post->title}}</h4>
                            <p>Description : {{$post->description}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
