@extends('front.layouts.master')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/4.0.0/jquery.validate.unobtrusive.min.js" integrity="sha512-xq+Vm8jC94ynOikewaQXMEkJIOBp7iArs3IhFWSWdRT3Pq8wFz46p+ZDFAR7kHnSFf+zUv52B3prRYnbDRdgog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@section('content')

<style>
    .vac-inner1-a{
        background: #ecdbfc;
        color: #8843e1;
    }
</style>

@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

        <div class="header-links-div">
            <a class="header-links" href="{{route('profile')}}">
               @lang('front.umumi')
            </a>
            <a class="header-links" href="{{route('traningcreate')}}">
                @lang('front.training')
            </a>
            <a class="header-links" href="{{route('cvindex')}}">
                @lang('front.jobsearch')
            </a>
            <a class="header-links" href="{{route('announcesindex')}}">
                @lang('front.isegotur')
            </a>
        </div>
    </section>

    <section class="profile-section">
        <div class="profile-container">
            <div class="prof-cont-left">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <span class="profile-left-icons icon-1"></span>@lang('front.profilim')</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <span class="profile-left-icons icon-2"></span>
                        @lang('front.likes')
                    </a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <span class="profile-left-icons icon-3"></span>
                        @lang('front.tenzimleme')</a>
                    <a class="nav-link"  href="{{route('logout')}}" role="tab">
                        <span class="profile-left-icons icon-4"></span>
                        @lang('front.cixis')
                    </a>
                </div>
            </div>
            <div class="prof-cont-right">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                       <div class="prof-cont">
                        <div class="proftab-1">
                            <img src="{{asset('back/assets/images/icons/announce.png')}}" alt="">
                            <span>{{$vacancies->count()}} @lang('front.elan')</span>
                        </div>
                        <div class="proftab-1">
                            <img src="{{asset('back/assets/images/icons/file.png')}}" alt="">
                            <span>{{$cvs->count()}} @lang('front.cv')</span>
                        </div>
                       </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="new-vac-div">
                        @foreach ($favorits as $fav)

                            <div class="vac-card user-profile-card">                            

                                <div class="vac-inner1">
                                    <a href="#">{{$fav->title_az}}</a>
                                    <div class="second-part">
                                        <img src="{{ asset('back/assets/images/icons/heart.png') }}" alt="heart" class="heart-icon" data-vacancy-id="{{ $fav->vacancy_id }}" style="{{ in_array($fav->vacancy_id, $likes) ? 'display: none;' : 'display: inline-block;' }}">
                                        <img src="{{ asset('back/assets/images/icons/red-heart.png') }}" alt="red-heart" class="red-heart-icon" data-vacancy-id="{{ $fav->vacancy_id }}" style="{{ in_array($fav->vacancy_id, $likes) ? 'display: inline-block;' : 'display: none;' }}">
                                                               
                                    </div>
                                </div>
                                <div class="vac-inner2">
                                    <a href="{{route('vacancydetail', $fav->vacancy_id)}}" class="vac-name">{{$fav->position}}</a>
                                </div>
                                <div class="vac-inner3">
                                    <div class="vac-inn1">
                                        <img src="https://1is-new.netlify.app/images/building.png" alt="">
                                        <a class="comp-link" href="#">{{$fav->name}}</a>
                                    </div>
                                    <div class="vac-inn2">
                                        <img src="https://1is-new.netlify.app/images/clock.png" alt="">
                                        <p class="vac-time">{{date('d-m-Y', strtotime($fav->created_at))}}</p>
                                    </div>
                                </div>                           

                            </div>                               
                              @endforeach

                        </div>
                    </div>


                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                        <form class="form-horizontal"  method="POST" action="{{route('updatePassword')}}" id="register_form">
                            @csrf
                            <div class="form-group">
                              <label>@lang('front.epoct')</label>
                              <div>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                            </div>
                            </div>
                            <div class="form-group">
                              <label>@lang('front.movcudpass')</label>
                              <div class="form-innerdiv">
                                <input id="password-field" type="password" class="form-control" name="password">
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>@lang('front.yenipass')</label>
                              <div class="form-innerdiv">
                                <input id="password-field2" type="password" class="form-control" name="newpass">
                                <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                              </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('front.yenitekrarpass')</label>
                                <div class="form-innerdiv">
                                  <input id="password-field3" type="password" class="form-control" name="connewpass" >
                                  <span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                              </div>

                              <div class="form-send">
                                <button class="form-button">
                                    @lang('front.tesdiq')
                                </button>
                              </div>
                        </form>
                    </div>
                  </div>
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
                    
                    password: {
                        required: true,
                        minlength: 8
                    },
                    newpass: {
                        required: true,
                        minlength: 8
    
                    },

                    connewpass: {
                        required: true,
                        equalTo: "#password-field2",
                        minlength: 8
    
                    },
                    
    
    
                },
                messages: {
                    password: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        minlength: function() {
                            return getErrorMessage('minlength', lang);
                        }
                        
                    },
    
    
                    newpass: {
                        required: function() {
                            return getErrorMessage('required', lang);
                        },
                        
                        minlength: function() {
                            return getErrorMessage('minlength', lang);
                        }
                    },
                    connewpass: {
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


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var heartIcons = document.querySelectorAll('.heart-icon');
    
            heartIcons.forEach(function (icon) {
                icon.addEventListener('click', function () {
                    var vacancyId = this.getAttribute('data-vacancy-id');
                    var redHeartIcon = document.querySelector('.red-heart-icon[data-vacancy-id="' + vacancyId + '"]');
                    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    
                    if (isLoggedIn) {
                        this.style.display = 'none';
                        redHeartIcon.style.display = 'inline-block';
                    }
    
                    // AJAX isteği
                    var xhr = new XMLHttpRequest();
                    var url = '{{ route('like') }}'; // Favori əlavəsi üçün uyğun URL'yi buraya yazın
                    var params = 'vacancy_id=' + vacancyId + '&_token=' + '{{ csrf_token() }}';
    
                    xhr.open('POST', url, true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);
                                if (!isLoggedIn) {
                                    redHeartIcon.style.display = 'inline-block';
                                }
                            } else if (xhr.status === 403) {
                                var response = JSON.parse(xhr.responseText);
                                alert(response.error);
                            }
                        }
                    };
    
                    xhr.send(params);
                });
            });
        });
    </script>
    

   
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var heartIcons = document.querySelectorAll('.red-heart-icon');

    heartIcons.forEach(function (icon) {
    icon.addEventListener('click', function () {
        var vacancyId = this.getAttribute('data-vacancy-id');
        var redHeartIcon = document.querySelector('.heart-icon[data-vacancy-id="' + vacancyId + '"]');
        var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

        if (isLoggedIn) {
            this.style.display = 'none';
            redHeartIcon.style.display = 'inline-block';
        }

        // AJAX isteği
        var xhr = new XMLHttpRequest();
        var url = '{{ route('dislike') }}'; // Dislike işlemi için uygun URL'yi buraya yazın
        var params = 'vacancy_id=' + vacancyId + '&_token=' + '{{ csrf_token() }}';

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    if (!isLoggedIn) {
                        redHeartIcon.style.display = 'inline-block';
                    }
                } else if (xhr.status === 403) {
                    var response = JSON.parse(xhr.responseText);
                    alert(response.error);
                }
            }
        };

        xhr.send(params);
    });
});
});
</script>
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/profile.css')}}">
<link rel="stylesheet" href="{{asset('front/css/header.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js-link')
<script src="{{asset('front/js/profile.js')}}"></script>
@endsection
