@extends('layout.master')
@section('content')
    <div class="card o-hidden border-0 shadow-lg my-5 col-6 m-auto">
        <div class="card-body p-0 pt-5">
            <div class="col m-auto">
                <div>
                    <div class="text-center">
                        <img src="{{ asset('img/default.png') }}" height="100px" alt="">
                    </div>
                    <div class="">
                        <div class="my-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Password Recovery</h1>
                            </div>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                    <br>
                                    <a href="{{ route('user#login')}}">click to login</a>
                                </div>
                            @endif
                            <!-- Add this div somewhere in your view file -->
                            <div id="pleaseWaitMessage" style="display: none;">Please wait...</div>

                            <form class="user" action="{{ route('user#sendPassword') }}" method="POST"
                                onsubmit="showPleaseWaitMessage()">
                                @csrf
                                <h3 class="my-4">Please fill login email to send password</h3>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        id="exampleInputEmail" placeholder="Email Address" required>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value = "Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function showPleaseWaitMessage() {
        document.getElementById('pleaseWaitMessage').style.display = 'block';
    }

    function hidePleaseWaitMessage() {
        document.getElementById('pleaseWaitMessage').style.display = 'none';
    }
</script>
