@extends('front.layouts.master')
 

<style>
    .swiper-wrapper {
        align-items: center;
    }

    .swiper-slide {
        height: max-content!important;
    }

    .swiper-slide-link {
        position: absolute;
        bottom: 30%;
        left: 5%;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        display: flex;
        align-items: center;
        text-align: center;
        color: #FFFFFF;
    }

    .swiper-sec {
        height: 250px!important;
    }

    @media screen and (max-width: 1000px) {
        .swiper-slide-link {
            left: 7%;
            bottom: 25%;
        }
    }

    @media screen and (max-width: 768px) {
        .swiper-slide-link {
            left: 13%;
            bottom: 13%;
        }
    }

    @media screen and (max-width: 500px) {
        .swiper-slide-link {
            left: 13%;
            bottom: 28%;
        }
    }
</style>

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>



 <!-- MAIN PART -->
 @foreach ($banner as $ban)
     
 <section class="main" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
 @endforeach

<form class="main-filter home-filter" method="GET" action="{{route('vsearch')}}">
    <div class="active-filter active-filter-jobsearchinner">
        <div class="filter1">
            <img src="https://1is-new.netlify.app/images/search.png" alt="">
            <input class="filter-input" placeholder="@lang('front.açar')" type="search" name="query" value="{{ old('query') }}">
        </div>
        <div class="filter2">
            <button class="filter-searc">@lang('front.axtar')</button>
            <div id="detail-btn" class="detail-search"><img src="https://1is-new.netlify.app/images/more.png" alt="">@lang('front.etrafliaxtar')</div>
        </div>
    </div>
    <div class="disabled-filter disabled-filter-jobsearchinner" id="getshow">
        <div class="row text-left pos-25 mt-header mt-2" >
            <div class="col-md-4 col-xs-3 button_mt button_mt_jobsearchinner">
                <div class="form-group mb-0">
                    <select class="form-control custom-select" name="city">
                      <option value="">@lang('front.city')</option>
                      @php
                            $lang = config('app.locale');
                        @endphp
                      @foreach($cities as $city)
                      <option value="{{$city->id}}" {{ $city->id == $request->input('city') ? 'selected' : '' }}>
                          @if ($lang == 'EN')
                              {{$city->title_en}}
                          @elseif ($lang == 'RU')
                              {{$city->title_ru}}
                          @elseif ($lang == 'TR')
                              {{$city->title_tr}}
                          @else
                              {{$city->title_az}}
                          @endif
                      </option>
                  @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-xs-3 button_mt">
                <div class="form-group mb-0">
                    <select class="form-control custom-select" name="category">
                      <option value="">@lang('front.cats')</option>
                      @foreach($allcategories as $category)
                        <option value="{{$category->id}}" {{ $category->id == $request->input('category') ? 'selected' : '' }}>
                            @if ($lang == 'EN')
                                {{$category->title_en}}
                            @elseif ($lang == 'RU')
                                {{$category->title_ru}}
                            @elseif ($lang == 'TR')
                                {{$category->title_tr}}
                            @else
                                {{$category->title_az}}
                            @endif
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-xs-3 button_mt">
                <div class="form-group mb-0">
                    <select class="form-control custom-select" name="find_worker" id="find_worker">
                      <option value="">@lang('front.jobtype')</option>
                      @foreach($job_types as $job_type)
                      <option value="{{$job_type->id}}" {{ $job_type->id == $request->input('find_worker') ? 'selected' : '' }}>
                          @if ($lang == 'EN')
                              {{$job_type->title_en}}
                          @elseif ($lang == 'RU')
                              {{$job_type->title_ru}}
                          @elseif ($lang == 'TR')
                              {{$job_type->title_tr}}
                          @else
                              {{$job_type->title_az}}
                          @endif
                      </option>
                  @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 col-xs-3 button_mt">
                <div class="form-group mb-0">
                    <select class="form-control custom-select" name="education">
                      <option value="">@lang('front.educ')</option>
                      @foreach($educations as $education)
                        <option value="{{$education->id}}" {{ $education->id == $request->input('education') ? 'selected' : '' }}>
                            @if ($lang == 'EN')
                                {{$education->title_en}}
                            @elseif ($lang == 'RU')
                                {{$education->title_ru}}
                            @elseif ($lang == 'TR')
                                {{$education->title_tr}}
                            @else
                                {{$education->title_az}}
                            @endif
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-xs-3 button_mt">
                <div class="form-group mb-0">
                    <select class="form-control custom-select" name="experience">
                      <option value="">@lang('front.exp')</option>
                      @foreach($experiences as $experience)
                      <option value="{{$experience->id}}" {{ $experience->id == $request->input('experience') ? 'selected' : '' }}>
                          @if ($lang == 'EN')
                              {{$experience->title_en}}
                          @elseif ($lang == 'RU')
                              {{$experience->title_ru}}
                          @elseif ($lang == 'TR')
                              {{$experience->title_tr}}
                          @else
                              {{$experience->title_az}}
                          @endif
                      </option>
                  @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-xs-3 button_mt">
                <div class="form-group mb-0">
                    <select class="form-control custom-select" name="company">
                        <option value="">@lang('front.companies')</option>
                    @foreach($allcompanies as $comp)
                    <option value="{{$comp->id}}" {{ $comp->id == $request->input('company') ? 'selected' : '' }}>{{$comp->name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
</section>

<section class="blocks">
<div class="info-block-main">
    <div class="info-blocks">
        <div class="block1">
            <img src="https://1is-new.netlify.app/images/doc.png" alt="">
            <p>
                <a href="{{ route('allvacancies') }}" style="color: #fff">
                    {{ count($allvacancies) }}<br> @lang('front.vacancies')
                </a>
            </p>
        </div>
        <div class="block1">
            <img src="https://1is-new.netlify.app/images/axtar.png" alt="">
            <p>
                <a href="{{ route('jobsearch') }}" style="color: #fff">
                    {{count($cvs)}} <br> @lang('front.jobsearch')
                </a>
            </p>  
        </div>
        <div class="block1">
            <img src="https://1is-new.netlify.app/images/compAny.png" alt="">
            <p>
                <a href="{{ route('allcompany') }}" style="color: #fff">
                    {{ count($allcompanies) }}<br> @lang('front.companies')
                </a>
            </p>  
        </div>
        <div class="block1">
            <img src="https://1is-new.netlify.app/images/menu-block.png" alt="">
            <p>{{count($allcategories)}} <br> @lang('front.cats')</p>
        </div>
    </div>
</div>
</section>

<div class="container custom-container">

<section class="swiper-sec">
<!-- CAROUSEL -->
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        @foreach($stories as $key=>$story)

      <a href="{{asset($story->stories)}}" data-fancybox="gallery" data-caption="Caption #1" class="swiper-slide">
        <img src="{{asset($story->image)}}" alt="">
        <a class="swiper-slide-link" href="{{$story->redirect_link}}">lorem</a>
      </a>
      @endforeach

    </div>  
    
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>
</section>

<script>
 
</script>


<!-- POPULAR CATEGORIES -->
<section class="popular-sec">
    <h1 class="popular-h1">@lang('front.popcats')</h1>
    <!-- HTML -->
    <div class="popular-div" id="category-container">
        @foreach ($categories as $category)
            <div class="pop-card1">
                <i class="{{$category->icon}}"></i>
                <div class="text-field">
                    <div class="text-field">
                        <p><a href="{{ route('vsearch', ['query' => '', 'category' => $category->id, 'city' => '', 'find_worker' => '', 'education' => '', 'experience' => '', 'work_type' => '']) }}" style="color: black">
                            @switch(app()->getLocale())
                            @case('EN')
                                {{ $category->title_en }}
                                @break
                            @case('TR')
                                {{ $category->title_tr }}
                            @break
                            @case('RU')
                                {{ $category->title_ru }}
                                @break
                            @default
                                {{ $category->title_az }}
                        @endswitch
                    </a></p>
                    </div>
                    <p>@lang('front.vaccount'): {{ $category->total_vacancies }}</p>
                </div>
                <div class="border-div"></div>
            </div>
        @endforeach
    </div>
    <div id="load-more-container">
        <button id="load-more-btn" class="pop-button" data-page="1">@lang('front.dahacox') <img class="btm-arrow" src="https://1is.butagrup.az/back/assets/images/icons/images-bottom-arrow.svg" alt=""></button>
        <button id="load-less-btn" class="pop-button" data-page="2" style="display: none">@lang('front.dahaaz') <img class="btm-arrow" src="https://1is.butagrup.az/back/assets/images/icons/images-top-arrow.svg"  alt=""></button>

    </div>
    
    <script>
        var loadMoreButton = document.getElementById('load-more-btn');
        var loadLessButton = document.getElementById('load-less-btn');

        var categoryContainer = document.getElementById('category-container');
        var page = 0;
        var limit = 9;

        loadMoreButton.addEventListener('click', function() {
            page++;
            var url = 'load-more?page=' + page;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var categories = data.data;
                    totalCount = data.totalCount;

                    categories.forEach(function(category) {
                        var div = document.createElement('div');
                        div.className = 'pop-card1';
                        div.innerHTML = `
                            <i class="${category.icon}"></i>
                            <div class="text-field">
                                <p><a href="/vsearch?query=&category=${category.id}&city=&find_worker=&education=&experience=&work_type=" style="color: black">
                                    ${ '{{ app()->getLocale() }}' === 'EN' ? category.title_en : '{{ app()->getLocale() }}' === 'TR' ? category.title_tr : ('{{ app()->getLocale() }}' === 'RU' ? category.title_ru : category.title_az) }
                                </a></p>
                                <p>@lang('front.vaccount'): ${category.total_vacancies}</p>
                            </div>
                            <div class="border-div"></div>
                        `;

                        categoryContainer.appendChild(div);
                    });

                    if (page == 2) {
                        loadMoreButton.style.display = 'none';
                        loadLessButton.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        });


    </script>
    
    <script>
        var loadLessButton = document.getElementById('load-less-btn');
        var categoryContainer = document.getElementById('category-container');
        var page = 1;
        var limit = 12;
        
        loadLessButton.addEventListener('click', function() {
            page = 1;
            var url = 'load-more?page=' + page;
    
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var categories = data.data;
                    totalCount = data.totalCount; // Toplam kategori sayısını güncelleyin
    
                    // Yeni kategorileri eklemeden önce mevcut kategorileri temizleyin
                    categoryContainer.innerHTML = '';
    
                    var remainingCategories = categories.slice(0, limit);
    
                    remainingCategories.forEach(function(category) {
                        var div = document.createElement('div');
                        div.className = 'pop-card1';
                        div.innerHTML = `
                        <i class="${category.icon}"></i>
                            <div class="text-field">
                                <p><a href="/vsearch?query=&category=${category.id}&city=&find_worker=&education=&experience=&work_type=" style="color: black">
                                    ${ '{{ app()->getLocale() }}' === 'EN' ? category.title_en : '{{ app()->getLocale() }}' === 'TR' ? category.title_tr : ('{{ app()->getLocale() }}' === 'RU' ? category.title_ru : category.title_az) }</a></p>
                                <p>@lang('front.vaccount'): ${category.total_vacancies}</p>
                            </div>
                            <div class="border-div"></div>
                        `;
    
                        categoryContainer.appendChild(div);
                    });
    
                    if (page <= 1) {
                        loadLessButton.style.display = 'none';
                        loadMoreButton.style.display = 'block';

                    }
                })
                .catch(error => {
                    console.log(error);
                });
        });
    </script>
    
    
</section>


<!-- COMPANY SECTION -->
<section class="company">
    <h1 class="popular-h1">@lang('front.companies')</h1>
    
    <div class="company-div">
        @foreach($companies as $key=>$company)
        
        <a href="{{route('compdetail', $company->id)}}">
            <div class="comp-card">
                <div class="inner2">
                    <img src="{{$company->image}}" class="img-fluid" alt="">
                </div>
                <div class="company-content">
                    <div class="inner1">
                        <p>{{$company->name}}</p>
                    </div>
                    <div class="inner3">
                        <div class="stars">
                            @php
                                $stars = round($company->average);
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $stars)
                                    <img src="https://1is-new.netlify.app/images/star-fil.png" alt="">
                                @else
                                    <img src="https://1is-new.netlify.app/images/star-emp.png" alt="">
                                @endif
                            @endfor
                        </div>
                        <p></p>
                        <p></p>
                        <p></p>

                        <div class="look-comp">
                            <img src="https://1is-new.netlify.app/images/look-comp.png" alt="">
                            <p>{{$company->view}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>    
        @endforeach

        

    </div>

    <button class="pop-button"><a href="{{route('allcompany')}}"  style="color: #ffff;">@lang('front.dahacox') <img class="btm-arrow" src="https://1is.butagrup.az/back/assets/images/icons/images-bottom-arrow.svg" alt=""></a></button>
</section>

<!-- NEW VACANSIES SECTION -->
<section class="new-vac">
    <h1 class="popular-h1">@lang('front.yenivak')</h1>
    <div class="new-vac-div">
        @foreach($vacancies as $key=>$vacancy)
            
        <div class="vac-card">
            <div class="vac-inner1">
                <a href="{{route('vacancydetail', $vacancy->id)}}" class="vac-inner1-a">{{$vacancy->title_az}}</a>
                <div class="second-part">
                    <span style="margin-right: 15px;" class="look-numb"> {{$vacancy->view}} <img src="https://1is-new.netlify.app/images/eye.png"></span>

                    <img src="{{ asset('back/assets/images/icons/heart.png') }}" alt="heart" class="heart-icon" data-vacancy-id="{{ $vacancy->id }}" style="{{ in_array($vacancy->id, $likes) ? 'display: none;' : 'display: inline-block;' }}">
                    <img src="{{ asset('back/assets/images/icons/red-heart.png') }}" alt="red-heart" class="red-heart-icon" data-vacancy-id="{{ $vacancy->id }}" style="{{ in_array($vacancy->id, $likes) ? 'display: inline-block;' : 'display: none;' }}">
        
                </div>
            </div>
            <div class="vac-inner2">
                <a href="{{route('vacancydetail', $vacancy->id)}}" class="vac-name">{{$vacancy->position}}</a>
            </div>
            <div class="vac-inner3">
                <div class="vac-inn1">
                    <img src="https://1is-new.netlify.app/images/building.png" alt="">
                    <a class="comp-link" href="{{route('compdetail', $vacancy->company_id)}}">{{$vacancy->name}}</a>
                </div>
                <div class="vac-inn2">
                    <img src="https://1is-new.netlify.app/images/clock.png" alt="">
                    <p class="vac-time">{{ date('d-m-Y', strtotime($vacancy->deadline)) }}</p>
                </div>
            </div>
            <div class="new-vac-badge">
                <p>@lang('front.yeni')</p>
            </div>
        </div>
       
        
        @endforeach
        
    </div>
    <button class="pop-button2 load_more_button" id ="$last_id"><a href="{{route('allvacancies')}}"  style="color: #ffff;">@lang('front.allvac') <img class="btm-arrow" src="https://1is.butagrup.az/back/assets/images/icons/images-bottom-arrow.svg" alt=""></a></button>
</section>

</div>
@endsection

@section('js')
<script>
    const moreSearch = document.getElementById('detail-btn')
    const moreSearchSect = document.getElementById('getshow')
    moreSearch.addEventListener('click' , () => {
        moreSearchSect.classList.toggle('filter-active');
    })

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
                } else {
                    window.location.href = '{{ route('login') }}';
                }

                // AJAX isteği
                var xhr = new XMLHttpRequest();
                var url = '{{ route('indexlike') }}'; // Favori ekleme için uygun URL'yi buraya yazın
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
                            Swal.fire({
                                icon: 'error',
                                title: `${response.error}`,
                                footer: `<a href="{{ route('login') }}">@lang('front.daxilol')</a>`,
                            });
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
        var url = '{{ route('idislike') }}'; // Dislike işlemi için uygun URL'yi buraya yazın
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
    Fancybox.bind("[data-fancybox]", {
  // Your custom options
});
</script>


@endsection



@section('css')
<style>
        .comp-card {
            width: 300px;
            height: 100px;
            position: relative;
            display: flex;
            flex-direction: row;
            gap: 6px;
            padding: 5px!important;
        }

        .company-content {
            width: 190px;
        }

        .inner1 {
            height: 20%;
        }

        .inner1 p {
            font-size: 13px!important;
            line-height: 16px!important;
        }

        .inner2 {
            width: 90px;
            height: 90px;
            border-radius: 5px;
        }

        .inner3 {
            position: absolute;
            bottom: 0;
            height: 20%;
        }

        .inner2 img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #fff;
            border-radius: 5px;
        }


        /* @media screen and (max-width: 507.5px) {
            .comp-card {
                width: 65vw;
            }
        } */
    </style>
@endsection