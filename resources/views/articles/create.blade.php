@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <form method="POST" action="/articles/store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" class="form-control" name="title" type="text" required class="@error('title') is-invalid @enderror" />
                        </div>
                        <div class="form-group">
                            <label for="body_text">Body</label>
                            <textarea id="body_text" class="form-control" name="body_text" required class="@error('body text') is-invalid @enderror"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="body_text">Date</label>
                            <input type="date" class="form-control" name="publish_on" id="publish_on" required>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Author</label>
                            <select name="user_id" class="form-control" id="user_id" required>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}"
                                            @if($author->id === $currentUser->id) selected @endif>{{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <input type="submit" class="btn" value="Create">
                    </form>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
@endsection
