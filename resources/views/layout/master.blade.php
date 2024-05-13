<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Bulletin Board - User List</title>
    <!-- Custom fonts for this template -->
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div class="card-header d-flex justify-content-between align-items-center fixed-top">
        <h4 class="m-0 font-weight-bold text-primary ">
            <a href="{{ route('post#postList') }}" class=" text-decoration-none">Bulletin Board</a>
        </h4>
        <div class="dropdown dropleft">
            <a class="" type="button" data-toggle="dropdown" aria-expanded="false">
                @auth
                    @if (auth()->user()->img)
                        <img src="{{ asset('storage/images/' . auth()->user()->img) }}" height="50px" alt="">
                    @else
                        <img src="{{ asset('img/default.png') }}" height="50px" alt="">
                    @endif
                @else
                    <img src="{{ asset('img/default.png') }}" height="50px" alt="">
                @endauth

            </a>
            <div class="dropdown-menu">
                @auth
                    <button class="dropdown-item" type="button">{{ auth()->user()->name }}</button>
                    <a href="{{ route('user#detail', auth()->user()->id) }}" class="dropdown-item btn btn-info">Detail</a>
                    <a href="{{ route('user#changePassword')}}"
                        class="dropdown-item btn btn-info">Change Password</a>
                    <form method="POST" action="{{ route('user#signOut') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" class="btn btn-info">Logout</button>
                    </form>
                @else
                    <a class="dropdown-item" href="{{ route('user#login') }}" class="btn btn-info">Login</a>

                    @if (Route::has('user#create'))
                        <a class="dropdown-item" href="{{ route('user#create') }}" class="btn btn-info">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <div class="my-5"></div><br>
    @yield('content')

    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
