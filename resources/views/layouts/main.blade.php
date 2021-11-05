<!DOCTYPE html>
<html>

<head>
    <title>Laravel Livewire CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/trix.css">
    <script type="text/javascript" src="js/trix.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    @livewireStyles
    @livewireScripts
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                
                @auth
                    
                <li class="nav-item {{ Request::is('posts*') ? 'active' : '' }}">
                    <a class="nav-link" href="/posts">Posts </a>
                </li>
                @endauth
                @can('admin')
                <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="/users">Users</a>
                </li>
                <li class="nav-item {{ Request::is('categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="/categories">Categories</a>
                </li>
                @endcan

                <li>
                    {{-- <livewire:search> --}}
                        {{-- <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form> --}}
                </li>
            </ul>
            
        <br>
        <livewire:logout>
    </nav>

    {{-- @include('partials.navbar') --}}
    <br>
    
    @yield('container')

</body>

</html>
