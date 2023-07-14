@extends('front.layouts.master')


@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

        <div>
            <h3>@lang('front.jobsearch')</h3>
        </div>
        <form class="main-filter" method="GET" action="{{route('cvaxtar')}}">
            <div class="active-filter active-filter-jobsearchinner">
                <div class="filter1">
                    <img src="https://1is-new.netlify.app//images/search.png" alt="">
                    <input class="filter-input" placeholder="@lang('front.adaxtar')" type="search" name="query">
                </div>
                <div class="filter2">
                    <button class="filter-searc" type="submit">@lang('front.axtar')</button>
                    <div id="detail-btn" class="detail-search"><img src="https://1is-new.netlify.app/images/more.png" alt="">@lang('front.etrafliaxtar')</div>
                </div>
            </div>
            <div class="disabled-filter disabled-filter-jobsearchinner" id="getshow">
                <div class="row text-left pos-25 mt-header mt-2" >
                    <div class="col-md-4 col-xs-3 button_mt button_mt_jobsearchinner">
                        <div class="form-group mb-0">
                            <div class="dropdown-comp-2">
                                <div class="select_box">
                                   <select class="vac-select" name="city">
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
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-3 button_mt">
                        <div class="form-group mb-0">
                            <div class="dropdown-comp-2">
                                <div class="select_box">
                                   <select class="vac-select" name="category">
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
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-3 button_mt">
                        <div class="form-group mb-0">
                            <div class="dropdown-comp-2">
                                <div class="select_box">
                                   <select class="vac-select" name="find_worker">
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
                        </div>
                    </div>
    
                    <div class="col-md-4 col-xs-3 button_mt">
                        <div class="form-group mb-0">
                            <div class="dropdown-comp-2">
                                <div class="select_box">
                                   <select class="vac-select" name="education">
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
                        </div>
                    </div>
    
                    <div class="col-md-4 col-xs-3 button_mt">
                        <div class="form-group mb-0">
                            <div class="dropdown-comp-2">
                                <div class="select_box">
                                   <select class="vac-select" name="experience">
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
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-3 button_mt">
                        <div class="form-group mb-0">
                            <div class="dropdown-comp-2">
                                <div class="select_box">
                                   <select class="vac-select" name="gender">
                                    <option value="">@lang('front.cins')</option>
                                    @foreach($genders as $gen)
                                    <option value="{{$gen->id}}" {{ $gen->id == $request->input('gender') ? 'selected' : '' }}>
                                        @if ($lang == 'EN')
                                        {{$gen->title_en}}
                                    @elseif ($lang == 'RU')
                                        {{$gen->title_ru}}
                                    @elseif ($lang == 'TR')
                                        {{$gen->title_tr}}
                                    @else
                                        {{$gen->title_az}}
                                    @endif</option>
                                    @endforeach
                                   </select>
                                </div>
                              </div>
                        </div>
                    </div>
                    
                </div>
            </div>
    </section>

    <section class="main-container">
        <div>
            <h3>@lang('front.encoxbax')</h3>
        </div>
        <marquee width="100%" direction="left" height="100px">
            <div class="main-content">
                @foreach($morecvs as $key=>$cv)

                <a href="{{route('jobsearchdetail', $cv->id)}}" class="contentclass">
                    <div class="imageclass">
                        
                        <img src="{{$cv->image}}" alt="">
                    </div>
                    <div class="infoclass">
                        <p class="name">{{$cv->name}} {{$cv->surname}}</p>
                        <p class="profession">{{$cv->position}}</p>
                    </div>
                    <div class="likeclass">

                    </div>
                    <div class="salary">{{ $cv->salary ? $cv->salary.'₼' : '~' }}</div>

                </a>
                @endforeach
            </div>

                
        </marquee>
    </section>

    <div class="container jobsearchcontainer">
        <div class="jobsearchers">
            <p>@lang('front.isaxtar')</p>
        </div>
                <?php
                    $selected_sort = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';
                ?>
        <div class="sortclass">
            <span>Sırala:</span>
            <select id="cars" name="sort_by" onchange="this.form.submit()">
                <option value="1"<?php if($selected_sort == 1) echo ' selected'; ?>>@lang('front.yeniler')</option>
                <option value="2"<?php if($selected_sort == 2) echo ' selected'; ?>>@lang('front.az')</option>
                <option value="3"<?php if($selected_sort == 3) echo ' selected'; ?>>@lang('front.za')</option>
            </select>
        </div>
        </form>
    </div>

    <section class="jobsearch-cards">
        <div class="container jobsearch-card-container">
           
            <div class="row jobsearch-card-row">            
                @foreach($allcvs as $key=>$allcv)

                <div class="col-lg-4 col-md-6 jobsearch-card-col">
                    <div class="job-search-card">

                            <img class="job-search-avatar" src="{{$allcv->image}}" alt="job-search-card1">
                        
                        <img src="{{ asset('back/assets/images/icons/heart.png') }}" alt="heart" class="heart-icon" data-cv-id="{{$allcv->id}}" style="{{ in_array($allcv->id, $likes) ? 'display: none;' : 'display: inline-block;' }}">
                        <img src="{{ asset('back/assets/images/icons/red-heart.png') }}" alt="red-heart" class="red-heart-icon" data-cv-id="{{$allcv->id}}" style="{{in_array($allcv->id, $likes) ? 'display: inline-block;' : 'display: none;' }}">

                        <div class="jobsearch-card-information">
                            <a href="{{ route('jobsearchdetail', $allcv->id) }}"><h4>{{$allcv->name}} {{$allcv->surname}}</h4></a>
                            <p>{{$allcv->position}}</p>
                            <h3>{{ $allcv->salary ? $allcv->salary.'₼' : '~' }}</h3>

                        </div>
                    </div>
                </div>
                 @endforeach

            </div>
        </div>
    </section>


    <!-- JOBSEARCH PAGINATION -->
    <nav aria-label="..." class="d-flex justify-content-center">
        @if ($allcvs->hasPages())
        <ul class="pagination pagination-ul">
            {{-- Previous Page Link --}}
            @if ($allcvs->onFirstPage())
            @else
                <li class="page-item"><a class="page-link" href="{{ $allcvs->previousPageUrl() }}" rel="prev">«</a></li>
            @endif
    
            @if($allcvs->lastPage() > 1)
                @if($allcvs->currentPage() > 1)
                    <li class="page-item"><a class="page-link" href="{{ $allcvs->url(1) }}">1</a></li>
                    <li class="page-item"><a class="page-link">...</a></li>
                @endif
                @foreach(range($allcvs->currentPage() - 1, $allcvs->currentPage() + 1) as $i)
                    @if ($i > 1 && $i < $allcvs->lastPage())
                        @if ($i == $allcvs->currentPage())
                            <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                        @else
                            <li class="page-item "><a class="page-link" href="{{ $allcvs->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if($allcvs->currentPage() < $allcvs->lastPage() - 1)
                    <li class="page-item"><a class="page-link">...</a></li>
                    <li class="page-item"><a class="page-link" href="{{ $allcvs->url($allcvs->lastPage()) }}">{{ $allcvs->lastPage() }}</a></li>
                @endif
            @else
                <li class="page-item active"><a class="page-link">1</a></li>
            @endif
    
            {{-- Next Page Link --}}
            @if ($allcvs->hasMorePages())
                <li><a class="page-link" href="{{ $allcvs->nextPageUrl() }}" rel="next">»</a></li>
            @endif
        </ul>
        @endif
    </nav>
    
    <h3 class="jobsearch-all-result-text">@lang('front.umumisay') : {{$allcvs->total()}}</h3>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('js')
<script>
        const moreSearch = document.getElementById('detail-btn')
        const moreSearchSect = document.getElementById('getshow')
        moreSearch.addEventListener('click', () => {
            moreSearchSect.classList.toggle('filter-active');
        })
    </script>
@endsection