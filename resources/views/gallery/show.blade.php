@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="{{route("profile.index")}}">{{ __('Profile') }}</a>
    <div class="d-flex justify-content-center">
        @if($gallery->user_id == auth()->user()->id)
            <form action="{{route("gallery.destroy",['gallery' => $gallery->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-primary">Delete Gallery</button>
            </form>
        @endif
    </div>
@endsection
@section('content')
    @if($gallery->user_id == auth()->user()->id)
        <form action="{{route("gallery.update",['gallery' => $gallery->id])}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="title"
                       class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                <div class="col-md-6">
                    <input id="title" type="text" value="{{$gallery->title}}"
                           class="form-control @error('title') is-invalid @enderror" name="title"
                           autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="images"
                       class="col-md-4 col-form-label text-md-right">{{ __('Select Images') }}</label>
                <div class="col-md-6">
                    <input type="file" name="image[]" multiple>
                    <button type="submit" class="btn-primary">Upload</button>
                </div>

            </div>

            @error('title')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            @error('images')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            @method('PUT')

        </form>
    @endif
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
                        @if($gallery->user_id == auth()->user()->id)
                            <form
                                action="{{route("gallery.deleteImage",['gallery' => $gallery->id,'id' => $image->id])}}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-primary">Delete</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
