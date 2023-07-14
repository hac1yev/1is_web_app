@extends('front.layouts.master')

{{-- <style> 
    .log-reg-tabs-wrapper {
        margin-top: 20px;
        width: 84%;
    }

    .log-reg-tabs {
    width: 80%;
    display: flex;
    margin: 0 auto;
    gap: 5px;
    background: #5B5B5B;
    border-radius: 40px;
    padding: 5px 7px;
    }   

    .log-tab, .reg-tab {
        width: 50%;
        padding-top: 8px;
        padding-bottom: 8px;
        border-radius: 40px;
        font-family: 'Outfit';
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
        line-height: 18px;
        color: #FFFFFF;
        text-align: center;
    }

    .log-tab.active {
        background: #8843E1;
        border: 1px solid #682DB3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.15);
    }
</style> --}}

@section('content')
<section class="login-section">
        <div class="login-background">
            <div class="login-authentification">
                <img src="{{asset('back/assets/images/icons/oneJob-login.png')}}" alt="oneJob-login" />
                <h3>@lang('front.saytagir')</h3>
                {{-- <div class="log-reg-tabs-wrapper">
                    <div class="log-reg-tabs">
                        <div class="log-tab active" id="log_tab">Log in</div>
                        <div class="reg-tab" id="reg_tab">Sign in</div>
                    </div>
                </div> --}}
                <form action="{{ route('login_post') }}" class="row login-form" method="POST" id="register_form">
                    @csrf
                    <div class="form-group login-form-group col-lg-9 col-md-7">
                        <label for="login_email">@lang('front.epoct')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
                        <input type="email" name="email" required placeholder="@lang('front.emaildaxilet')" />
                    </div>
                    <div class="form-group login-form-group col-lg-9 col-md-7">
                        <label for="login_password">@lang('front.pass')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
                        <input type="password" name="password" required placeholder="@lang('front.sifredaxilet')" />
                    </div>
                    <div class="login-bottom">
                        <div class="remember-me-checkbox">
                            <input type="checkbox" name="remember" id="remember" />
                            <label for="remember"><b>@lang('front.remember')</b></label>
                        </div>
                        <a class="forgot-password" href="{{route('forget')}}"><b>@lang('front.sifreunut')</b></a>
                    </div>

                    <div class="col-lg-9 col-md-7 login-buttons">
                        <button class="login-registration" type="submit">@lang('front.daxilol')</button>                 
                        <span>@lang('front.veya')</span>
                        <a href="{{ route('register') }}" class="login-registration">@lang('front.register')</a>
                    </div>
                </form>


            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var lang = "{{ app()->getLocale() }}"; // Dil seçimini al

        function getErrorMessage(field, lang) {
            var errorMessages = {
                required: {
                    'AZ': 'Bu sahə doldurulmalıdır!',
                    'EN': 'This field is required!',
                    'RU': 'Поле обязательно для заполнения!',
                    'TR': 'Bu alan zorunludur!'
                },
                email: {
                    'AZ': 'Düzgün bir email adresi daxil edin.',
                    'EN': 'Please enter a valid email address.',
                    'RU': 'Введите действительный адрес электронной почты.',
                    'TR': 'Geçerli bir email adresi giriniz.'
                },
                
            };

            return errorMessages[field][lang] || errorMessages[field]['AZ']; // Varsayılan olarak İngilizce mesaj kullan
        }

        $("#register_form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },

            messages: {
                email: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    email: function() {
                        return getErrorMessage('email', lang);
                    },
                    
                },

                password: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                    
                }
            },
            submitHandler: function(form) {
                form.submit(); // Formu gönder
            }
        });
    });

    </script>

{{-- <script>
    const login_form = document.querySelector('#login_form');
    const register_form = document.querySelector('#register_form');
    const log_tab = document.querySelector('#log_tab'); 
    const reg_tab = document.querySelector('#reg_tab'); 

    reg_tab.addEventListener('click', () => {
        login_form.style.display = 'none';
        register_form.style.display = 'flex';
        reg_tab.classList.add('active');
        log_tab.classList.remove('active');
    });

    log_tab.addEventListener('click', () => {
        register_form.style.display = 'none';
        login_form.style.display = 'flex';
        reg_tab.classList.remove('active');
        log_tab.classList.add('active');
    });
</script> --}}
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/login.css')}}">
@endsection