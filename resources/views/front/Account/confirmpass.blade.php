@extends('front.layouts.master')


@section('content')
<!-- LOGIN SECTION -->
<section class="login-section">
    <div class="login-background">
        <div class="login-authentification">
            <img src="{{asset('back/assets/images/icons/oneJob-login.png')}}" alt="oneJob-login" />
            <h3>@lang('front.passyenile')</h3>

            <div class="log-reg-tabs-wrapper">
                <div class="log-reg-tabs">
                    <div class="log-tab active" id="log_tab"></div>
                    <div class="reg-tab" id="reg_tab"></div>
                </div>
            </div>
            
<form action="{{route('confirm_post')}}" class="row mx-0 register-form mt-4"  id="register_form" method="POST">
    @csrf

    <div class="form-group login-form-group col-lg-10 col-md-10">
        <label for="reg_email">@lang('front.epoct')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
        <input type="email" name="email" placeholder="@lang('front.emaildaxilet')" value="{{ old('email') }}" required autofocus />
    </div>
    <div class="form-group login-form-group col-lg-10 col-md-10">
        <label for="reg_password">@lang('front.pass')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
        <input type="password" name="password" placeholder="@lang('front.sifredaxilet')" id="password"/>
    </div>
    <div class="form-group login-form-group col-lg-10 col-md-10">
        <label for="reg_password">@lang('front.tekrarpass')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
        <input type="password" name="password_confirmation" placeholder="@lang('front.tekrarpass')" />
    </div>
    
    <div class="col-lg-10 col-md-10 login-buttons">
        <button class="login-registration">@lang('front.daxilol')</button>
        
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
                

                minlength: {
                    'AZ': 'Bu sahə üçün minimum 8 simvol limiti keçilməlidir!',
                    'EN': 'Minimum 8 characters limit should not be exceeded for this field!',
                    'RU': 'Минимальное количество символов для этого поля - 8!',
                    'TR': 'Bu alanda en az 8 karakter sınırı aşılmamalıdır!'
                },
                equalTo: {
                    'AZ': 'Bu sahə şifrə ilə uyğun olmalıdır!',
                    'EN': 'This field must match the password!',
                    'RU': 'Это поле должно совпадать с паролем!',
                    'TR': 'Bu alan şifreyle eşleşmelidir!'
                }
            };

            return errorMessages[field][lang] || errorMessages[field]['AZ']; // Varsayılan olarak İngilizce mesaj kullan
        }

        $("#register_form").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password",
                    minlength: 8

                },
                


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
                    
                    minlength: function() {
                        return getErrorMessage('minlength', lang);
                    }
                },
                password_confirmation: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                    equalTo: function() {
                        return getErrorMessage('equalTo', lang);
                    },
                    minlength: function() {
                        return getErrorMessage('minlength', lang);
                    }
                },
              
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