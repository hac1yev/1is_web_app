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
          <input type="text" placeholder="@lang('front.axtar')" type="search" name="query"/>
        </div>
        <button>@lang('front.axtar')</button>
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
      <h2 class="blog-head">@lang('front.encoxoxu')</h2>
      <div class="row">
        <div class="col-12">
          <div class="slick">
        
            @foreach($moreview as $key=>$more)
            <div class="item">
              <div class="bg" style="background-image:url({{$more->image}})">
                <div class="blog-bg-top">
                  <span>
                    <img src="https://1is-new.netlify.app/images/blog/calendar.png" alt="calendar">
                    {{date('d-m-Y', strtotime($more->created_at))}}
                  </span>
                  <span>
                    <img src="https://1is-new.netlify.app/images/blog/watch.png" alt="watch">
                    {{$more->view}}
                  </span>
                </div>
                <div class="blog-bg-bottom">
                    @php
                        $lang = config('app.locale');
                    @endphp

                    <span>
                        @if ($lang == 'EN')
                            {{ $more->title_en }}
                        @elseif ($lang == 'RU')
                            {{ $more->title_ru }}
                        @elseif ($lang == 'TR')
                            {{ $more->title_tr }}
                        @else
                            {{ $more->title_az }}
                        @endif
                    </span>
                    @php
                        $lang = config('app.locale');
                @endphp
                
                @if ($lang == 'EN')
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($more->title_en), $more->id]) }}">@lang('front.readmore')</a>
                @elseif ($lang == 'RU')
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($more->title_ru), $more->id]) }}">@lang('front.readmore')</a>
                @elseif ($lang == 'TR')
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($more->title_tr), $more->id]) }}">@lang('front.readmore')</a>
                @else
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($more->title_az), $more->id]) }}">@lang('front.readmore')</a>
                @endif
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <!-- BLOG CARDS -->
    <div class="container blog-card-container">
      <h3 class="w-100 text-center mt-5 mb-4">@lang('front.blog')</h3>
      <div class="row">
        @foreach($bigblogs as $key=>$bigblog)
        <div class="col-md-6">
          <div class="blog-card-1">
            <div class="card-1-top">
              <span>
                <img src="https://1is-new.netlify.app/images/blog/calendar.png" alt="calendar">
                {{date('d-m-Y', strtotime($bigblog->created_at))}}
              </span>
              <span>
                <img src="https://1is-new.netlify.app/images/blog/watch.png" alt="watch">
                {{$bigblog->view}}
              </span>
            </div>
            <div class="card-1-bottom">
              <span>
                @if ($lang == 'EN')
                {{ $bigblog->title_en }}
                @elseif ($lang == 'RU')
                    {{ $bigblog->title_ru }}
                @elseif ($lang == 'TR')
                    {{ $bigblog->title_tr }}
                @else
                    {{ $bigblog->title_az }}
                @endif
                </span>
                @php
                $lang = config('app.locale');
        @endphp
        
        @if ($lang == 'EN')
            <a class="card-button-link" href="{{ route('blogdetail', [urlencode($bigblog->title_en), $bigblog->id]) }}">@lang('front.readmore')</a>
        @elseif ($lang == 'RU')
            <a class="card-button-link" href="{{ route('blogdetail', [urlencode($bigblog->title_ru), $bigblog->id]) }}">@lang('front.readmore')</a>
        @elseif ($lang == 'TR')
            <a class="card-button-link" href="{{ route('blogdetail', [urlencode($bigblog->title_tr), $bigblog->id]) }}">@lang('front.readmore')</a>
        @else
            <a class="card-button-link" href="{{ route('blogdetail', [urlencode($bigblog->title_az), $bigblog->id]) }}">@lang('front.readmore')</a>
        @endif            </div>
            <img class="blog-card-1-image" src="{{$bigblog->image}}" alt="blog-card-1">
          </div>
        </div>
        @endforeach

        @foreach($middleblogs as $key=>$middleblog)
        <div class="col-md-3">
          <div class="blog-card-2">
            <div class="card-2-top">
              <span>
                <img src="https://1is-new.netlify.app/images/blog/calendar.png" alt="calendar">
                {{date('d-m-Y', strtotime($middleblog->created_at))}}
              </span>
              <span>
                <img src="https://1is-new.netlify.app/images/blog/watch.png" alt="watch">
                {{$middleblog->view}}
              </span>
            </div>
            <div class="card-2-bottom">
              <span>
                @if ($lang == 'EN')
                {{ $middleblog->title_en }}
            @elseif ($lang == 'RU')
                {{ $middleblog->title_ru }}
            @elseif ($lang == 'TR')
                {{ $middleblog->title_tr }}
            @else
                {{ $middleblog->title_az }}
            @endif
        </span>
        @php
        $lang = config('app.locale');
@endphp

@if ($lang == 'EN')
    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($middleblog->title_en), $middleblog->id]) }}">@lang('front.readmore')</a>
@elseif ($lang == 'RU')
    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($middleblog->title_ru), $middleblog->id]) }}">@lang('front.readmore')</a>
@elseif ($lang == 'TR')
    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($middleblog->title_tr), $middleblog->id]) }}">@lang('front.readmore')</a>
@else
    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($middleblog->title_az), $middleblog->id]) }}">@lang('front.readmore')</a>
@endif            </div>
            <img class="blog-card-2-image" src="{{$middleblog->image}}" alt="blog-card-2">
          </div>
        </div>
        @endforeach

        
        <div class="col-md-3">
          <div class="row h-100">
            @foreach($smallblogs as $key=>$smallblog)
            <div class="col-12">
              <div class="blog-card-3">
                <div class="card-3-top">
                  <span>
                    <img src="https://1is-new.netlify.app/images/blog/calendar.png" alt="calendar">
                    {{date('d-m-Y', strtotime($smallblog->created_at))}}
                  </span>
                  <span>
                    <img src="https://1is-new.netlify.app/images/blog/watch.png" alt="watch">
                    {{$smallblog->view}}
                  </span>
                </div>
                <div class="card-3-bottom">
                  <span>
                    @if ($lang == 'EN')
                    {{ $smallblog->title_en }}
                @elseif ($lang == 'RU')
                    {{ $smallblog->title_ru }}
                @elseif ($lang == 'TR')
                    {{ $smallblog->title_tr }}
                @else
                    {{ $smallblog->title_az }}
                @endif
            </span>
            @php
            $lang = config('app.locale');
    @endphp
    
    @if ($lang == 'EN')
        <a class="card-button-link" href="{{ route('blogdetail', [urlencode($smallblog->title_en), $smallblog->id]) }}">@lang('front.readmore')</a>
    @elseif ($lang == 'RU')
        <a class="card-button-link" href="{{ route('blogdetail', [urlencode($smallblog->title_ru), $smallblog->id]) }}">@lang('front.readmore')</a>
    @elseif ($lang == 'TR')
        <a class="card-button-link" href="{{ route('blogdetail', [urlencode($smallblog->title_tr), $smallblog->id]) }}">@lang('front.readmore')</a>
    @else
        <a class="card-button-link" href="{{ route('blogdetail', [urlencode($smallblog->title_az), $smallblog->id]) }}">@lang('front.readmore')</a>
    @endif                </div>
                <img class="blog-card-3-image" src="{{$smallblog->image}}" alt="blog-card-3">
              </div>
            </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>

    <!-- BLOG PAGİNATİON -->
    <nav aria-label="..." class="d-flex justify-content-center">
        @if ($paginatedBlogs->hasPages())
        <ul class="pagination pagination-ul">
            {{-- Previous Page Link --}}
            @if ($paginatedBlogs->onFirstPage())
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginatedBlogs->previousPageUrl() }}" rel="prev">«</a></li>
            @endif
    
            @if($paginatedBlogs->currentPage() > 3)
                <li class="page-item" class="hidden-xs"><a class="page-link" href="{{ $paginatedBlogs->url(1) }}">1</a></li>
            @endif
            @if($paginatedBlogs->currentPage() > 4)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @foreach(range(1, $paginatedBlogs->lastPage()) as $i)
                @if($i >= $paginatedBlogs->currentPage() - 1 && $i <= $paginatedBlogs->currentPage() + 1)
                    @if ($i == $paginatedBlogs->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $i }}</a></li>
                    @else
                        <li class="page-item "><a class="page-link" href="{{ $paginatedBlogs->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endforeach
            @if($paginatedBlogs->currentPage() < $paginatedBlogs->lastPage() - 2)
            <li class="page-item"><a class="page-link">...</a></li>
            @endif
            @if($paginatedBlogs->currentPage() < $paginatedBlogs->lastPage() - 1)
                <li class="page-item hidden-xs"><a class="page-link" href="{{ $paginatedBlogs->url($paginatedBlogs->lastPage()) }}">{{ $paginatedBlogs->lastPage() }}</a></li>
            @endif
    
            {{-- Next Page Link --}}
            @if ($paginatedBlogs->hasMorePages())
                <li><a class="page-link" href="{{ $paginatedBlogs->nextPageUrl() }}" rel="next">»</a></li>
            
            @endif
        </ul>
        </nav>
        <h3 class="blog-all-result-text">@lang('front.umumisay') : {{$paginatedBlogs->total()}}</h3>
    
    @endif

@endsection



@section('css-link')
    <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/blog.css')}}" />
@endsection

@section('js-link')
<script src="{{asset('front/js/slick.min.js')}}"></script>
    <script src="{{asset('front/js/blog.js')}}"></script>
@endsection