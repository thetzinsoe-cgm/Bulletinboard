@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg col-8 m-auto">
        <div class="d-flex justify-content-between">
            <div class="mt-3">
                <a href="{{route('post#postList')}}" class="btn btn-info d-inline">Back</a>
            </div>
            <form action="{{ route('post#delete', $post->id) }}" method="POST" class="d-inline mt-3">
                @csrf
                <input type="submit" class="btn btn-danger" value = "Delete">
            </form>
        </div>

        <div class="card-body col-8 p-0 m-auto">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Update Post!</h1>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (isset($post))
                    <form class="user" action="{{ route('post#update', $post->id) }}" method="POST">
                        @csrf
                        @include('post._postBody')
                        <input type="submit" class="btn btn-primary btn-user btn-block" value = "Update">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
