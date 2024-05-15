@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5 col-6 m-auto">
        <div class="card-body p-0 pt-5">
            <a href="{{ route('post#postList') }}" class="mx-5 btn btn-info">Back</a>
            <div class="col m-auto">
                <div>
                    <div class="text-center">
                        @if (auth()->user()->img)
                            <img src="{{ asset('storage/images/' . auth()->user()->img) }}" height="50px" alt="">
                        @else
                            <img src="{{ asset('img/default.png') }}" height="50px" alt="">
                        @endif
                    </div>
                    <div class="">
                        <div class="px-5 py-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ auth()->user()->name }}</h1>
                            </div>
                            <form class="user" action="{{ route('user#updatePassword') }}" method="POST">
                                @csrf
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Old Password" required>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="passwordConfirmation"
                                        class="form-control form-control-user" id="exampleInputPassword"
                                        placeholder="New Password" required>
                                </div>

                                <input type="submit" class="btn btn-primary btn-user btn-block" value = "Change Password">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('user#forgotPassword') }}">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
