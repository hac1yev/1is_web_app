@extends('front.layouts.master')


@section('content')
@foreach ($banner as $ban)

<section class="vacancy-section" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

      <div class="vacancy-header">
        <div class="maintitle">
          <h2>@lang('front.vacancies')</h2>
        </div>
        
        <form id="myForm" class="main-filter" method="GET" action="{{route('vsearch')}}">
            <div class="active-filter active-filter-jobsearchinner">
                <div class="filter1">
                    <img src="https://1is-new.netlify.app/images/search.png" alt="">
                    <input class="filter-input" placeholder="@lang('front.açar')" type="search" name="query" value="{{ old('vacname',$vacname) }}">
                  </div>
                <div class="filter2">
                    <button class="filter-searc" type="submit">@lang('front.axtar')</button>
                    <div id="detail-btn" class="detail-search"><img src="https://1is-new.netlify.app/images/more.png" alt="">@lang('front.etrafliaxtar')</div>
                    <button type="submit" id="resetButton">Reset</button>

                       
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
                                      <option value="{{$comp->id}}"  {{ $comp->id == $request->input('company') ? 'selected' : '' }}>{{$comp->name}}</option>
                                  @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
  
        </div>
      </section>
  
      <!-- vacancies -->
      <section class="all-vacantions">
              <?php
                  $selected_sort = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';
                  $is_expired = isset($_GET['expired']) && $_GET['expired'] == 'on' ? 'checked' : '';
              ?>
              <div class="section-filter">
                  <h2>@lang('front.vacancies')</h2>
                  <div class="checkbox-div">
                      <label id="check-label" for="check">
                          @lang('front.vaxtbit')
                          <input type="checkbox" class="switch_1" name="expired" onchange="this.form.submit()" <?php echo $is_expired; ?> />
                      </label>
                  </div>
                  <div class="dropdown-comp-2">
                    <h2>@lang('front.sirala'):</h2>
                      <div class="select_box">
                          <select class="vac-select" name="sort_by" onchange="this.form.submit()">
                              <option value="1" <?php if($selected_sort == 1) echo 'selected'; ?>>@lang('front.paysira')</option>
                              <option value="2" <?php if($selected_sort == 2) echo 'selected'; ?>>@lang('front.az')</option>
                              <option value="3" <?php if($selected_sort == 3) echo 'selected'; ?>>@lang('front.za')</option>
                              <option value="4" <?php if($selected_sort == 4) echo 'selected'; ?>>@lang('front.baxsay')</option>
                          </select>
                      </div>
                  </div>
              </div>
          </form>
        <div>
          @php
          $city = App\Models\Cities::find($request->input('city'));
          $category = App\Models\Categories::find($request->input('category'));
          $findWorker = App\Models\JobType::find($request->input('find_worker'));
          $education = App\Models\Educations::find($request->input('education'));
          $experience = App\Models\Experiences::find($request->input('experience'));
          $company = App\Models\Companies::find($request->input('company'));

          $citytitle = '';
          $categoryTitle = '';
          $findWorkerTitle = '';
          $educationTitle = '';
          $experienceTitle = '';
          $companyName = '';

          if (!empty($city)) {
              if ($lang == 'EN') {
                  $citytitle = $city->title_en;
              } elseif ($lang == 'RU') {
                  $citytitle = $city->title_ru;
              } elseif ($lang == 'TR') {
                  $citytitle = $city->title_tr;
              } else {
                  $citytitle = $city->title_az;
              }
          }

          if (!empty($category)) {
              if ($lang == 'EN') {
                  $categoryTitle = $category->title_en;
              } elseif ($lang == 'RU') {
                  $categoryTitle = $category->title_ru;
              } elseif ($lang == 'TR') {
                  $categoryTitle = $category->title_tr;
              } else {
                  $categoryTitle = $category->title_az;
              }
          }
          if (!empty($findWorker)) {
              if ($lang == 'EN') {
                  $findWorkerTitle = $findWorker->title_en;
              } elseif ($lang == 'RU') {
                  $findWorkerTitle = $findWorker->title_ru;
              } elseif ($lang == 'TR') {
                  $findWorkerTitle = $findWorker->title_tr;
              } else {
                  $findWorkerTitle = $findWorker->title_az;
              }
          }
          if (!empty($education)) {
              if ($lang == 'EN') {
                  $educationTitle = $education->title_en;
              } elseif ($lang == 'RU') {
                  $educationTitle = $education->title_ru;
              } elseif ($lang == 'TR') {
                  $educationTitle = $education->title_tr;
              } else {
                  $educationTitle = $education->title_az;
              }
          }
          if (!empty($experience)) {
              if ($lang == 'EN') {
                  $experienceTitle = $experience->title_en;
              } elseif ($lang == 'RU') {
                  $experienceTitle = $experience->title_ru;
              } elseif ($lang == 'TR') {
                  $experienceTitle = $experience->title_tr;
              } else {
                  $experienceTitle = $experience->title_az;
              }
          }

          if (!empty($company)) {
              $companyName = $company->name;
          }
      @endphp
      
      @if (!empty($citytitle))
          <li>@lang('front.city'): {{ $citytitle }}</li>
      @endif
      
      
      @if (!empty($categoryTitle))
          <li>@lang('front.cat'): {{ $categoryTitle }}</li>
       @endif

      @if (!empty($findWorkerTitle))
          <li>@lang('front.jobtype'): {{ $findWorkerTitle }}</li>
      @endif

      @if (!empty($educationTitle))
          <li>@lang('front.educ'): {{ $educationTitle }}</li>
       @endif

      @if (!empty($experienceTitle))
          <li>@lang('front.exp'): {{ $experienceTitle }}</li>
      @endif
      
      @if (!empty($companyName))
          <li>@lang('front.companies'): {{ $companyName }}</li>
      @endif
    </div>
      <div class="all-vacancies">
            
        @if($vacancies->isEmpty())
          <p style="margin-left: 15px; font-size: 24px;"><span style="color: #F96D00;">{{ $vacname }}</span> açar sözünə uyğun nəticə tapılmadı </p>
          @else
                @foreach($vacancies as $key=>$vacancy)

        <div class="vac-card">    

          <div class="vac-inner1">
            <a href="{{route('vacancydetail', $vacancy->vacancy_id)}}" class="vac-inner1-a">{{$vacancy->sectors_title}}</a>
            <div class="second-part">
                <span style="margin-right: 15px;" class="look-numb"> {{$vacancy->view}} <img src="https://1is-new.netlify.app/images/eye.png"></span>

                <img src="{{ asset('back/assets/images/icons/heart.png') }}" alt="heart" class="heart-icon" data-vacancy-id="{{ $vacancy->vacancy_id }}" style="{{ in_array($vacancy->vacancy_id, $likes) ? 'display: none;' : 'display: inline-block;' }}">
                <img src="{{ asset('back/assets/images/icons/red-heart.png') }}" alt="red-heart" class="red-heart-icon" data-vacancy-id="{{ $vacancy->vacancy_id }}" style="{{ in_array($vacancy->vacancy_id, $likes) ? 'display: inline-block;' : 'display: none;' }}">
            </div>
          </div>
          <div class="vac-inner2">
            <a href="{{route('vacancydetail', $vacancy->vacancy_id)}}" class="vac-name"
              >{{$vacancy->position}}</a>
          </div>
          <div class="vac-inner3">
            <div class="vac-inn1">
              <img src="https://1is-new.netlify.app/images/building.png" alt="" />
              <a class="comp-link" href="{{route('compdetail', $vacancy->company_id)}}">{{$vacancy->name}}</a>
            </div>
            <div class="vac-inn2">
              <img src="https://1is-new.netlify.app/images/clock.png" alt="" />
              <p class="vac-time">{{ date('d-m-Y', strtotime($vacancy->deadline)) }}</p>
            </div>
          </div>
          @if ($vacancy->created_at->diffInDays(Carbon\Carbon::now()) <= 3)

          <div class="new-vac-badge">
                <p>@lang('front.yeni')</p>
        
        </div>           
         @endif
        </div>                 
         @endforeach
         @endif

    </div>
    

      <!-- BLOG PAGİNATİON -->        
      @if(isset($vacancies))

      <nav aria-label="..." class="d-flex justify-content-center">
    
        @if ($vacancies->hasPages())
        <ul class="pagination pagination-ul">
            {{-- Previous Page Link --}}
            @if ($vacancies->onFirstPage())
            @else
                <li class="page-item"><a class="page-link" href="{{ $vacancies->appends(request()->except('page'))->previousPageUrl() }}" rel="prev">«</a></li>
            @endif
    
            @if($vacancies->currentPage() > 3)
                <li class="page-item" class="hidden-xs"><a class="page-link" href="{{ $vacancies->appends(request()->except('page'))->url(1) }}">1</a></li>
            @endif
            @if($vacancies->currentPage() > 4)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @foreach(range(1, $vacancies->lastPage()) as $i)
                @if($i >= $vacancies->currentPage() - 1 && $i <= $vacancies->currentPage() + 1)
                    @if ($i == $vacancies->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item "><a class="page-link" href="{{ $vacancies->appends(request()->except('page'))->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($vacancies->currentPage() < $vacancies->lastPage() - 2)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @if($vacancies->currentPage() < $vacancies->lastPage() - 1)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $vacancies->appends(request()->except('page'))->url($vacancies->lastPage()) }}">{{ $vacancies->lastPage() }}</a></li>
            @endif
    
            {{-- Next Page Link --}}
            @if ($vacancies->hasMorePages())
                <li><a class="page-link" href="{{ $vacancies->appends(request()->except('page'))->nextPageUrl() }}" rel="next">»</a></li>
            @endif
        </ul>
    
        </nav>
    
      @endif
              <h3 class="blog-all-result-text">@lang('front.umumisay') : {{$vacancies->total()}}</h3>

    @endif
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var heartIcons = document.querySelectorAll('.heart-icon');
    
            heartIcons.forEach(function (icon) {
                icon.addEventListener('click', function () {
                    var vacancyId = this.getAttribute('data-vacancy-id');
                    var redHeartIcon = document.querySelector('.red-heart-icon[data-vacancy-id="' + vacancyId + '"]');
                    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
                    window.location.href = '{{ route('login') }}';
                    return;
                    
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
                                    icon.style.display = 'none'; // Hide the white heart icon for anonymous users

                                }
                            } else if (xhr.status === 403) {
                                var response = JSON.parse(xhr.responseText);
                                Swal.fire({
                                    icon: 'error',
                                    title: `${response.error}`,
                                    footer: `<a href="{{route('login')}}">@lang('front.daxilol')</a>`,

                                    })    
                                  }
                        }
                    };
    
                    xhr.send(params);
                });
            });
        });
    </script>
    
    <script>
        document.getElementById('resetButton').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('myForm').reset();
            window.location.href = '/allvacancy';
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
<link rel="stylesheet" href="{{asset('front/css/vacancy-all.css')}}">
<link rel="stylesheet" href="{{asset('front/css/search-more.css')}}">
@endsection


@section('js')
<script>
      const moreSearch = document.getElementById("detail-btn");
      console.log(moreSearch)
      const moreSearchSect = document.getElementById("getshow");
      moreSearch.addEventListener("click", () => {
        moreSearchSect.classList.toggle("filter-active");
        console.log('Salam')
      });
    </script>
@endsection