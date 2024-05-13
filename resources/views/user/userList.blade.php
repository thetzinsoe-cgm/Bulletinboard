@extends('layout.master')
@section('content')
    <div class="card-body col-10 m-auto">
        <a href="{{ route('user#create') }}" class="btn btn-info mb-2">Create User</a>
        <a href="{{ route('post#postList') }}" class="btn btn-info mb-2 float-right">Back</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Detail</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                @if ($user->img)
                                    <img src="{{ asset('storage/images/' . $user->img) }} " height="100px" alt="">
                                @else
                                    <img src="{{ asset('img/default.png') }} " height="100px" alt="">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->role == 2)
                                    User
                                @elseif ($user->role == 1)
                                    Admin
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('user#detail', $user->id) }}" class="btn btn-info">Edit</a>
                            </td>

                            <td>
                                <form method="POST" action="{{ route('user#delete', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
