@props([
    'title' => 'Module b samsung'
])
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Module b samsung">
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap.min.css')}}">
    <title>{{$title}}</title>
</head>
<body>
<header class="bg-body-tertiary">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('home')}}">HR Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('login')}}">Login</a>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('public.holidays')}}">Public holidays</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('employees.index')}}">Employees</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('holidays.index')}}">Holidays</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('tax-brackets.index')}}">Tax brackets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('leave-requests.index')}}">Leave requests</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('payslip.index')}}">Payslips</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('logout')}}">Logout</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<main class="container py-5">
    {{$slot}}
</main>
<x-alerts/>
<script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
