@extends('front.layouts.master')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/4.0.0/jquery.validate.unobtrusive.min.js" integrity="sha512-xq+Vm8jC94ynOikewaQXMEkJIOBp7iArs3IhFWSWdRT3Pq8wFz46p+ZDFAR7kHnSFf+zUv52B3prRYnbDRdgog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('content')
<section class="login-section">
        <div class="login-background">
            <div class="login-authentification">
                <img src="{{asset('back/assets/images/icons/oneJob-login.png')}}" alt="oneJob-login" />
                <h3>@lang('front.saytagir')</h3>
              
                 <form id="login-form" action="{{route('forget_post')}}" class="row login-form" method="POST">
                    @csrf
                    <div class="form-group login-form-group col-lg-9 col-md-7">
                        <label for="login_email">@lang('front.epoct')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
                        <input type="email" name="email" placeholder="@lang('front.emaildaxilet')" />
                    </div>

                    <div class="col-lg-9 col-md-7 login-buttons">
                        <button class="login-registration" type="submit">@lang('front.daxilet')</button>
                    </div>
                    <div class="col-lg-9 col-md-7 login-buttons">
                        <a href="{{ route('login') }}" class="login-registration">geri</a>

                    </div>
                </form>

            </div>
        </div>
    </section>

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
                    }
                };

                return errorMessages[field][lang] || errorMessages[field]['AZ']; // Varsayılan olarak İngilizce mesaj kullan
            }

            $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        email: function() {
                            return getErrorMessage('email', lang);
                        }
                    }
                },
                submitHandler: function(form) {
                    form.submit(); // Formu gönder
                }
            });
        });
    </script>




    @endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/login.css')}}">
@endsection