@extends('layout.master')
@section('content')
    @if (Auth::check())
        @if (Auth::user()->role == config('constants.ADMIN_ROLE'))
            <div class="position-fixed col-12">
                <a href="{{ route('user#list') }}" class="btn btn-info float-right m-5">Show User List</a>
            </div>
        @endif
    @endif
    <div class="card o-hidden border-0 shadow-sm my-5 col-8 m-auto p-0">
        @error('file')
            <div class="alert alert-danger alert-dismissible fade show position-fixed col-6" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @enderror
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed col-6" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show position-fixed col-6" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header d-flex justify-content-between">
            <div class="">
                <a href="{{ route('post#postList') }}" class="btn btn-info">All</a>
                <a href="{{ route('post#showMyPost') }}" class="btn btn-info">My Post</a>
            </div>
            <div class="justify-content-end">
                @if (request()->routeIs('post#showMyPost'))
                    <a href="{{ route('post#csvExport') }}" class="btn btn-info">Export
                        <img src="{{ asset('fontawesome-free/svgs/solid/download.svg') }}" class="text-white" height="20px"
                            alt="Export">
                    </a>
                @else
                    <div class="d-inline align-items-center">
                        <form action="{{ route('post#csvImport') }}" method="POST" class="d-inline"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" class="border form-control col-6 d-inline" name="file" accept=".csv">
                            <button type="submit" class="btn btn-info">
                                Import CSV
                                <img src="{{ asset('fontawesome-free/svgs/solid/upload.svg') }}" class="text-white"
                                    height="20px" alt="Export">
                            </button>
                        </form>
                    </div>
                @endif
                <a href="{{ route('post#create') }}" class="btn btn-info">+new</a>
            </div>
        </div>
        @if (isset($posts) && $posts->count() > 0)
            @foreach ($posts as $post)
                <div class="card-body">
                    <div>
                        <h3 class="d-inline">{{ $post->title }}</h3>
                        @if (request()->routeIs('post#showMyPost'))
                            <a href="{{ route('post#edit', $post->id) }}"
                                class="float-right border rounded rounded-circle px-2">
                                <img src="{{ asset('fontawesome-free/svgs/solid/ellipsis-v.svg') }}" height="20px"
                                    alt="Vertical Ellipsis Icon">
                            </a>
                        @endif
                        <hr>
                        <p>{{ $post->description }}</p>
                        <a href="{{ route('post#comment', $post->id) }}" class="btn btn-outline-secondary">Comment
                            Section</a>
                        <p class="text-center">----------xxx---------</p>
                    </div>
                </div>
            @endforeach
        @else
            <div class="border border-light" style="height: 500px">
                <p class="mt-5 text-center text-danger">No posts found.</p>
            </div>
        @endif
        <div class="m-auto">{{ $posts->links() }}</div>
    </div>
    </div>
@endsection
