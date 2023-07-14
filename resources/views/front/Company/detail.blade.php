@extends('front.layouts.master')


@section('content')

<style>

    .rating-css div {
        color: #8843E1;
        font-size: 30px;
        font-family: sans-serif;
        font-weight: 800;
        text-transform: uppercase;
        padding: 20px 0;
    }
    .rating-css input {
        display: none;
    }
    .rating-css input + label {
        font-size: 20px;
        text-shadow: 1px 1px 0 #8f8420;
        cursor: pointer;
        color: #8843E1; /* Varsayılan yıldız rengi */

    }
    .rating-css input:checked + label ~ label {
        color: #b4afaf;
    }
    .rating-css label:active {
        transform: scale(0.8);
        transition: 0.3s ease;
    }

    .owl-carousel:has(.aaa) .owl-prev,
    .owl-carousel:has(.aaa) .owl-next {
        display: none;
    }

    .my-modal-header-img {
        width: 220px;
        height: 220px;
        object-fit: contain;
    }
</style>




<section class="company-inner">
      <div class="container company-inner-container">
        <h3>{{$compdetail->name}}</h3>
        <div class="about-company-wrapper">
          <div class="about-company-image">

            <img src="https://1is.butagrup.az/{{$compdetail->image}}" alt="kapital" />
            
          </div>
          <div class="row about-company-text-wrapper">
            <div class="col-md-7 about-company-col">
              <div class="about-company">
                <h5>@lang('front.comphaq')</h5>
                <p>
                  @if(mb_strlen(htmlspecialchars_decode($compdetail->about)) > 465)
                  {{ mb_substr(htmlspecialchars_decode($compdetail->about), 0, 465) . ' ...' }}
              @else
                  {{ htmlspecialchars_decode($compdetail->about) }}
              @endif
              
                </p>

                <div class="about-company-button">
                  <button
                    data-toggle="modal"
                    data-target=".bd-example-modal-xl"
                  >
                    @lang('front.etrafli')
                  </button>
                  <div>
                    @php
                        $stars = round($compdetail->average);
                    @endphp
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $stars)
                            <img src="https://1is-new.netlify.app/images/star-fil.png" alt="">
                        @else
                            <img src="https://1is-new.netlify.app/images/star-emp.png" alt="">
                        @endif
                    @endfor
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5 about-company-col">
              <div class="main-office">
                <h5>@lang('front.basofis')</h5>
                <p>{{$compdetail->address}}</p>
              </div>
            </div>
            <div class="col-md-4 about-company-col">
              <div class="number-of-employees">
                <h5>@lang('front.baxissay')</h5>
                <span>
                    {{$compdetail->view}}
                  <img src="{{asset('back/assets/images/icons/Icon.png')}}" alt="icon" />
                </span>
              </div>
            </div>
            <div class="col-md-4 about-company-col">
              <div class="number-of-vacancies">
                <h5>@lang('front.vaccount')</h5>
                <span>
                    {{$compdetail->vacanc_say}}
                  <img src="{{asset('back/assets/images/icons/bag.png')}}" alt="bag" />
                </span>
              </div>
            </div>
            <div class="col-md-4 about-company-col">
              <div class="company-about-link">
                <h5>@lang('front.vebsite') </h5>
                <div class="company-about-socials">
                  <div class="company-about-social-media" href="#">
                    <a href="{{ str_replace('"', '', $compdetail->twitter) }}">
                        <img src="{{asset('back/assets/images/icons/internet-explorer.png')}}" alt="internet">
                    </a>
                  </div>
                  <div class="company-about-social-media" href="#">
                    <a href="{{ str_replace('"', '', $compdetail->facebook) }}">
                        <img src="{{asset('back/assets/images/icons/footer-fb.png')}}" alt="facebook">
                    </a>
                  </div>
                  <div class="company-about-social-media" href="#">
                    <a href="{{ str_replace('"', '', $compdetail->instagram) }}">
                        <img src="{{asset('back/assets/images/icons/footer-ig.png')}}" alt="instagram">
                    </a>
                  </div>
                  <div class="company-about-social-media" href="#">
                    <a href="{{ str_replace('"', '', $compdetail->linkedin) }}">
                        <img src="{{asset('back/assets/images/icons/footer-li.png')}}" alt="linkedin">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CAROUSEL SECTION -->
    <div class="container company-inner-container">
      <div class="carousel-vacancy">
        <h3>@lang('front.vacancies')</h3>
        <div>
          <a href="{{route('compvac', $compdetail->id)}}">@lang('front.readmore')</a>
        </div>
      </div>

      <div class="row w-100 m-0 d-flex justify-content-center">     

        <div class="owl-carousel owl-theme w-100">
            @if(count($vacancies) > 4)
              @foreach($vacancies as $vacanc)
                <div class="slider-vacancy">
                  <div class="slider-vacancy-header">
                    <span></span>
                    <a href="{{route('vacancydetail', $vacanc->id)}}"><p>{{Str::limit($vacanc->title_az, 20, '...')}}</p></a>
                  </div>
                  <a href="{{route('vacancydetail', $vacanc->id)}}"><h3>{{Str::limit($vacanc->position, 10, '...')}}</h3></a>
                  <div class="slider-vacancy-footer">
                    <span>
                      <img src="{{asset('back/assets/images/icons/building.png')}}" alt="building" />
                      <a  href="{{route('compdetail', $vacanc->company_id)}}" style="color:#ecdbfc">{{$vacanc->company_name}}</a>
                    </span>
                    <span>
                      <img src="{{asset('back/assets/images/icons/clock.png')}}" alt="clock" />
                      {{$vacanc->created_at->format('d.m.Y')}}
                    </span>
                  </div>
                </div>
              @endforeach
            @elseif(count($vacancies) <= 4)
              @if(count($vacancies) == 0)
                <div class="slider-vacancy aaa">
                  <div class="slider-vacancy-header">
                    <span></span>
                    <p>@lang('front.vakansiyayoxdur')</p>
                  </div>
                 
                  </div>
                </div>
              @else
                @foreach($vacancies as $vacanc)
                <div class="slider-vacancy aaa">
                    <div class="slider-vacancy-header">
                      <span></span>
                      <a href="{{route('vacancydetail', $vacanc->id)}}"><p>{{Str::limit($vacanc->title_az, 20, '...')}}</p></a>
                    </div>
                    <a href="{{route('vacancydetail', $vacanc->id)}}"><h3>{{Str::limit($vacanc->position, 10, '...')}}</h3></a>
                    <div class="slider-vacancy-footer">
                      <span>
                        <img src="{{asset('back/assets/images/icons/building.png')}}" alt="building" />
                        <a class="comp-link" href="{{route('compdetail', $vacanc->company_id)}}" >{{$vacanc->company_name}}</a>
                      </span>
                      <span>
                        <img src="{{asset('back/assets/images/icons/clock.png')}}" alt="clock" />
                        {{$vacanc->created_at->format('d.m.Y')}}
                      </span>
                    </div>
                  </div>
                @endforeach
              @endif
            @endif
          </div>
          
        
        
      </div>
    </div>

    <!-- COMMENTS SECTION -->
    <div class="container company-inner-container">
      <h3 class="company-inner-comment-header">@lang('front.comments')</h3>
      <div class="row">
        @if(count($comments) > 0)
            @foreach ($comments as $comment)
                <div class="col-md-6 mt-3">
                    <div class="comment">
                        <div class="comment-top-section">
                            <div class="comment-profile">
                                <div class="comment-avatar">
                                    <img src="{{asset('back/assets/images/icons/avatar.png')}}" alt="avatar" />
                                </div>
                                <div class="comment-profile-name">
                                    <p>{{$comment->fullname}}</p>
                                    <span class="comment-profile-start">
                                        @for ($i = 1; $i <= $comment->rating; $i++)
                                            <img src="{{ asset('back/assets/images/icons/comment-star.png') }}" alt="comment-star" />
                                        @endfor
                                    </span>
                                    
                                </div>
                            </div>
                            <span class="comment-date">{{date('d-m-Y', strtotime($comment->review_created))}}</span>
                        </div>
                        <div class="comment-bottom-section">
                            <span>{{$comment->message}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12 mt-6 m-auto">
                <p>@lang('front.reyyoxdur')!</p>
            </div>
        @endif

  </div>
    
  <div class="comment-button">
  </div>
</div>

 <!-- Modal -->
 <div class="modal fade bd-example-modal-xl" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
     <div class="my-modal-header">
       <img class="my-modal-header-img" src="{{asset($compdetail->image)}}" alt="" />
       <div class="modal-header-details">
         <h1>{{$compdetail->name}}</h1>
         @php
              $stars = round($compdetail->average);
          @endphp
          @for($i = 1; $i <= 5; $i++)
              @if($i <= $stars)
                  <img src="https://1is-new.netlify.app/images/star-fil.png" alt="">
              @else
                  <img src="https://1is-new.netlify.app/images/star-emp.png" alt="">
              @endif
          @endfor
       </div>
     </div>
     <div class="modal-header-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">@lang('front.about')</a>
            </li>
            &nbsp;
            @if (!is_null($compdetail->hr) && !empty($compdetail->hr))
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">@lang('front.hr')</a>
                </li>
            @endif
        </ul>
        
       <div class="tab-content" id="myTabContent">
         <div
           class="tab-pane fade show active"
           id="home"
           role="tabpanel"
           aria-labelledby="home-tab"
         >
           <p class="comp-detail">
            {{htmlspecialchars_decode($compdetail->about)}}

           </p>
           <br />
           <div class="location-div">
             <img src="https://1is-new.netlify.app/images/location.png" alt="" />
             <span>{{$compdetail->address}}</span
             >
           </div>
           <div class="map-loc">
            
            <iframe srcdoc="{{htmlspecialchars_decode($compdetail->map)}}" 
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>

           </div>
           <div class="rating-div">
             <h1>@lang('front.qiymet')</h1>
             <div class="rate-div">
               <div class="rate-left">
                 <div class="rate-left-p1">
                   <span class="rate-per">{{$faizcomment}} %</span>
                  <form action="{{route('addComment')}}" method="POST">
                    @csrf
                   <div class="rating-css">
                        <div class="star-icon">
                            <input type="radio" value="1" name="rating" checked id="rating1" required>
                            <label for="rating1" class="fa fa-star"></label>
                            <input type="radio" value="2" name="rating" id="rating2">
                            <label for="rating2" class="fa fa-star"></label>
                            <input type="radio" value="3" name="rating" id="rating3">
                            <label for="rating3" class="fa fa-star"></label>
                            <input type="radio" value="4" name="rating" id="rating4">
                            <label for="rating4" class="fa fa-star"></label>
                            <input type="radio" value="5" name="rating" id="rating5">
                            <label for="rating5" class="fa fa-star"></label>
                        </div>
                    </div>
                     
                   <span class="rate-span">{{$ratingCount}} rəy</span>
                 </div>
                 <div class="rate-left-p2">
                   
                    <input type="hidden" name="company_id" value="{{ $compdetail->id }}"> 

                    <label class="name-label" for="name">@lang('front.adsoyad')* <br />
                              @auth
                              <input type="text" id="name" name="fullname" value="{{ auth()->user()->name }}" />
                              @else
                    <input type="text" id="name" name="fullname" value="" />
                    @endauth
                    </label>

                     <br />
                     <label for="name">@lang('front.qiy')*</label>
                     <div></div>
                     <button class="rating-send">@lang('front.gonder')</button>
                 </div>
               </div>
               <div class="rate-right">
                <div class="rate-right-p1">
                  
                  <div class="rate-right-div">
                    <span id="value-span">5</span>
                    <div class="loading">
                      <div class="progress-barr">
                        @if ($totalRatings > 0)
                        <div class="inner" style="width: {{ ($ratingsbar5 / $totalRatings) * 100 }}%;"></div>
                    @else
                        <div class="inner" style="width: 0;"></div>
                    @endif
                      </div>
                    </div>
                  </div>

                  <div class="rate-right-div">
                      <span id="value-span">4</span>
                      <div class="loading">
                        <div class="progress-barr">
                          @if ($totalRatings > 0)
                          <div class="inner" style="width: {{ ($ratingsbar4 / $totalRatings) * 100 }}%;"></div>
                      @else
                          <div class="inner" style="width: 0;"></div>
                      @endif
                        </div>
                      </div>
                    </div>

                    <div class="rate-right-div">
                      <span id="value-span">3</span>
                      <div class="loading">
                        <div class="progress-barr">
                          @if ($totalRatings > 0)
                          <div class="inner" style="width: {{ ($ratingsbar3 / $totalRatings) * 100 }}%;"></div>
                      @else
                          <div class="inner" style="width: 0;"></div>
                      @endif
                        </div>
                      </div>
                    </div>

                    <div class="rate-right-div">
                      <span id="value-span">2</span>
                      <div class="loading">
                        <div class="progress-barr">
                          @if ($totalRatings > 0)
                          <div class="inner" style="width: {{ ($ratingsbar2 / $totalRatings) * 100 }}%;"></div>
                      @else
                          <div class="inner" style="width: 0;"></div>
                      @endif
                        </div>
                      </div>
                    </div>

                    <div class="rate-right-div">
                      <span id="value-span">1</span>
                      <div class="loading">
                        <div class="progress-barr">
                          @if ($totalRatings > 0)
                          <div class="inner" style="width: {{ ($ratingsbar1 / $totalRatings) * 100 }}%;"></div>
                      @else
                          <div class="inner" style="width: 0;"></div>
                      @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                  
                 <div class="rate-right-p2">
                   <p class="your-com">@lang('front.reyiniz')</p>
                   <textarea name="message" id="text-area"></textarea>
                 </div>
                </form>

               </div>
             </div>
           </div>
         </div>
         <div
           class="tab-pane fade"
           id="profile"
           role="tabpanel"
           aria-labelledby="profile-tab"
         >
         <p class="comp-detail">
          {{htmlspecialchars_decode($compdetail->hr)}}

         </p>
         <br />
         
         

           </div>
         </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection




@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/company-inner.css')}}">
<link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('front/css/owl.theme.default.min.css')}}">
@endsection

@section('js-link')

<script src="{{asset('front/js/bootstrap.min.js')}}"></script> 
<script
      src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.1.2/js/star-rating.min.js"
      integrity="sha512-BjVoLC9Qjuh4uR64WRzkwGnbJ+05UxQZphP2n7TJE/b0D/onZ/vkhKTWpelfV6+8sLtQTUqvZQbvvGnzRZniTQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script> 
@endsection
