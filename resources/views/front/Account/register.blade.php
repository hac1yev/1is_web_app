    @extends('front.layouts.master')

    <style>
        .select2-container--default .select2-selection--multiple {
            background-color: transparent!important;
            padding: 10px 15px;
        border: 1px solid #5b5b5b;
        border-radius: 8px;
        }
    </style>

    @section('content')
    <!-- LOGIN SECTION -->
    <section class="login-section">
        <div class="login-background">
            <div class="login-authentification">
                <img src="{{asset('back/assets/images/icons/oneJob-login.png')}}" alt="oneJob-login" />
                <h3>@lang('front.register')</h3>

                <div class="log-reg-tabs-wrapper">
                    <div class="log-reg-tabs">
                        <div class="log-tab active" id="log_tab"></div>
                        <div class="reg-tab" id="reg_tab"></div>
                    </div>
                </div>
                
    <form action="{{ route('register_post') }}" class="row mx-0 register-form mt-4"  id="register_form" method="POST">
        @csrf
        <div class="form-group login-form-group col-md-5">
            <label for="reg_name">@lang('front.ad')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
            <input placeholder="@lang('front.addaxilet')" type="text" name="name"/>
        </div>
        <div class="form-group login-form-group col-md-5">
            <label for="reg_name">@lang('front.soyad')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
            <input placeholder="@lang('front.soyaddaxil')" type="text" name="surname"/>
        </div>
        <div class="form-group login-form-group col-md-5">
            <label for="reg_email">@lang('front.epoct')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
            <input type="email" name="email" placeholder="@lang('front.emaildaxilet')"/>
            
        </div>
        <div class="form-group login-form-group col-md-5">
            <label for="reg_password">@lang('front.pass')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
            <input type="password" name="password" id="password" placeholder="@lang('front.sifredaxilet')"/>
        </div>
        <div class="form-group login-form-group col-md-10">
            <label for="reg_password">@lang('front.tekrarpass')<span style="color: rgba(192, 0, 0, 1)">*</span></label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('front.tekrarpass')"/>
        </div>
        
        
        <div class="form-group login-form-group col-md-10">
        <div id="no-limit">
            <p>@lang('front.cats')<span style="color: rgba(192, 0, 0, 1)">*</span></p>
            <select class="select2 form-select" style="width: 100%;" name="cat_id[]" multiple>
                <option value="" disabled></option>

                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title_az}}</option>
                @endforeach
            </select>
        </div>
    
        
    </div>

        <div class="col-lg-9 col-md-7 login-buttons">
            <button class="login-registration" type="submit">@lang('front.daxilol')</button>                 
            <span>@lang('front.veya')</span>
            <a href="{{ route('register') }}" class="login-registration">@lang('front.register')</a>
        </div>    
    </form>

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
                    maxlength: {
                        'AZ': 'Bu sahə üçün maksimum  simvol limiti keçilməlidir!',
                        'EN': 'Maximum  characters limit should not be exceeded for this field!',
                        'RU': 'Максимальное количество символов для этого поля - !',
                        'TR': 'Bu alan için maksimum  karakter sınırı aşılmamalıdır!'
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
                    name: {
                        required: true,
                        maxlength: 255,
                    },
                    surname: {
                        required: true,
                        maxlength: 255,
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
                    'cat_id[]': {
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
    
                    name: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        
                        maxlength: function() {
                            return getErrorMessage('maxlength', lang);
                        }
                    },

                    surname: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        
                        maxlength: function() {
                            return getErrorMessage('maxlength', lang);
                        }
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
                    'cat_id[]': {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        
                        
                    },
                },
                submitHandler: function(form) {
                    form.submit(); // Formu gönder
                }
            });
        });
    
    </script>

    <script>
        $(document).ready(function() {
        $('#no-limit .select2').select2({
            multiple: "multiple",
        });

        $('#limit-2 .select2').select2({
            multiple: "multiple",
            maximumSelectionLength: 2,
        });

        $('#limit-2-custom-message .select2').select2({
            multiple: "multiple",
            maximumSelectionLength: 2,
            language: {
            maximumSelected: (args) => args.maximum + ' 件しか選べないよ！'
            }
        });
        });
    </script>
    @endsection

    @section('css-link')
    <link rel="stylesheet" href="{{asset('front/css/login.css')}}">
    @endsection