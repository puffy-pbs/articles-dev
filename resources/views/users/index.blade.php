@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Erase</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles()->first()->name }}</td>
                            <td><a href="/admin-area/update/{{ $user->id }}">Edit</a></td>
                            @if($user->id !== \Illuminate\Support\Facades\Auth::user()->id)
                                <td><a href="/admin-area/erase/{{ $user->id }}">Erase</a></td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
