@extends('front.layouts.master')


@section('content')
@foreach ($banner as $ban)

<section class="header-info"  style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

        <div class="header-links-div">
            <a class="header-links" href="{{route('profile')}}">
                @lang('front.umumi')
             </a>
             <a class="header-links" href="{{route('traningcreate')}}">
                 @lang('front.training')
             </a>
             <a class="header-links" href="{{route('cvindex')}}">
                 @lang('front.jobsearch')
             </a>
             <a class="header-links" href="{{route('announcesindex')}}">
                 @lang('front.isegotur')
             </a>
        </div>
    </section>

    <section class="company-announce">
        <div class="container company-announce-container">
            <div class="row m-0">   
                <div class="nav flex-column nav-pills company-announce-tabs col-lg-6 col-md-8" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link trending-nav-link1" href="{{route('announcesindex')}}">
                        <img id="training_icon1" src="https://1is.butagrup.az/back/assets/images/icons/companies-purple.png
                        " alt="company-white" /> @lang('front.sirketlerim')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link2" href="{{route('createAnnounces')}}">
                        <img id="training_icon2" src="https://1is.butagrup.az/back/assets/images/icons/create-announces-purple.png" alt="create-announce-purple" /> @lang('front.elanyarat')
                    </a>
                    <a class="nav-link active nav-link-2 trending-nav-link3" href="{{route('myAnnounces')}}">
                        <img id="training_icon3" src="https://1is.butagrup.az/back/assets/images/icons/announces-white.png" alt="announces-purple" /> @lang('front.elanlarim')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link4" href="{{route('candidate')}}">
                        <img id="training_icon4" src="https://1is.butagrup.az/back/assets/images/icons/namizedler-purple.png" alt="namizedler-purple" />  @lang('front.namizedler')
                    </a>
                </div>
                
                <div class="col-lg-6">
                    <div class="tab-pane row announces-row" id="elanlarim">
                        <div class="col-lg-12 col-md-6 announces-col mb-3">
                            @foreach($vacancies as $key=>$vac)
                            <div class="vac-card">
                                <div class="vac-inner1">
                                    <a class="vac-inner1-a" href="#">{{$vac->sectors_title}}</a>
                                    <div class="second-part">
                                        <a href="{{route('elanEdit', $vac->id)}}"><img src="{{asset('back/assets/images/icons/edit_announce.png')}}" class="edit-announce-icon" alt="edit-announce" /></a>
                                        <a href="{{route('delete', $vac->id)}}"><img src="{{asset('back/assets/images/icons/announce-close.png')}}" alt="close-announce" /></a>

                                        @if($vac->status == 1)
                                            <img src="{{asset('back/assets/images/icons/green-circ.png')}}"/>
                                        @else
                                            <img src="{{asset('back/assets/images/icons/announce-yellow.png')}}" alt="announce-yellow" />
                                        @endif
                                    </div>
                                </div>
                                <div class="vac-inner2">
                                    <a href="{{route('vacancydetail', $vac->id)}}" class="vac-name">{{$vac->position}}</a>
                                </div>
                                <div class="vac-inner3">
                                    <div class="vac-inn1">
                                        <img src="https://1is-new.netlify.app/images/building.png" alt="">
                                        <a class="comp-link" href="#">{{$vac->name}}</a>
                                    </div>
                                    <div class="vac-inn2">
                                        <img src="{{asset('back/assets/images/icons/clock.png')}}" alt="clock">
                                        <p class="vac-time">{{date('d-m-Y', strtotime($vac->created_at))}}</p>
                                    </div>
                                </div>
                            </div>                            
                            @endforeach

                            <div>
                        </div>
                        </div>



                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-link')
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/companies-announces.js')}}"></script>
@endsection



@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/swiper-bundle.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('front/css/companies-announces.css')}}">
<link rel="stylesheet" href="{{asset('front/css/jobsearch.css')}}">
<link rel="stylesheet" href="{{asset('front/css/header.css')}}">
@endsection