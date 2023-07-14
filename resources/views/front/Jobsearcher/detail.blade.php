@extends('front.layouts.master')

@section('content')

<style>

    .jobsearcher-profile {
        position: relative;
    }

    .heart-icon,
    .red-heart-icon {
        position: absolute;
        top: 50%;
        bottom: 50%;
        transform: translate(-50%, -50%);
        right: 50%;
        left: 50%;
    }

    @media screen and (max-width: 992px) {
        .heart-icon,
        .red-heart-icon {
            width: 14px;
            height: 14px;
        }
    }
</style>

<!-- MAIN PART -->
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

        <div>
            <h3>@lang('front.isaxtar') </h3>
        </div>
        
    </section>

    <!-- JOBSEARCHER INFORMATION -->
    <section class="jobsearcher-inner">
        <div class="container jobsearcher-inner-container">
            <div class="row">
                <div class="col-12">
                    <div class="jobsearcher-profile">
                        <div class="jobsearcher-profile-wrapper">
                            <div class="jobsearcher-avatar">
                                <img src="https://1is.butagrup.az/{{$jobdetail->image}}" alt="jobsearcher-avatar">
                            </div>
                            <div class="jobsearcher-information">
                                <div class="jobsearcher-text">
                                    <h3>{{$jobdetail->name}} {{$jobdetail->surname}}</h3>
                                </div>
                            </div>
                            
                            <img src="{{ asset('back/assets/images/icons/heart.png') }}" alt="heart" class="heart-icon" data-cv-id="{{$jobdetail->id}}" style="{{ in_array($jobdetail->id, $likes) ? 'display: none;' : 'display: inline-block;' }}">
                            <img src="{{ asset('back/assets/images/icons/red-heart.png') }}" alt="red-heart" class="red-heart-icon" data-cv-id="{{$jobdetail->id}}" style="{{in_array($jobdetail->id, $likes) ? 'display: inline-block;' : 'display: none;' }}">

                        </div>
                        


                        <form method="GET" action="{{ route('downloadcv', $jobdetail->id) }}">
                            
                            <div class="input-cv">
                                <label for="input-cv">

                                    <span>@lang('front.cvfile')</span>
                                    <input id="input-cv" type="submit" style="visibility: hidden;" name="upload" accept=".pdf,.docx,.doc,.png,.jpg">
                                    <img src="{{ asset('back/assets/images/icons/input-download.png') }}" alt="download">
                            </label>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <header>@lang('front.ismelumat')</header>
                                <div class="row w-100 m-0 job-information-row">
                                    <div class="col-6">
                                        <div class="job-information">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch6.png')}}" alt="jbsrch1" />
                                            </div>
                                            <div>
                                                <h5>@lang('front.isleyeceyi')</h5>
                                                <p>{{$jobdetail->position}}</p>
                                            </div>
                                        </div>
                                        <div class="job-information">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch5.png')}}" alt="jbsrch2" />
                                            </div>
                                            <div>
                                                <h5>@lang('front.educ')</h5>
                                                <p>{{$jobdetail->edu_title}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="job-information">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch6.png')}}" alt="jbsrch1">
                                            </div>
                                            <div>
                                                <h5>@lang('front.exp')</h5>
                                                <p>{{$jobdetail->exp_title}}</p>
                                            </div>
                                        </div>
                                        <div class="job-information">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch4.png')}}" alt="jbsrch3" />
                                            </div>
                                            <div>
                                                <h5>@lang('front.minsalary')</h5>
                                                <p>{{$jobdetail->salary}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                        </div>  
                        <div class="col-12 mt-3">
                            <div>
                                <header>@lang('front.educ')</header>
                                <div class="row w-100 m-0 job-information-row">
                                        <div class="job-information w-75">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch6.png')}}" alt="jbsrch1" />
                                            </div>
                                            <div>
                                                @if(!$jobdetail->about_education or $jobdetail->about_education == NULL )
                                                <h5>@lang('front.tehsilyoxdur')</h5>
                                                @else
                                                <h5>{!! html_entity_decode($jobdetail->about_education) !!}</h5>
                                                @endif
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div>
                                <header>@lang('front.bacariq')</header>
                                <div class="jobsearcher-ability">
                                    @if(!$jobdetail->skills or $jobdetail->skills == NULL )
                                    <span>@lang('front.bacyoxdur')</span>
                                    @else
                                    {!! html_entity_decode($jobdetail->skills) !!}
                                    @endif
                                    
                                </div>
                            </div>
                        </div>                      
                    </div>
                        
                </div>
                <div class="col-md-5 mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <header>@lang('front.exp')</header>
                                <div class="row w-100 m-0 job-information-row2">
                                    <div class="col-12 px-0">
                                        <div class="job-information">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch6.png')}}" alt="jbsrch1" />
                                            </div>
                                           <div>
                                                @if(!$jobdetail->work_history or $jobdetail->work_history == NULL )
                                                <span>@lang('front.tecyoxdur')</span>
                                                @else
                                                {!! html_entity_decode($jobdetail->work_history) !!}
                                                @endif
                                           </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div>
                                <header>@lang('front.sexsi')</header>
                                <div class="row w-100 m-0 job-information-row3">
                                    <div class="col-12 px-0 d-flex flex-column justify-content-between align-items-center">
                                        <div class="job-information w-100 last-job-information">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch6.png')}}" alt="jbsrch1" />
                                            </div>
                                            <div>
                                                <h5>@lang('front.contel')</h5>
                                                <p>
                                                    @if(!$jobdetail->contact_phone or $jobdetail->contact_phone == NULL )
                                                    <span>-</span>
                                                    @else
                                                    {{$jobdetail->contact_phone}}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="job-information w-100 last-job-information d-flex">
                                            <div class="job-information-img">
                                                <img src="{{asset('back/assets/images/icons/jbsrch5.png')}}" alt="jbsrch2" />
                                            </div>
                                            <div>
                                                <h5>@lang('front.email')</h5>
                                                <p>@if(!$jobdetail->contact_mail or $jobdetail->contact_mail == NULL )
                                                    <span>-</span>
                                                    @else
                                                   <a class="apply-button" style="color: black" href="mailto:{{ $jobdetail->contact_mail }}" > <p>{{ $jobdetail->contact_mail }}</p></a>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
        
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var heartIcons = document.querySelectorAll('.heart-icon');
    
        heartIcons.forEach(function (icon) {
            icon.addEventListener('click', function () {
            var cvId = this.getAttribute('data-cv-id');
            var redHeartIcon = document.querySelector('.red-heart-icon[data-cv-id="' + cvId + '"]');
            var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    
            if (isLoggedIn) {
                this.style.display = 'none';
                redHeartIcon.style.display = 'inline-block';
            }
    
            // AJAX request
            var xhr = new XMLHttpRequest();
            var url = '{{ route('cvlike') }}';
            var params = 'cv_id=' + cvId + '&_token=' + '{{ csrf_token() }}';
    
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    if (!isLoggedIn) {
                    redHeartIcon.style.display = 'inline-block';
                    icon.style.display = 'none'; // Hide the white heart icon for anonymous users
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
                var cvId = this.getAttribute('data-cv-id');
                var redHeartIcon = document.querySelector('.heart-icon[data-cv-id="' + cvId + '"]');
                var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    
                if (isLoggedIn) {
                    this.style.display = 'none';
                    redHeartIcon.style.display = 'inline-block';
                }
    
                // AJAX isteği
                var xhr = new XMLHttpRequest();
                var url = '{{ route('cvdislike') }}'; // Dislike işlemi için uygun URL'yi buraya yazın
                var params = 'cv_id=' + cvId + '&_token=' + '{{ csrf_token() }}';
    
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            if (!isLoggedIn) {
                                redHeartIcon.style.display = 'inline-block';
                                icon.style.display = 'none'; // Hide the white heart icon for anonymous users
    
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
<link rel="stylesheet" href="{{asset('front/css/jobsearch.css')}}">
@endsection

