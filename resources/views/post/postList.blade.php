@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-sm my-5 col-8 m-auto p-0">
        <div class="card-header d-flex justify-content-between">
            <div class="">
                <a href="#" class="btn btn-info">All</a>
                <a href="#" class="btn btn-info">Public</a>
                <a href="#" class="btn btn-info">Private</a>
            </div>
            <div><a href="{{ route('post#create') }}" class="btn btn-info">+new</a></div>
        </div>
        @foreach ($posts as $post)
            <div class="card-body">
                <div>
                    <h3 class="d-inline">{{ $post->title }}</h3>
                    <a href="{{ route('post#edit', $post->id) }}" class="float-right border rounded rounded-circle px-2"><img
                            src="{{ asset('fontawesome-free/svgs/solid/ellipsis-v.svg') }}" height="20px"
                            alt="Vertical Ellipsis Icon"></i></a>
                            <hr>
                    <p>{{ $post->description }}</p>
                    <a href="#" class="btn btn-outline-secondary">Comment Section</a>
                    <p class="text-center">----------xxx---------</p>
                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection
