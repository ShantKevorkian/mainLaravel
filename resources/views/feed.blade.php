@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="{{ route('post.index') }}">{{ __('Posts') }}</a>
@endsection
@section('content')
    @foreach($posts as $post)
        @if(!in_array($post->id,$userPosts))
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
                        <img class="card-img-top" src="{{ $post->postImage ? asset('/storage/'.$post->postImage->path) : asset('/images/postDefault.png') }}" alt="Post Image">
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
                        <a  href="{{route('post.detail',['post'=>$post->id])}}" class="btn btn-primary align-self-end">See Post</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    <div class="d-flex justify-content-around">
        {{$posts->links()}}
    </div>

@endsection
