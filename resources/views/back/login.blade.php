
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>1is | İdarəetmə paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="1is | İdarəetmə paneli" name="description" />
    <meta content="KananMirza" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset($setting->favicon)}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('back/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('back/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('back/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body >
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Xoş Gəlmişsiniz !</h5>
                                    <p>1is İdarəetmə panelinə giriş edin</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="{{asset('back/assets/images/profile-img.png')}}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="auth-logo">
                            <a href="javascript:void(0)" class="auth-logo-light">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset($setting->logo)}}" alt="" class="rounded-circle" height="60">
                                            </span>
                                </div>
                            </a>

                            <a href="javascript:void(0)" class="auth-logo-dark">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{asset($setting->logo)}}" alt="" class="rounded-circle" height="60">
                                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal" action="{{route('adminLogin_post')}}" method="POST">
                                @csrf
                                @include('back.layouts.messages')
                                <div class="mb-3">
                                    <label for="username" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="username" name="email" value="{{old('email')}}" placeholder="Email daxil edin">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Şifrə</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control" value="{{old('password')}}" name="password" placeholder="Şifrə daxil edin" aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                    <label class="form-check-label" for="remember-check">
                                        Məni xatırla
                                    </label>
                                </div>

                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Giriş et</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    <div>
                        <p>© <script>document.write(new Date().getFullYear())</script> 1is. Developed with <i class="mdi mdi-heart text-danger"></i> by KananMirza</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end account-pages -->

<!-- JAVASCRIPT -->
<script src="{{asset('back/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('back/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('back/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('back/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('back/assets/libs/node-waves/waves.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('back/assets/js/app.js')}}"></script>
</body>

</html>
