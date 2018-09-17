<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Pharmacy') }} / @yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    @yield('style')
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        @auth
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            {{-- Admin dashboard --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fa fa-fw fa-dashboard"></i><span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            {{-- /Admin dashboard --}}

            {{-- Manufacturer --}}
            <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#manufacturer" data-parent="#manufacturer">
                    <i class="fa fa-fw fa-building-o"></i> <span class="nav-link-text">Manufacturer</span>
                </a>
                <ul class="sidenav-second-level collapse" id="manufacturer">
                    <li>
                        <a href="{{ route('manufacturer.index') }}"><i class="fa fa-eye"></i> View all manufacturer</a>
                    </li>
                    <li>
                        <a href="{{ route('manufacturer.create') }}"><i class="fa fa-plus"></i> Add new manufacturer</a>
                    </li>
                    <li>
                        <a href="{{ route('manufacturer.trash') }}"><i class="fa fa-trash-o"></i> Manufacturers in trash</a>
                    </li>
                </ul>
            </li>
            {{-- /Manufacturer --}}

            {{-- Purpose --}}
            <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#purpose" data-parent="#purpose">
                    <i class="fa fa-fw fa-stethoscope"></i> <span class="nav-link-text">Purpose</span>
                </a>
                <ul class="sidenav-second-level collapse" id="purpose">
                    <li>
                        <a href="{{ route('purpose.index') }}"><i class="fa fa-fw fa-eye"></i> View all purpose</a>
                    </li>
                    <li>
                        <a href="{{ route('purpose.create') }}"><i class="fa fa-fw fa-plus"></i> Add new purpose</a>
                    </li>
                    <li>
                        <a href="{{ route('purpose.trash') }}"><i class="fa fa-fw fa-trash-o"></i> Purposes in trash</a>
                    </li>
                </ul>
            </li>
            {{-- /Purpose --}}

            {{-- Medicine --}}
            <li class="nav-item">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#medicine" data-parent="#medicine">
                    <i class="fa fa-fw fa-heartbeat"></i> <span class="nav-link-text">Product</span>
                </a>
                <ul class="sidenav-second-level collapse" id="medicine">
                    <li>
                        <a href="{{ route('product.index') }}"><i class="fa fa-fw fa-eye"></i> View all products</a>
                    </li>
                    <li>
                        <a href="{{ route('product.create') }}"><i class="fa fa-fw fa-plus"></i> Add new product</a>
                    </li>
                    <li>
                        <a href="{{ route('product.trash') }}"><i class="fa fa-fw fa-trash-o"></i> Products in trash</a>
                    </li>
                </ul>
            </li>
            {{-- /Medicine --}}
        </ul>
        @endauth

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-fw fa-sign-in"></i> {{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-fw fa-pencil"></i> {{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#logout-modal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<div class="content-wrapper">
    <div class="container-fluid">
        {{-- Breadcrumbs --}}
        @auth
        @section('breadcrumb')
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        @show
        @endauth
        {{-- /Breadcrumbs --}}

        {{-- Error message --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Error message --}}
        {{-- Success message --}}
        @if(Session::has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- Success message --}}

        {{-- Content --}}
        <div class="content">
            @yield('content')
        </div>
        {{-- /Content --}}
    </div>

    {{-- Footer --}}
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Your Website 2018</small>
            </div>
        </div>
    </footer>
    {{-- /Footer --}}

    {{-- Scroll to Top Button --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    {{-- /Scroll to Top Button --}}

    {{-- Logout Modal --}}
    @auth
    <div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" form="logout-form">Logout</button>
                </div>
            </div>
        </div>
    </div>
    @endauth
    {{-- Logout Modal --}}

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
    @yield('script')
    <script src="{{ asset('js/admin-script.js') }}"></script>
</div>
</body>
</html>
