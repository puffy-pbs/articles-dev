@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <form method="POST" action="/admin-area/save/{{ $user->id }}">
                        @csrf
                        <label for="name">Title</label>
                        <input id="name" name="name" type="text" class="@error('title') is-invalid @enderror" value="{{ $user->name }}" />
                        <select name="role" id="role">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Update">
                    </form>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
@endsection
