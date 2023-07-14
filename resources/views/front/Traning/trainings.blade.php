@extends('front.layouts.master')
 

@section('content')
    @foreach ($banner as $ban)

<section class="vacancy-section" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach
<section class="header-info">
    <div>
      <h3>@lang('front.training')</h3>
      <form class="container blog-header-container" method="GET" action="{{route('telimaxtar')}}">
        <div>
          <img src="{{asset('back/assets/images/icons/search.png')}}" alt="search">
          <input type="text" placeholder="@lang('front.axtar')" type="search" name="query"/>
        </div>
        <button>@lang('front.axtar')</button>
  </section>



    </div>
  </section>
</section>
  <!-- BLOG SLIDER -->
  <div class="training-container container pt-4">
    <div class="section-filter">
            <h2>@lang('front.companies')</h2>
            <div class="dropdown-comp-3">
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
        </div>
    </form>
    <div class="training-cards row">
      @foreach($alltrainings as $key=>$alltr)

      <div class="col-md-6 col-lg-3 mt-3">
        <div class="training-card">
          <div class="top-part">
            <img src="{{$alltr->image}}" alt="" />
          </div>
          <div class="middle-part">
            <a class="first-mid-a" href="{{route('trainingsdetail', $alltr->id)}}">{{Str::limit($alltr->title, 50, '...')}}
            </a>
            <a class="second-mid-a" href="{{route('trainingsdetail', $alltr->id)}}">{{$alltr->name}}</a>
            @if($alltr->price == NULL)
              <span>@lang('front.pulsuz')</span>
            @else
            <span>{{$alltr->price}} AZN</span>

            @endif
            <a href="{{route('trainingsdetail', $alltr->id)}}" class="show-more">@lang('front.incele')</a>
          </div>
          <div class="bottom-part">
            <span class="hr-line"></span>
            <div class="look-count">
              <img src="https://1is-new.netlify.app/images/eye.png" alt="" />
              <span>{{$alltr->view}}</span>
            </div>
            <div class="date-training">
              <img src="https://1is-new.netlify.app/images/blog-date.png" alt="" />
              <span>{{($alltr->created_at) ->format('d.m.Y')}}</span>
            </div>
           
            @if ($alltr->created_at->diffInDays(Carbon\Carbon::now()) <= 10)
            <div class="new-trainig">
              <p>@lang('front.yeni')</p>           

            </div>              
            @endif           

          </div>
        </div>
      </div>
      @endforeach


    </div>

    <!-- BLOG PAGİNATİON -->
    <nav aria-label="..." class="d-flex justify-content-center pagination-nav">
      @if ($alltrainings->hasPages())
      <ul class="pagination pagination-ul">
          {{-- Previous Page Link --}}
          @if ($alltrainings->onFirstPage())
          @else
              <li class="page-item"><a class="page-link" href="{{ $alltrainings->previousPageUrl() }}" rel="prev">«</a></li>
          @endif
    
          @if($alltrainings->currentPage() > 3)
              <li class="page-item" class="hidden-xs"><a class="page-link" href="{{ $alltrainings->url(1) }}">1</a></li>
          @endif
          @if($alltrainings->currentPage() > 4)
          <li class="page-item"><a class="page-link">...</a></li>
          @endif
          @foreach(range(1, $alltrainings->lastPage()) as $i)
              @if($i >= $alltrainings->currentPage() - 1 && $i <= $alltrainings->currentPage() + 1)
                  @if ($i == $alltrainings->currentPage())
                      <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                  @else
                      <li class="page-item "><a class="page-link" href="{{ $alltrainings->url($i) }}">{{ $i }}</a></li>
                  @endif
              @endif
          @endforeach
          @if($alltrainings->currentPage() < $alltrainings->lastPage() - 2)
          <li class="page-item"><a class="page-link">...</a></li>
          @endif
          @if($alltrainings->currentPage() < $alltrainings->lastPage() - 1)
              <li class="page-item hidden-xs"><a class="page-link" href="{{ $alltrainings->url($alltrainings->lastPage()) }}">{{ $alltrainings->lastPage() }}</a></li>
          @endif
    
          {{-- Next Page Link --}}
          @if ($alltrainings->hasMorePages())
              <li><a class="page-link" href="{{ $alltrainings->nextPageUrl() }}" rel="next">»</a></li>
          @endif
      </ul>
    </nav>

  </div>

  

@endif


@endsection
  

    @section('js-link')
        <script src="{{asset('front/js/slick.min.js')}}"></script>
        <script src="{{asset('front/js/blog.js')}}"></script>
    @endsection

    
@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('front/css/trainings.css')}}" />
<link rel="stylesheet" href="{{asset('front/css/blog.css')}}" />

@endsection

    @section('js')
    
@endsection


