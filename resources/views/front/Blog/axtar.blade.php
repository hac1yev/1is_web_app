@extends('front.layouts.master')


@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)), url({{asset($ban->image)}})">
    @endforeach

      <div>
          <h3>@lang('front.blog')</h3>
      </div>
      <form class="container blog-header-container" method="GET" action="{{route('blogsearch')}}">
        <div>
          <img src="{{asset('back/assets/images/icons/search.png')}}" alt="search">
          <input type="text" placeholder="@lang('front.axtar')" type="search" name="query" value="{{ old('query', $blogs) }}"/>
        </div>
        <button>@lang('front.axtar')</button>
  </section>


  </section>

    <!-- BLOG SLIDER -->
    <div class="container-fluid pt-4">
        <div class="section-filter">
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
      <h2 class="blog-head">@lang('front.axtarnet')</h2>
    
    </div>

    <!-- BLOG CARDS -->
    <div class="container blog-card-container">
      <div class="row">
        @foreach($allblogs as $key=>$allblog)
        <div class="col-md-6">
          <div class="blog-card-1">
            <div class="card-1-top">
              <span>
                <img src="https://1is-new.netlify.app/images/blog/calendar.png" alt="calendar">
                {{date('d-m-Y', strtotime($allblog->created_at))}}
              </span>
              <span>
                <img src="https://1is-new.netlify.app/images/blog/watch.png" alt="watch">
                {{$allblog->view}}
              </span>
            </div>
            <div class="card-1-bottom">
              <span>{{$allblog->title_az}}</span>
              <a class="card-button-link" href="{{ route('blogdetail', [urlencode($allblog->title_az), $allblog->id]) }}">@lang('front.readmore')</a>
            </div>
            <img class="blog-card-1-image" src="{{$allblog->image}}" alt="blog-card-1">
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- BLOG PAGİNATİON -->
    <nav aria-label="..." class="d-flex justify-content-center">
        @if ($allblogs->hasPages())
        <ul class="pagination pagination-ul">
            {{-- Previous Page Link --}}
            @if ($allblogs->onFirstPage())
            @else
                <li class="page-item"><a class="page-link" href="{{ $allblogs->previousPageUrl() }}" rel="prev">«</a></li>
            @endif
    
            @if($allblogs->currentPage() > 3)
                <li class="page-item" class="hidden-xs"><a class="page-link" href="{{ $allblogs->url(1) }}">1</a></li>
            @endif
            @if($allblogs->currentPage() > 4)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @foreach(range(1, $allblogs->lastPage()) as $i)
                @if($i >= $allblogs->currentPage() - 1 && $i <= $allblogs->currentPage() + 1)
                    @if ($i == $allblogs->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item "><a class="page-link" href="{{ $allblogs->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($allblogs->currentPage() < $allblogs->lastPage() - 2)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @if($allblogs->currentPage() < $allblogs->lastPage() - 1)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $allblogs->url($allblogs->lastPage()) }}">{{ $allblogs->lastPage() }}</a></li>
            @endif
    
            {{-- Next Page Link --}}
            @if ($allblogs->hasMorePages())
                <li><a class="page-link" href="{{ $allblogs->nextPageUrl() }}" rel="next">»</a></li>
            
            @endif
        </ul>
        </nav>
        <h3 class="blog-all-result-text">@lang('front.umumisay') : {{$allblogs->total()}}</h3>
    
    @endif

@endsection



@section('css-link')
    <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/blog.css')}}" />
@endsection

@section('js-link')
<script src="{{asset('front/js/slick.min.js')}}"></script>
    <script src="{{asset('front/js/blog.js')}}"></script>
@endsection