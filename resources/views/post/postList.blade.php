@extends('layout.master')
@section('content')
    @if (Auth::check())
        @if (Auth::user()->role == 1)
            <div class="position-fixed col-12">
                <a href="{{ route('user#list') }}" class="btn btn-info float-right m-5">Show User List</a>
            </div>
        @endif
    @endif
    <div class="card o-hidden border-0 shadow-sm my-5 col-8 m-auto p-0">
        <div class="card-header d-flex justify-content-between">
            <div class="">
                <a href="{{ route('post#postList') }}" class="btn btn-info">All</a>
                <a href="{{ route('post#showMyPost') }}" class="btn btn-info">My Post</a>
            </div>
            <div><a href="{{ route('post#create') }}" class="btn btn-info">+new</a></div>
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
                        <a href="#" class="btn btn-outline-secondary">Comment
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
