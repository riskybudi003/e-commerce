<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Customer</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
    <div class="container auth-login pt-4 mt-4">
        @if (session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <div class="content-log">
            <div class="card login">

                <div class="row">
                    <div class="col-md-6">
                        <div class="image">
                            <img src="{{ asset('assets/images/logo/Reset password-rafiki.png') }}" alt=""
                                class="img-fluid image-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="header-card text-center mb-3">
                            <h1>Sign Up.</h1>
                        </div>
                        <div class="form">
                            <form action="{{ route('post-regist-user') }}" method="post">
                                @csrf
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" name="name"
                                        class="form-control form-control-xl @error('name') is-invalid @enderror"
                                        placeholder="Your Name">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="email" name="email"
                                        class="form-control form-control-xl @error('email') is-invalid @enderror"
                                        placeholder="Your email">
                                    <div class="form-control-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="number" name="no_hp"
                                        class="form-control form-control-xl @error('no_hp') is-invalid @enderror"
                                        placeholder="Your telephone number">
                                    <div class="form-control-icon">
                                        <i class="bi bi-phone"></i>
                                    </div>
                                    @error('no_hp')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <textarea type="text" name="alamat" class="form-control form-control-xl @error('alamat') is-invalid @enderror"
                                        placeholder="Your complete address"></textarea>

                                    @error('alamat')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="password" name="password"
                                        class="form-control form-control-xl @error('password') is-invalid @enderror"
                                        placeholder="Password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                    @error('password')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-dark btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                            </form>
                            <div class="text-center mt-5 text-lg fs-4">
                                <p class="text-gray-600">Already have an account? <a href="{{ route('login-user') }}"
                                        class="font-bold cl-dark">Log in</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
