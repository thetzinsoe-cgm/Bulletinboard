@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg col-8 m-auto">
        <div class="card-body p-0">
            <a href="{{ route('user#list') }}" class="m-5 btn btn-info">Back</a>
            <div class="row">
                <div class="col-lg-5 text-center d-flex align-items-center justify-content-center">
                    @if ($user->img)
                        <img src="{{ asset('storage/images/' . $user->img) }} " height="400px" alt="">
                    @else
                        <img src="{{ asset('img/default.png') }} " height="400px" alt="">
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="px-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update Account!</h1>
                        </div>
                        <form class="user" action="{{ route('user#update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-user"
                                    id="exampleFirstName" value="{{ $user->name }}" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                    id="exampleInputEmail"
                                    @if ($user != null) value={{ $user->email }} @endif
                                    placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <select class="custom-select" name="role" id="inputGroupSelect01">
                                    <option  selected disabled>Select Role</option>
                                    <option value="1" @if ($user->role == 1) selected @endif>Admin</option>
                                    <option value="2" @if ($user->role == 2) selected @endif>User</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="file" name="image" class="form-control" id="exampleFirstName">
                            </div>

                            <input type="submit" class="btn btn-primary btn-user btn-block" value = "Update Account">
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="#">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small mb-3" href="#">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
