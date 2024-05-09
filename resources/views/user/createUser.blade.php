@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5 col-8 m-auto">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 text-center d-flex align-items-center justify-content-center">
                    <img src="{{ asset('img/default.png') }}" height="400px" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="user" action="{{ route('store#user') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-user"
                                    id="exampleFirstName" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                    id="exampleInputEmail" placeholder="Email Address" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="Password" required>
                            </div>

                            <div class="form-group">
                                <input type="file" name="image" class="form-control rounded" id="exampleFirstName">
                            </div>

                            <input type="submit" class="btn btn-primary btn-user btn-block" value = "Regiser Account">
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small mb-3" href="{{ route('user#login') }}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
