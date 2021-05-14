@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="">{{ __('Create Post') }}</a>
{{--    {{ route('post.create') }}--}}
@endsection
@section('content')

    @foreach($posts as $post)
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->description}}</p>
        </div>

        <div class="card-body">
            <a href="{{route('post',['id'=>$post->id])}}" class="card-link">Edit</a>
        </div>
    </div>
    @endforeach
@endsection
