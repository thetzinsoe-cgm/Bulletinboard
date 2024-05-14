@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-sm my-5 col-8 m-auto p-0">
        <div class="card-header d-flex justify-content-between">
            {{-- @if (url()->current() == url()->previous()) --}}
                <a href="{{ route('post#postList') }}" class="btn btn-info">Back</a>
            {{-- @else --}}
                {{-- <a href="{{ url()->previous() }}" class="btn btn-info">Back</a> --}}
            {{-- @endif --}}
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show position-fixed col-6" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                <div class="col-5 scrollbar my-3" style="height: 500px;overflow:scroll">
                    @foreach ($comments as $comment)
                        @if ($comment->user_id == auth()->user()->id)
                            <a href="{{ route('post#editComment', $comment->id) }}"
                                class="float-right border rounded rounded-circle px-2">
                                <img src="{{ asset('fontawesome-free/svgs/solid/ellipsis-v.svg') }}" height="10px"
                                    alt="Vertical Ellipsis Icon">
                            </a>
                        @endif
                        <div class="d-flex align-items-center">
                            <div><img src="{{ asset('img/default.png') }}" height="30px" alt=""></div>
                            <div>{{ $comment->name }}</div>
                        </div>

                        <div style="margin-left:40px;padding:0">
                            <p class="m-0 p-0">{{ $comment->comment }}</p>
                            <small>{{ $comment->updated_at }}</small>
                        </div>
                        <hr>
                    @endforeach
                </div>
            @else
                <div class="border border-light" style="height: 500px">
                    <p class="mt-5 text-center text-danger">No comments found.</p>
                </div>
            @endif
            @if (isset($editComment))
                <form action="{{ route('post#updateComment', $editComment->id) }}" class="d-flex col-10 p-0"
                    method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea class="form-control" name="comment" placeholder="Enter Comment" required>{{ $editComment->comment }}
                    </textarea>
                    <div><input type="submit" value="Update" class="btn btn-info"></div>
                </form>
                <div><a href="{{ route('post#comment', $editComment->post_id) }}" class="btn btn-info mx-2">Cancel</a>
                </div>
                <div>
                    <form action="{{ route('post#deleteComment', $editComment->id) }}" method="POST">
                        @csrf
                        <div><input type="submit" value="Delete" class="btn btn-danger"></div>
                    </form>
                </div>
            @else
                <form action="{{ route('post#createComment', $post->id) }}" class="form d-flex col-12" method="POST">
                    @csrf
                    <textarea class="form-control" name="comment" rows="2" placeholder="Enter Comment" required></textarea>
                    <input type="submit" value="Submit" class="btn btn-info">
                </form>
            @endif
        </div>
    </div>
@endsection
