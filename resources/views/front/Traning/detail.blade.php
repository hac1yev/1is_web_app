@extends('front.layouts.master')


@section('content')
@foreach ($banner as $ban)

<section class="vacancy-section" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach
    <section class="header-info">
      <div>
        <h3>@lang('front.training')</h3>
      </div>
    </section>
</section>

    <div class="training-container container">
        <div class="row training-detail">
            <div class="col-lg-5 col-md-6">
                <div class="left-card">
                    <div class="left-part-1">
                        <p>@lang('front.telimhaq')</p>
                    </div>
                    <div class="left-part-2">
                        <div>
                            <img src="https://1is-new.netlify.app/images/dollar.png" alt="">
                            <div>
                                <p>@lang('front.odenis'):</p>
                                @if ($tdetail->payment_type == 0)
                                    <span>@lang('front.pulsuz')</span>
                                @elseif ($tdetail->payment_type == 1)
                                    <span>{{$tdetail->price}} AZN</span>
                                @endif

                            </div>
                        </div>
                        <div>
                            <img src="https://1is-new.netlify.app/images/black-eye.png" alt="">
                            <div>
                                <p>@lang('front.baxissay'):</p>
                                <span>{{$tdetail->view}}</span>
                            </div>
                        </div>
                        <div>
                            <img src="https://1is-new.netlify.app/images/black-date.png" alt="">
                            <div>
                                <p>@lang('front.tarix'):</p>
                                
                                <span>{{ date('d-m-Y', strtotime($tdetail->created_at))}}</span>
                            </div>
                        </div>
                        <div>
                            <img src="https://1is-new.netlify.app/images/black-date.png" alt="">
                            <div>
                                <p>@lang('front.start') :</p>
                                    @if($tdetail->deadline > now())
                                        <span class="last-span">{{$tdetail->deadline}}</span>
                                    @else
                                        <span class="last-span">@lang('front.murbitib')</span>
                                    @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="right-card">
                    <h3>@lang('front.teltel'):</h3>
                    <img src="https://1is.butagrup.az/{{$tdetail->image}}" alt="">
                    <li>{!! html_entity_decode($tdetail->about) !!}</li>
                    
                    <br>
                    <p><a href="{{$tdetail->redirect_link}}" target="_blank">@lang('front.kecidlink')</a><b> @lang('front.telimcumle').</b></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Training SLIDER -->
    <div style="margin-bottom: 30px;" class="training-container container pt-4">
    <h2>@lang('front.oxsartelim')</h2>
      <div class="training-cards row">            
        @foreach ($alltrainings as $key=>$alltr)

        <div class="col-md-6 col-lg-3 mt-3">   
          <div class="training-card">
            <div class="top-part">
                <img src="https://1is.butagrup.az/{{$alltr->image}}" alt="">
            </div>
            <div class="middle-part">
                <a class="first-mid-a" href="{{route('trainingsdetail', $alltr->id)}}">{{Str::limit($alltr->title, 50, '...')}}
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
              <div class="new-trainig">
                <p>@lang('front.yeni')</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
@endsection


@section('js-link')
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/blog.js')}}"></script>
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('front/css/trainings.css')}}" />
@endsection




