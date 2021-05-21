@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="{{route("profile.index")}}">{{ __('Profile') }}</a>
@endsection
@section('content')

    <div class="card-body">
        <div class="card mb-5">
            <h1 class="text-center">{{$gallery->title}}</h1>
            <div class="row">
                @foreach($gallery->galleryImages as $image)
                    <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                        <img
                            src="{{asset('/storage/'.$image->path)}}"
                            style="float: left"
                            class="w-100 shadow-1-strong rounded mb-4"
                            alt=""/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
