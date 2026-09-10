@php
    $isCustomer = !!auth('customers')->user();
    $isPartner = !!auth('partners')->user();
    $isAdmin = !!auth()->user();
    $isSales = !!auth('salespersons')->user();
    $isLogged = collect([$isCustomer,$isPartner,$isAdmin,$isSales,])->some(fn($r)=>$r);
@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Module F Management">
    <title>Module F</title>
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap.min.css')}}">
</head>
<body>
<header class="bg-body-tertiary">
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('home')}}">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('auth.register')}}">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Login</a>
                            </li>
                        @endguest
                        @php
                            $showed = false;
                        @endphp
                        @if($isAdmin)
                            @php
                                $showed = true;
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('register.partner')}}">Register Partner</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('register.workers')}}">Register Salesperson</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('locals.index')}}">Locals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('packages.index')}}">Packages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('discounts.index')}}">Discounts</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="{{route('logout')}}">Logout</a>
                            </li>
                        @endif
                        {{--partners--}}
                        @if($isPartner && !$showed)
                            @php
                                $showed = false;
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('packages.index')}}">Packages</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="{{route('logout')}}">Logout</a>
                            </li>
                        @endif
                        @if($isSales && !$showed)
                            @php
                                $showed = false;
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('discounts.index')}}">Discounts</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="{{route('logout')}}">Logout</a>
                            </li>
                        @endif
                        @if($isCustomer && !$showed)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('package.buy')}}">Buy</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="{{route('logout')}}">Logout</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<main class="container py-3">
    {{$slot}}
</main>
<x-alerts></x-alerts>
<script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
