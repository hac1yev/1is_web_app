@extends('front.layouts.master')

@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

        <div>
          @php
          $lang = config('app.locale');
      @endphp
      
      @if ($lang == 'EN')
          @if (!empty($bdetail->title_en))
              <h3>{{$bdetail->title_en}}</h3>
          @endif
      @elseif ($lang == 'RU')
          @if (!empty($bdetail->title_ru))
              <h3>{{$bdetail->title_ru}}</h3>
          @endif
      @elseif ($lang == 'TR')
          @if (!empty($bdetail->title_tr))
              <h3>{{$bdetail->title_tr}}</h3>
          @endif
      @else
          @if (!empty($bdetail->title_az))
              <h3>{{$bdetail->title_az}}</h3>
          @endif
      @endif
      
                </div>
    </section>
    <section class="blog-content">
        <div class="custom-container"> 
            <div class="blog-text">
                @php
                $lang = config('app.locale');
            @endphp
            
            @if ($lang == 'EN')
        @if (!empty($bdetail->content_en))
            {!! html_entity_decode($bdetail->content_en) !!}
        @endif
    @elseif ($lang == 'RU')
        @if (!empty($bdetail->content_ru))
            {!! html_entity_decode($bdetail->content_ru) !!}
        @endif
    @elseif ($lang == 'TR')
        @if (!empty($bdetail->content_tr))
            {!! html_entity_decode($bdetail->content_tr) !!}
        @endif
    @else
        @if (!empty($bdetail->content_az))
            {!! html_entity_decode($bdetail->content_az) !!}
        @endif
    @endif
                        </div>


            <div class="blog-date">
                <img src="https://1is-new.netlify.app/images/blog-date.png" alt="">
                @if ($bdetail)
                <p>{{ date('d-m-Y', strtotime($bdetail->created_at)) }}</p>
            @endif
                        </div>
        </div>
    </section>

    <section class="similar-blogs">
        <div class="custom-container">
            <h1>@lang('front.oxsarmeq')</h1>
            <div class="similar-blogs-cards">
                @foreach($allblogs as $key=>$blogs)
                <div class="similar-blogs-card" style="background: url(https://1is.butagrup.az/{{$blogs->image}});">
                    <div class="blog-dates">
                        <img src="https://1is-new.netlify.app/images/similar-blog-date.png" alt="">
                        <span>{{date('d-m-Y', strtotime($blogs->created_at))}}</span>
                    </div>
                    <div class="blog-look">
                        <img src="https://1is-new.netlify.app/images/similar-blog-look.png" alt="">
                        <span>{{$blogs->view}}</span>
                    </div>
                    <div class="content-btn">
                        @php
                        $lang = config('app.locale');
                    @endphp
                        <p>@if ($lang == 'EN')
                            {{ $blogs->title_en }}
                        @elseif ($lang == 'RU')
                            {{ $blogs->title_ru }}
                        @elseif ($lang == 'TR')
                            {{ $blogs->title_tr }}
                        @else
                            {{ $blogs->title_az }}
                        @endif
                    </p>
                        @php
                        $lang = config('app.locale');
                @endphp
                
                @if ($lang == 'EN')
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($blogs->title_en), $blogs->id]) }}"><button>@lang('front.readmore')</button>
                    </a>
                @elseif ($lang == 'RU')
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($blogs->title_ru), $blogs->id]) }}"> <button>@lang('front.readmore')</button>
                    </a>
                @elseif ($lang == 'TR')
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($blogs->title_tr), $blogs->id]) }}"><button>@lang('front.readmore')</button>
                    </a>
                @else
                    <a class="card-button-link" href="{{ route('blogdetail', [urlencode($blogs->title_az), $blogs->id]) }}"> <button>@lang('front.readmore')</button>
                    </a>
                @endif                       
                                                  

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/blog-inner.css')}}">
@endsection

<style>
    .card-button-link {
        color: white;
    }

    .blog-text img {
        object-fit: contain;
        width: 940px!important;
        width: 100%!important;
        height: 400px;
    }

</style>
