@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg col-8 m-auto">
        <div class="card-body p-0">
            <a href="{{ route('post#postList') }}" class="m-5 btn btn-info">Back</a>
            <div class="row">
                <div class="col-lg-5 text-center d-flex align-items-center justify-content-center mb-5">
                    @if ($user->img)
                        <img src="{{ asset('storage/images/' . $user->img) }} " height="300px" alt="">
                    @else
                        <img src="{{ asset('img/default.png') }} " height="300px" alt="">
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="px-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Update Account!</h1>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="user" action="{{ route('user#update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-user"
                                    id="exampleFirstName" value="{{ $user->name }}" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user"
                                    id="exampleInputEmail"
                                    @if ($user != null) value={{ $user->email }} @endif
                                    placeholder="Email Address">
                            </div>

                            @if (Auth::user()->role == 1)
                                <div class="form-group">
                                    <select class="custom-select" name="role" id="inputGroupSelect01">
                                        <option selected disabled>Select Role</option>
                                        <option value="<?php echo config('constants.ADMIN_ROLE'); ?>" <?php if ($user->role == config('constants.ADMIN_ROLE')) {
                                            echo 'selected';
                                        } ?>>Admin</option>
                                        <option value="<?php echo config('constants.USER_ROLE'); ?>" <?php if ($user->role == config('constants.USER_ROLE')) {
                                            echo 'selected';
                                        } ?>>User</option>
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="file" name="image" class="form-control" id="exampleFirstName">
                            </div>

                            <input type="submit" class="btn btn-primary btn-user btn-block" value = "Update Account">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        @if (!empty($postComment) && $postComment->hasPages())
            @foreach ($postComment as $post)
                <div class="mx-5">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->description }}</p>

                    <i>comment</i>
                    @if (!empty($post->comments) && count($post->comments) > 0)
                        <ul>
                            @foreach ($post->comments as $comment)
                                <li>
                                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }} -
                                    <small>{{ $comment->created_at }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No comments found.</p>
                    @endif
                </div>
            @endforeach
            <div class="m-auto">{{ $postComment->links() }}</div>
        @else
        @endif

    </div>
@endsection
