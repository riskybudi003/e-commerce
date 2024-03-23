<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
</head>

<body class="body">
    @include('User.layout.navbar')
    <div class="container content-home">
        <div class="content mt-4 mb-5 pb">
            <div class="section-content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="footer p-5 border-top">
        <div class="f-content row">
            <div class="col md-6">
                <div class="logo-footer">
                    <h3 class="logo cl-dark">Masbud E-Commerce</h3>
                </div>
            </div>
            <div class="col md-6">
                <div class="f-content row">
                    <div class="col md-6">
                        <p class="f-text">Social Media</p>
                        <ul class="menu">
                            <li>Instagram</li>
                            <li>Facebook</li>
                            <li>Twitter</li>
                        </ul>
                    </div>
                    <div class="col md-6">
                        <div class="f-content row">
                            <div class="col md-6">
                                <p class="f-text">Category</p>
                                <ul class="menu">
                                    @foreach ($category as $cat)
                                        <li>{{ $cat->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        @yield('script')

</body>

</html>
