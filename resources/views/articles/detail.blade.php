@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="card">
                        <img class="card-img-top" src="/images/{{ $article->image_url }}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">{{ $article->title }} published on {{ $article->publish_on }}</h4>
                            <h5 class="card-text">{{ $article->body_text }}</h5>
                            <h6>By {{ $article->user->name }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
