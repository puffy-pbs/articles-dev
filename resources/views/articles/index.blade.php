@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="/articles/create">Create</a>
                    @endif
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Article Title</th>
                            <th>Body Text</th>
                            <th>Author</th>
                            <th>Publish On</th>
                            <th>Detail</th>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <th>Edit</th>
                                <th>Erase</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ \Illuminate\Support\Str::substr($article->body_text, 0, 12) }}</td>
                                <td>{{ $article->user->name }}</td>
                                <td>{{ $article->publish_on }}</td>
                                <td><a href="/articles/{{ $article->id }}">Detail</a></td>
                                @if(\Illuminate\Support\Facades\Auth::check() === false)
                                    @continue;
                                @endif
                                <td><a href="/articles/update/{{ $article->id }}">Edit</a></td>
                                @if(!empty($currentUser) && $currentUser->roles->first()->id === \App\Role::ADMINISTRATOR)
                                    <td><a href="/articles/erase/{{ $article->id }}">Erase</a></td>
                                @else
                                    <td>-</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
