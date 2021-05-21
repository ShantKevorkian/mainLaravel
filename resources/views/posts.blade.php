@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="{{route('post.new')}} ">{{ __('Create Post') }}</a>
{{--    <a class="nav-link" href="{{route('post.new')}} ">{{ __('Create Gallery') }}</a>--}}
@endsection
@section('content')

    @foreach($posts as $post)
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="mr-auto p-2">Created at  {{$post->created_at}}</div>
                    <div class="p-2">Updated at {{$post->updated_at}}</div>

                </div>
            </div>
            <div class="d-flex flex-row">
                <div class="p-2">
                    <div class="card" style="width: 18rem" >

                        <img class="card-img-top" src="{{ $post->postImage ? asset('/storage/'.$post->postImage->path) : asset('/images/postDefault.png') }}" alt="Card image cap">
                    </div>
                </div>
                <div class="p-2">
                    <div class="card-body">
                        <h4 class="card-title">{{$post->title}}</h4>
                        <p class="card-text">{{Str::limit($post->description,250)}}</p>
                        <p class="card-text">Profession`
                            @foreach($post->professions as $profession)
                                {{$profession->name.","}}
                            @endforeach
                        </p>

                        <a  href="{{route('post.edit',['post'=>$post->id])}}" class="btn btn-primary align-self-end">Edit</a>
                        <a  href="{{route('post.delete',['id'=>$post->id])}}" class="btn btn-primary align-self-end">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
