@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-sm my-5 col-8 m-auto p-0">
        <div class="card-header d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-info">Back</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-7">
                <div style="height: 500px" class="p-3">
                    <h4 style="height: 70px">{{ $post->title }}</h4>
                    <p style="height:430px;overflow:scroll">{{ $post->description }}</p>
                </div>
            </div>
            @if (isset($comments) && $comments->count() > 0)
                <div class="col-5 scrollbar" style="height: 500px;overflow:scroll">
                    @foreach ($comments as $comment)
                        <div class="d-flex align-items-center">
                            <div><img src="{{ asset('img/default.png') }}" height="40px" alt=""></div>
                            <div>{{ $comment->user_id }}</div>
                        </div>
                        <div>
                            <p style="margin-left:40px">{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border border-light" style="height: 500px">
                    <p class="mt-5 text-center text-danger">No comments found.</p>
                </div>
            @endif
            <form action="{{ route('post#createComment', $post->id) }}" class="form d-flex col-12" method="POST">
                @csrf
                <textarea class="form-control" name="comment" rows="2" placeholder="Enter Comment" required></textarea>
                <input type="submit" value="Submit" class="btn btn-info">
            </form>
        </div>
    </div>
@endsection

{{-- this is new branch and updated for comment --}}
