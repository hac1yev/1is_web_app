@extends('front.layouts.master')

@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
             @endforeach

        <div>
            <h3>@lang('front.term')</h3>

        </div>
    </section>
    <section class="terms-content">
        <div class="container">
         
          @if( app()->getLocale() === 'EN')
          <div>{!! html_entity_decode($policies->content_en) !!}</div>
          @elseif( app()->getLocale() === 'RU')
          <div>{!! html_entity_decode($policies->content_ru) !!}</div>
          @elseif( app()->getLocale() === 'TR')
          <div>{!! html_entity_decode($policies->content_tr) !!}</div>
          @else
          <div>{!! html_entity_decode($policies->content_az) !!}</div>
          @endif

            
        </div>
    </section>
@endsection


@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/terms.css')}}">
@endsection