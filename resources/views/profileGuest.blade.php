@extends('layouts.app')
@section("navbar")
    <a class="nav-link" href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
@endsection
@section('content')
    <div class="container align-content-center">
        <h2>Profile Detail</h2>
        <div class="card mb-5">
            <div class="row">
                <div class="card-body d-flex ">
                    <div class="col-md-5">
                        <div class="card" style="width: 15rem">
                            <img class=" "
                                 src="{{ $guest->avatar ? asset('/storage/'.$guesy->avatar->path) : asset('/images/postDefault.png') }}"
                                 alt="Card image cap">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <p>Name: {{$guest->name}}</p>
                        <p>Email: {{$guest->email}}</p>
                        <p>Phone: {{$guest->detail->phone}}</p>
                        <p>City: {{$guest->detail->city}}</p>
                        <p>Country: {{$guest->detail->country}}</p>
                        <p class="card-text">Profession`
                            @foreach($guest->professions as $profession)
                                {{$profession->name.","}}
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <h2>Galleries</h2>
        <div class="card mb-5">
            <div class="card-body">

                <div class="row">
                    @foreach($galleries as $gallery)
                        <div class="col-md-6">
                            <div class="text-center">
                                <div>
                                    <p>{{$gallery->title}}</p>
                                </div>
                                <div>
                                    <a href="{{route('gallery.show',['gallery'=>$gallery->id])}}"><img
                                            class="rounded-circle" style="width: 200px;height: 200px"
                                            src="{{asset('/storage/'.$gallery->galleryImages[0]->path)}}"
                                            alt="Card image cap"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
