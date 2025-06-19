<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>

    @include('partials.style_head')
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">

            @include('partials.sidebar')

            <div class="col p-0 m-0">
                <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse"
                    class="border rounded-3 p-1 text-decoration-none position-fixed bg-dark text-light py-5"
                    style="top: 50vh; transform: translateY(-50%)">
                    <i class="bi bi-list bi-lg py-2 p-1"></i>
                </a>

                <div class="container mb-5">
                    @yield('content')
                </div>
            </div>
            
        </div>
    </div>
</body>
