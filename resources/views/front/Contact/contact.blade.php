@extends('front.layouts.master')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/4.0.0/jquery.validate.unobtrusive.min.js" integrity="sha512-xq+Vm8jC94ynOikewaQXMEkJIOBp7iArs3IhFWSWdRT3Pq8wFz46p+ZDFAR7kHnSFf+zUv52B3prRYnbDRdgog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
 @endforeach

        <div>
            <h3>@lang('front.contact')</h3>
        </div>
    </section>
    <div class="contact-container">
        <div class="col-md-4 contact-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset('back/assets/images/icons/contact-back.png')}})">
            <div>
                <h2>@lang('front.contactmel')</h2>
                <p class="emekdasliq">@lang('front.qururduy')</p>
                <div class="contact-data">
                    <div class="phonebox">
                        <div>
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.0003 5.00024C12.1033 5.00024 13.0003 5.89724 13.0003 8.00024H15.0003C15.0003 4.77524 13.2253 3.00024 10.0003 3.00024V5.00024ZM13.4223 10.4432C13.2301 10.2686 12.9776 10.1754 12.7181 10.1835C12.4585 10.1915 12.2123 10.3001 12.0313 10.4862L9.63828 12.9472C9.06228 12.8372 7.90428 12.4762 6.71228 11.2872C5.52028 10.0942 5.15928 8.93324 5.05228 8.36124L7.51128 5.96724C7.69769 5.78637 7.80642 5.54006 7.81444 5.28045C7.82247 5.02083 7.72917 4.76828 7.55428 4.57624L3.85928 0.513239C3.68432 0.320596 3.44116 0.203743 3.18143 0.187499C2.92171 0.171254 2.66588 0.256897 2.46828 0.426239L0.298282 2.28724C0.125393 2.46075 0.0222015 2.69169 0.00828196 2.93624C-0.00671804 3.18624 -0.292718 9.10824 4.29928 13.7022C8.30528 17.7072 13.3233 18.0002 14.7053 18.0002C14.9073 18.0002 15.0313 17.9942 15.0643 17.9922C15.3088 17.9786 15.5396 17.8749 15.7123 17.7012L17.5723 15.5302C17.7417 15.3328 17.8276 15.077 17.8115 14.8173C17.7954 14.5576 17.6788 14.3143 17.4863 14.1392L13.4223 10.4432Z"
                                    fill="white" />
                            </svg>

                        </div>
                        <p class="contact-info-p">{{$contact->phone}}</p>
                    </div>
                    <div class="mailbox">
                        <div>
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 0H0V16H20V0ZM18 4L10 9L2 4V2L10 7L18 2V4Z" fill="white" />
                            </svg>

                        </div>
                        <p class="contact-info-p"><a class="contact-email" href="mailto:name@email.com">{{$contact->email}}</a></p>
                    </div>
                    <div class="locationbox">
                        <div>
                            <svg width="17" height="21" viewBox="0 0 17 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.25001 0C6.06276 0.00258035 3.96584 0.872603 2.41923 2.41922C0.872611 3.96584 0.00258913 6.06276 8.77716e-06 8.25C-0.00261089 10.0374 0.581244 11.7763 1.66201 13.2C1.66201 13.2 1.88701 13.4963 1.92376 13.539L8.25001 21L14.5793 13.5353C14.6123 13.4955 14.838 13.2 14.838 13.2L14.8388 13.1978C15.919 11.7747 16.5026 10.0366 16.5 8.25C16.4974 6.06276 15.6274 3.96584 14.0808 2.41922C12.5342 0.872603 10.4373 0.00258035 8.25001 0ZM8.25001 11.25C7.65666 11.25 7.07665 11.0741 6.5833 10.7444C6.08995 10.4148 5.70543 9.94623 5.47837 9.39805C5.25131 8.84987 5.1919 8.24667 5.30765 7.66473C5.42341 7.08279 5.70913 6.54824 6.12869 6.12868C6.54825 5.70912 7.08279 5.4234 7.66474 5.30764C8.24668 5.19189 8.84988 5.2513 9.39806 5.47836C9.94624 5.70542 10.4148 6.08994 10.7444 6.58329C11.0741 7.07664 11.25 7.65666 11.25 8.25C11.249 9.04535 10.9326 9.80783 10.3702 10.3702C9.80784 10.9326 9.04535 11.249 8.25001 11.25Z"
                                    fill="white" />
                            </svg>

                        </div>
                        <p class="contact-info-p" style="margin-left:23px;">
                            @php
                            $lang = config('app.locale');
                        @endphp
                           
                                @if ($lang == 'EN')
                                    {{$contact->address_en}}
                                @elseif ($lang == 'RU')
                                    {{$contact->address_ru}}
                                @elseif ($lang == 'TR')
                                    {{$contact->address_tr}}
                                @else
                                    {{$contact->address_az}}
                                @endif
                        </p>
                    </div>
                    <!-- <div class="contact-right-img">
                        <img src="../images/contact-right.png" alt="">
                    </div> -->
                </div>
            </div>
            <!-- SOCIAL MEDIA -->
            <div class="social-media">
                <div>
                    <a href=""><img src="{{asset('back/assets/images/icons/contact-twitter.png')}}" alt=""></a>

                </div>
                <div style="background-color: white;">
                    <a href="https://www.instagram.com/1is_az/"><img style="border-radius: 35px;" src="{{asset('back/assets/images/icons/contact-insta.png')}}" alt=""></a>
                </div>
                <div>
                    <a href="https://www.linkedin.com/company/recruitment-azerbaycan/"><img src="{{asset('back/assets/images/icons/contact-link.png')}}" alt=""></a>
                </div>
            </div>
        </div>
        <div class="col-md-8 user-data">
            <div>
                <p class="contact-right">
                    <b>@lang('front.isciaxtar') ?</b> - @lang('front.con1'). <br>
                    <b>@lang('front.isaxtar')  ?</b> - @lang('front.con2'). <br>
                    <b>1is.az</b> @lang('front.olaraq') - @lang('front.con3').
                </p>
            </div>
            <div>
                <br>
                <form action="{{route('contactpost')}}" method="POST" id="register_form">
                    @csrf
                    <div class="userdata-container">
                       <div class="form1">
                            <div class="form-inner">
                                <label for="">@lang('front.adiniz')</label> 
                                <input type="text" placeholder="@lang('front.adiniz')" name="name" required> 
                            </div>
                            <div class="form-inner">
                                <label for="">@lang('front.soyadiniz')</label> 
                            <input type="text" placeholder="@lang('front.soyadiniz')" name="surname" required>
                            </div>
                       </div>
                       <br>
                       <div class="form1">
                            <div class="form-inner">
                                <label for="">@lang('front.epoct')</label> 
                                <input type="email" placeholder="@lang('front.epoct')" name="email" required> 
                            </div>
                            <div class="form-inner">
                                <label for="">@lang('front.telnom')</label> 
                                <input type="tel" placeholder="@lang('front.telnom')" name="phone" required>
                            </div>
                        </div>
                        <br>
                       <div class="form2">
                        <div class="form-inner2">
                            <label for="">@lang('front.mesaj')</label>
                            <input type="text" placeholder="@lang('front.mesajyaz')..." name="message" required>
                        </div>
                       </div>
                      <div class="contact-button">
                        <button class="contact-send" type="submit">@lang('front.gonder')</button>
                      </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/contact.css')}}">
<link rel="stylesheet" href="{{asset('front/css/swiper-bundle.min.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
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
                        'AZ': 'Bu sahə üçün minimum 9 simvol limiti keçilməlidir!',
                        'EN': 'Minimum 9 characters limit should not be exceeded for this field!',
                        'RU': 'Минимальное количество символов для этого поля - 9!',
                        'TR': 'Bu alanda en az 9 karakter sınırı aşılmamalıdır!'
                    },
                number: {
                    'AZ': 'Rəqəm daxil edin!',
                    'EN': 'Enter a number!',
                    'RU': 'Введите число!',
                    'TR': 'Bir sayı girin!'
                },

               
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
                },
                surname: {
                    required: true,
                },

                phone: {
                    required: true,
                    number: true,
                    minlength: 9
                },
                message: {
                    required: true,

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

                name: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                },

                surname: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                  
                },

                phone: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                    minlength: function() {
                            return getErrorMessage('minlength', lang);
                        },

                    number: function() {
                        return getErrorMessage('number', lang);
                    }
                },
                message: {
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
@endsection