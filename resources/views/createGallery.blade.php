@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="{{route("post.index")}}">{{ __('Posts') }}</a>
@endsection
@section('content')

    <form action="{{ route('gallery.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="title"
                   class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
            <div class="col-md-6">
                <input id="title" type="text"
                       class="form-control @error('title') is-invalid @enderror" name="title"
                       autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="images"
                   class="col-md-4 col-form-label text-md-right">{{ __('Select Images') }}</label>
            <div class="col-md-6">
                <input type="file" name="image[]" multiple>
            </div>
        </div>
        @error('title')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
        @error('images')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" name="UpdateDetails">
                    {{ __('Save') }}
                </button>
            </div>
        </div>
    </form>
@endsection

