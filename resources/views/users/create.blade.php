@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <form method="POST" action="/admin-area/register">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input id="name" class="form-control" name="name" type="text" required class="@error('name') is-invalid @enderror" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" name="email" type="email" required class="@error('email') is-invalid @enderror" />
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" >{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" value="Create">
                    </form>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
@endsection
