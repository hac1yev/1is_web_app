@extends('front.layouts.master')
 
<head>
    <style>
        .comp-card {
            width: 100%;
            background: linear-gradient(180deg, #966ace 0%, #7235c0 100%);
            border-radius: 10px;
            display: flex;
            margin: 10px;
        }

        .inner2 {
            width: 100px;
            height: 100px;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    
        .inner2-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background-color: #fff;
            border-radius: 5px;
        }
        
        .inner3 {
            position: absolute;
            bottom: 20px;
        }
    </style>
</head>

@section('content')
@foreach ($banner as $ban)

<section class="vacancy-section" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach
    <div class="vacancy-header">
      <div class="maintitle">
        <h2>@lang('front.companies')</h2>
      </div>
      <form class="main-filter" method="GET" action="{{route('compsearch')}}">
        <div class="active-filters">
          <div class="filter1">
            <img src="https://1is-new.netlify.app/images/search.png" alt="" />
            <input class="filter-input" placeholder="@lang('front.compaxtar')" type="search" name="query"/>
          </div>
          <div class="filter2 d-flex justify-content-end">
            <button class="filter-searc">@lang('front.axtar')</button>
          </div>
        </div>
        
    </div>
  </section>

    <!-- allcompanies -->
    <section class="all-vacantions">

        <div class="section-filter">
            <h2>@lang('front.companies')</h2>
            <div class="dropdown-comp-2">
                <h2>@lang('front.sirala'):</h2>
                <?php
                    $selected_sort = isset($_GET['type']) ? $_GET['type'] : '';
                    $selected_sector = isset($_GET['sector']) ? $_GET['sector'] : '0';

                ?>
                <div class="select_box">
                   <select class="vac-select" name="type" onchange="this.form.submit()">
                    <option value="1"<?php if($selected_sort == 1) echo ' selected'; ?>>@lang('front.az')</option>
                    <option value="2"<?php if($selected_sort == 2) echo ' selected'; ?>>@lang('front.za')</option>
                    <option value="3"<?php if($selected_sort == 3) echo ' selected'; ?>>@lang('front.baxsay')</option>
                    <option value="4"<?php if($selected_sort == 4) echo ' selected'; ?>>@lang('front.vacsay')</option>
                   </select>
                </div>
              </div>
              <div class="dropdown-comp-2">
                <h2>@lang('front.sektor'):</h2>
                <div class="select_box">
                   <select class="vac-select" name="sector" onchange="this.form.submit()">
                    <option value="0">@lang('front.sektor')</option>
                    @php
                    $lang = config('app.locale');
                    @endphp
                        @foreach($sectors as $sector)
                        <option value="{{$sector->id}}"{{$selected_sector == $sector->id ? ' selected' : ''}}>
                            @if ($lang == 'EN')
                                {{$sector->title_en}}
                            @elseif ($lang == 'RU')
                                {{$sector->title_ru}}
                            @elseif ($lang == 'TR')
                                {{$sector->title_tr}}
                            @else
                                {{$sector->title_az}}
                            @endif
                        </option>
                    @endforeach
                
                    
                   </select>
                </div>
              </div>
        </div>
    </form>

        <div class="company-div all-comp-container">
            <div class="row mr-0">
            @foreach($allcompanies as $key=>$allcomp)
            <a href="{{ route('compdetail', ['id' => $allcomp->id]) }}" class="col-lg-4 col-md-6">
                <div class="comp-card">
                <div class="inner2">
                    <img src="{{$allcomp->image}}" class="inner2-img" alt="">
                </div>
                <div class="company-content">
                    <div class="inner1">
                        <p>{{$allcomp->name}}</p>
                    </div>
                    <div class="inner3">
                        <div class="stars">
                                @php
                                    $stars = $allcomp->average;
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
                            <p>{{$allcomp->view}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>   
          @endforeach
        </div>
      </div>

            <!-- BLOG PAGİNATİON -->
    <nav aria-label="..." class="d-flex justify-content-center">
        @if ($allcompanies->hasPages())
        <ul class="pagination pagination-ul">
            {{-- Previous Page Link --}}
            @if ($allcompanies->onFirstPage())
            @else
                <li class="page-item"><a class="page-link" href="{{ $allcompanies->appends(request()->except('page'))->previousPageUrl() }}" rel="prev">«</a></li>
            @endif
    
            @if($allcompanies->currentPage() > 3)
                <li class="page-item" class="hidden-xs"><a class="page-link" href="{{ $allcompanies->appends(request()->except('page'))->url(1) }}">1</a></li>
            @endif
            @if($allcompanies->currentPage() > 4)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @foreach(range(1, $allcompanies->lastPage()) as $i)
                @if($i >= $allcompanies->currentPage() - 1 && $i <= $allcompanies->currentPage() + 1)
                    @if ($i == $allcompanies->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item "><a class="page-link" href="{{ $allcompanies->appends(request()->except('page'))->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($allcompanies->currentPage() < $allcompanies->lastPage() - 2)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @if($allcompanies->currentPage() < $allcompanies->lastPage() - 1)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $allcompanies->appends(request()->except('page'))->url($allcompanies->lastPage()) }}">{{ $allcompanies->lastPage() }}</a></li>
            @endif
    
            {{-- Next Page Link --}}
            @if ($allcompanies->hasMorePages())
                <li><a class="page-link" href="{{ $allcompanies->appends(request()->except('page'))->nextPageUrl() }}" rel="next">»</a></li>
            @endif
        </ul>
        </nav>
            <h3 class="blog-all-result-text">@lang('front.umumisay') : {{$allcompanies->total()}}</h3>

    @endif
    </section>
@endsection

@section("css-link")
<link rel="stylesheet" href="{{asset('front/css/companyall.css')}}">
<link rel="stylesheet" href="{{asset('front/css/vacancy-all.css')}}">
@endsection
