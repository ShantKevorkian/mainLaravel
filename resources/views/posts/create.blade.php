@extends('layouts.app')

@section('navbar')
    <a class="nav-link" href="{{route('posts.index')}}">
        {{ __('Posts') }}
    </a>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-header">Details</div>
                    <div class="card-body">
                        <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        autofocus
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="description"
                                        type="text"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                    >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Choose Image') }}</label>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input
                                            type="file"
                                            name="image"
                                            class="form-control @error('image') is-invalid @enderror"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profession" class="col-md-4 col-form-label text-md-right">{{ __('Select Profession') }}</label>

                                <div class="col-md-6">
                                    <select class="js-example-basic-multiple" name="professions[]" multiple="multiple">
                                        @foreach($professions as $profession)
                                            <option value="{{$profession->id}}">
                                                {{$profession->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" name="UpdateDetails">
                                        {{ 'Create' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
