@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <form method="POST" action="/admin-area/save/{{ $user->id }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input id="name" class="form-control" name="name" type="text" class="@error('title') is-invalid @enderror" value="{{ $user->name }}" />
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if(in_array($role->id, $userRoles)) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
