@extends('front.layouts.master')

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
                    <a class="nav-link active trending-nav-link1" href="{{route('announcesindex')}}">
                        <img id="training_icon1" src="https://1is.butagrup.az/back/assets/images/icons/companies-white.png" alt="company-white" /> @lang('front.sirketlerim')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link2" href="{{route('createAnnounces')}}">
                        <img id="training_icon2" src="https://1is-new.netlify.app/images/companies-announces/create-announces-purple.png" alt="create-announce-purple" />@lang('front.elanyarat')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link3" href="{{route('myAnnounces')}}">
                        <img id="training_icon3" src="https://1is.butagrup.az/back/assets/images/icons/announces-purple.png" alt="announces-purple" />@lang('front.elanlarim')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link4" href="{{route('candidate')}}">
                        <img id="training_icon4" src="https://1is.butagrup.az/back/assets/images/icons/namizedler-purple.png" alt="namizedler-purple" /> @lang('front.namizedler')
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="tab-pane row create-announce-row" id="elan-yarat">
                        <form action="{{route('companiesEditPost')}}" method="POST" enctype="multipart/form-data" class="tab-pane row company-announce-form fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                               
                                <input type="hidden" name="id" value="{{$company->id}}">
                                @csrf
                            <div class="form-group company-announce-input-group col-12 @error('name') has-error @enderror ">
                                <label for="possession">@lang('front.ad')</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{$company->name}}" placeholder="@lang('front.ad')" required />
                                @error('name')
                                <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                @enderror
                                
                            </div>
                            <div class="form-group company-announce-input-group col-12 @error('sector') has-error @enderror ">
                                <label for="city">@lang('front.sektor')</label>
                                <select class="form-control" name="sector" id="category" required >
                                    <option value="" selected disabled>@lang('front.birsec')...</option>
                                    @php
                                $lang = config('app.locale');
                            @endphp
                                    @foreach($sectors as $sector)
                                        <option value="{{$sector->id}}" @if($company->sector_id == $sector->id) selected @endif>
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
                               
                            
                                <div class="form-group company-announce-input-group col-12 @error('address') has-error @enderror ">
                                    <label for="possession">@lang('front.unvan')</label>
                                    <input type="text" name="address" class="form-control" id="name" value="{{$company->address}}" placeholder="@lang('front.daxilet')" required />
                                    @error('address')
                                    <span class="text-danger" style="font-size: 14x">@lang('validation.address_max')</span>
                                    @enderror
                                    
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('website') has-error @enderror ">
                                    <label for="possession">@lang('front.vebsayt')</label>
                                    <input type="text" name="website" class="form-control" id="possession" placeholder="@lang('front.daxilet')" value="{{$company->website}}" required/>
                                    @error('website')
                                            <span class="text-danger" style="font-size: 14x">@lang('validation.website_max')</span>
                                            @enderror
                                    
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('map') has-error @enderror ">
                                    <label for="possession">@lang('front.vezife')</label>
                                    <input type="text" name="map" class="form-control" id="possession" placeholder="@lang('front.daxilet')" value="{{$company->map}}" required />
                                   
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('about') has-error @enderror ">
                                    <label for="possession">@lang('front.about')</label>
                                    <input type="text" name="about" class="form-control" id="possession" placeholder="@lang('front.daxilet')" value="{{$company->about}}" required />
                                    @error('about')
                                            <span class="text-danger" style="font-size: 14x">@lang('validation.about_min')</span>
                                            @enderror
                                    
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('hr') has-error @enderror ">
                                    <label for="possession">@lang('front.hr')</label>
                                    <input type="text" name="hr" class="form-control" id="possession" placeholder="@lang('front.hr')" value="{{$company->hr}}" />
                                
                                    
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('instagram') has-error @enderror ">
                                    <label for="possession">@lang('front.instagram')</label>
                                    <input type="text" name="instagram" class="form-control" id="possession" placeholder="@lang('front.instagram')" value="{{$company->instagram}}" />
                                    @error('instagram')
                                            <span class="text-danger" style="font-size: 14x">@lang('validation.instagram_max')</span>
                                            @enderror
                                    
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('linkedin') has-error @enderror ">
                                    <label for="possession">@lang('front.linkedin')</label>
                                    <input type="text" name="linkedin" class="form-control" id="possession" placeholder="@lang('front.linkedin')" value="{{$company->linkedin}}" />
                                    @error('linkedin')
                                            <span class="text-danger" style="font-size: 14x">@lang('validation.linkedin_max')</span>
                                            @enderror
                                    
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('facebook') has-error @enderror ">
                                    <label for="possession">@lang('front.facebook')</label>
                                    <input type="text" name="facebook" class="form-control" id="possession" placeholder="@lang('front.facebook')" value="{{$company->facebook}}" />
                                    @error('facebook')
                                            <span class="text-danger" style="font-size: 14x">@lang('validation.facebook_max')</span>
                                            @enderror
                                    
                                </div>
                                <div class="form-group company-announce-input-group col-12 @error('twitter') has-error @enderror ">
                                    <label for="possession">@lang('front.tvitter')</label>
                                    <input type="text" name="twitter" class="form-control" id="possession" placeholder="@lang('front.tvitter')" value="{{$company->twitter}}" />
                                    @error('twitter')
                                            <span class="text-danger" style="font-size: 14x">@lang('validation.twitter_max')</span>
                                            @enderror
                                    
                                </div>
                                <img src="{{asset($company->image)}}" alt="" width="200" height="200">

                                <div class="form-group company-announce-input-group col-12 @error('image') has-error @enderror ">
                                    <label for="possession">@lang('front.sekiladd')</label>
                                    <input type="file" name="image" class="form-control" id="possession" placeholder="@lang('front.sekilsec')"/>
                                    @error('image')
                                                <span class="text-danger" style="font-size: 14x">@lang('validation.image_max')</span>
                                                @enderror
                                    
                                </div>
                            
                            
            
                            <div class="company-announce-form-button col-md-4">
                                <button type="submit">@lang('front.elaveet')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    
        function getContact(id){
            if(id == 0){
                $('#type_email').slideDown();
                $('#type_link').slideUp();
            }else if(id == 2){
                $('#type_link').slideDown();
                $('#type_email').slideUp();
            }else{
                $('#type_email').slideUp();
                $('#type_link').slideUp();
            }
}

    function getRegion(id){
        if(id == 1){
            $('#type_region').slideDown()

        }else{
            $('#type_region').slideUp()
        }
    }
</script>




@section('js-link')
<script src="{{asset('front/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/companies-announces.js')}}"></script>
@endsection



@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('front/css/companies-announces.css')}}">
<link rel="stylesheet" href="{{asset('front/css/jobsearch.css')}}">
<link rel="stylesheet" href="{{asset('front/css/header.css')}}">
@endsection