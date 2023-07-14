@extends('front.layouts.master')
<style>
    .dataTables_wrapper{
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.25);
    }
</style>

@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
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
                    <a class="nav-link nav-link-2 trending-nav-link3" href="{{route('myAnnounces')}}">
                        <img id="training_icon3" src="https://1is.butagrup.az/back/assets/images/icons/announces-purple.png" alt="announces-purple" /> @lang('front.elanlarim')
                    </a>
                    <a class="nav-link active nav-link-2 trending-nav-link4" href="{{route('candidate')}}">
                        <img id="training_icon4" src="https://1is.butagrup.az/back/assets/images/icons/namizedler-white.png" alt="namizedler-purple" />  @lang('front.namizedler')
                    </a>
                </div>
                <div class="col-12">
                    <div class="tab-pane row namizedler-row my-4" id="namizedler">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>@lang('front.adsoyad')</th>
                                    <th>@lang('front.telnom')</th>
                                    <th>@lang('front.email')</th>
                                    <th>@lang('front.cvyukle')</th>
                                    <th>@lang('front.tarix')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($candidates as $key => $candidate)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $candidate->name }} {{ $candidate->surname }}</td>
                                        <td>{{ $candidate->phone }}</td>
                                        <td>{{ $candidate->mail }}</td>

                                        <td>
                                            <a href="{{ route('downloadcvv', $candidate->id) }}" style="color: blueviolet">
                                                <i class="fa fa-file" aria-hidden="true"></i>
                                              </a>
                                              
                                    </td>
                                    <td>{{ $candidate->created_at->format('Y-m-d') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/swiper-bundle.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('front/css/companies-announces.css')}}">
<link rel="stylesheet" href="{{asset('front/css/jobsearch.css')}}">
<link rel="stylesheet" href="{{asset('front/css/header.css')}}">
@endsection

@section('js-link')
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/companies-announces.js')}}"></script>
@endsection

@section('js')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>

<script>
    $(document).ready( function () {
        $('#example').DataTable();
    } );
    </script>
@endsection