@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5 col-6 m-auto">
        <div class="card-body p-0 pt-5">
            <div class="col m-auto">
                <div>
                    <div class="text-center">
                        <img src="{{ asset('img/default.png') }}" height="100px" alt="">
                    </div>
                    <div class="">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login!</h1>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form class="user" action="{{ route('user#checkLogin') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" placeholder="Email Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password" required>
                                </div>

                                <input type="submit" class="btn btn-primary btn-user btn-block" value = "Login Account">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('user#forgotPassword') }}">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small mb-3" href="{{ route('user#create') }}">New user? Register!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
