@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="">{{ __('Create Post') }}</a>
    {{--    {{ route('post.create') }}--}}
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
                        <img class="card-img-top" src="{{asset('/storage/' . $post->path)}}" alt="Card image cap">
                    </div>
                </div>
                <div class="p-2">
                    <div class="card-body">
                        <h4 class="card-title">{{$post->title}}</h4>
                        <p class="card-text">{{$post->description}}</p>
                        <a  href="{{route('post.edit',['id'=>$post->id])}}" class="btn btn-primary align-self-end">Edit</a>
                    </div>
                </div>


            </div>



        </div>
    @endforeach
@endsection
