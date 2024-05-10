@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5 col-8 m-auto">
        <div class="mt-3">
            <a href="{{ route('post#postList') }}" class="btn btn-info d-inline">Back</a>
        </div>
        <div class="card-body col-8 p-0 m-auto">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create Post!</h1>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="user" action="{{ route('post#store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('post._postBody')
                    <input type="submit" class="btn btn-primary btn-user btn-block" value = "Post">
                </form>
            </div>
        </div>
    </div>
@endsection
