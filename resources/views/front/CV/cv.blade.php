<!DOCTYPE html>

@extends('front.layouts.master')

<style>
    #structure{
        align-items: flex-end;
    }

    #comp_link, #comp_name, #job_name{
        background: #FFFFFF;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        padding: 12px 14px!important;
    }

    .removeElement{
        margin-left: 15px;
        /* padding: 0px 15px; */
        padding: 15px 29px;
        border: none;
        background: #9559E5;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 17px;
        color: #FFFFFF;
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
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <section class="create-cv" >
        <div class="container create-cv-container">
            <div class="row m-0">   
                <div class="nav flex-column nav-pills create-cv-tabs col-lg-4 col-md-8" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active trending-nav-link1" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <img id="training_icon1" src="{{asset('back/assets/images/icons/add-training-white.png')}}" alt="add-training-white" /> @lang('front.cvadd')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <img id="training_icon2" src="{{asset('back/assets/images/icons/training-list-purple1.png')}}" alt="training-list-purple" /> @lang('front.cvler')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link3" id="v-pills-liked-cv-tab" data-toggle="pill" href="#v-pills-liked-cv" role="tab" aria-controls="v-pills-liked-cv" aria-selected="false">
                        <img id="training_icon3" src="{{asset('back/assets/images/icons/training-list-purple1.png')}}" alt="training-list-purple" /> Bəyəndiyim CV-lər
                    </a>
                </div>
                <div class="tab-content col-lg-8" id="v-pills-tabContent">
                    <form class="tab-pane row create-cv-form fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" method="POST" action="{{route('cvPost')}}" enctype="multipart/form-data">
                        @csrf
                        <h3 class="col-12"></h3>
                        <div class="form-group create-cv-input-group col-md-6 @error('name') has-error @enderror">
                            <label for="name">@lang('front.ad')</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="@lang('front.addaxilet')" value="{{ old('name') }}" required />
                           
                        </div>
                        <div class="form-group create-cv-input-group col-md-6 @error('surname') has-error @enderror">
                            <label for="surName">@lang('front.soyad')</label>
                            <input type="text" name="surname" class="form-control" id="surName" placeholder="@lang('front.soyaddaxil')" value="{{ old('surname') }}" required />
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-6 @error('father_name') has-error @enderror">
                            <label for="fatherName">@lang('front.ata')</label>
                            <input type="text" name="father_name" class="form-control" id="fatherName" placeholder="@lang('front.atadaxilet')" value="{{ old('father_name') }}" required />
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-6 @error('email') has-error @enderror">
                            <label for="Email">@lang('front.epoct')</label>
                            <input type="email" name="email" class="form-control" id="Email" placeholder="@lang('front.emaildaxilet')" value="{{ old('email') }}" required/>
                            @error('email')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.email_email')</span>
                                @enderror
                        </div>
                        <div class="form-group create-cv-input-group col-12 @error('title') has-error @enderror">
                            <label for="possession">@lang('front.vezife')</label>
                            <input type="text" class="form-control" name="position" id="possession" placeholder="@lang('front.vezifedaxilet')" value="{{ old('position') }}" />
                            @error('position')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.position_max')</span>
                                @enderror
                        </div>
                        <h3 class="col-12">@lang('front.gostericiler')</h3>
                        <div class="form-group create-cv-input-group col-md-4 @error('category') has-error @enderror">
                            <select class="form-control" name="category" id="cv_categories"  required>
                              <option disabled selected>@lang('front.cats')</option>
                              @php
                                $lang = config('app.locale');
                            @endphp
                              @foreach($categories as $category)
                                <option value="{{$category->id}}">
                                    @if ($lang == 'EN')
                                    {{$category->title_en}}
                                @elseif ($lang == 'RU')
                                    {{$category->title_ru}}
                                @elseif ($lang == 'TR')
                                    {{$category->title_tr}}
                                @else
                                    {{$category->title_az}}
                                @endif
                            </option>
                            @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-4 @error('city') has-error @enderror ">
                            <select class="form-control" name="city" id="city">
                              <option  disabled selected>@lang('front.city')</option>
                              @foreach($cities as $city)
                                <option value="{{$city->id}}">
                                    @if ($lang == 'EN')
                                    {{$city->title_en}}
                                @elseif ($lang == 'RU')
                                    {{$city->title_ru}}
                                @elseif ($lang == 'TR')
                                    {{$city->title_tr}}
                                @else
                                    {{$city->title_az}}
                                @endif
                            </option>
                            @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-4 @error('education') has-error @enderror">
                            <select class="form-control" name="education" id="education">
                                <option selected disabled>@lang('front.educ')...</option>
                                @foreach($educations as $education)
                                    <option value="{{$education->id}}">
                                        @if ($lang == 'EN')
                                        {{$education->title_en}}
                                    @elseif ($lang == 'RU')
                                        {{$education->title_ru}}
                                    @elseif ($lang == 'TR')
                                        {{$education->title_tr}}
                                    @else
                                        {{$education->title_az}}
                                    @endif
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group create-cv-input-group col-md-4 @error('experience') has-error @enderror">
                            <select class="form-control" name="experience" id="exprience">
                                <option selected disabled>@lang('front.exp')...</option>
                                @foreach($experiences as $experience)
                                    <option value="{{$experience->id}}">
                                        @if ($lang == 'EN')
                                        {{$experience->title_en}}
                                    @elseif ($lang == 'RU')
                                        {{$experience->title_ru}}
                                    @elseif ($lang == 'TR')
                                        {{$experience->title_tr}}
                                    @else
                                        {{$experience->title_az}}
                                    @endif
                                </option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-4 @error('jobtype') has-error @enderror">
                            <select class="form-control" name="jobtype" id="work_graf">
                                <option selected disabled>@lang('front.jobtype')...</option>
                                @foreach($jobtypes as $jobtype)
                                    <option value="{{$jobtype->id}}">
                                        @if ($lang == 'EN')
                                        {{$jobtype->title_en}}
                                    @elseif ($lang == 'RU')
                                        {{$jobtype->title_ru}}
                                    @elseif ($lang == 'TR')
                                        {{$jobtype->title_tr}}
                                    @else
                                        {{$jobtype->title_az}}
                                    @endif
                                </option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-4 @error('salary') has-error @enderror">
                            <input type="number" class="form-control" name="salary" id="min-number" placeholder="@lang('front.minsalary')" />
                            
                        </div>
                        <h3 class="col-12">@lang('front.dogum')</h3>
                        <div class="form-group create-cv-input-group col-md-4 @error('birth') has-error @enderror">
                            <label for="training_date">@lang('front.dogum')</label>
                            <input type="date" class="form-control" name="birth" id="birth_date"/>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-4 @error('gender') has-error @enderror">
                            <label for="training_companies">@lang('front.cinssec')</label>
                            <select class="form-control" id="cins" name="gender">
                                <option selected disabled>@lang('front.cinssec')...</option>
                                @foreach($genders as $gender)
                                    <option value="{{$gender->id}}">
                                        @if ($lang == 'EN')
                                            {{$gender->title_en}}
                                        @elseif ($lang == 'RU')
                                            {{$gender->title_ru}}
                                        @elseif ($lang == 'TR')
                                            {{$gender->title_tr}}
                                        @else
                                            {{$gender->title_az}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                           
                        </div>
                        <div class="form-group create-cv-input-group col-md-4 @error('image') has-error @enderror">
                            <label for="images">@lang('front.sekilsec')</label>
                            <div class="custom-file create-cv-custom-file">
                                <input type="file" name="image" class="custom-file-input js-custom-file-input-enabled" data-toggle="custom-file-input" id="images" accept="image/png, image/jpeg, image/svg+xml, image/webp" required>
                                <label class="custom-file-label add-image-label" for="image">@lang('front.elaveet')</label>
                            </div>
                            @error('image')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.image_max')</span>
                                @enderror
                        </div>
                        
                        <div class="form-group create-cv-input-group col-12 @error('about_education') has-error @enderror ">
                            <label for="training_information">@lang('front.tehsilhaq')</label>
                            <textarea class="form-control" name="about_education" id="education_information" rows="5" placeholder="@lang('front.melumatver')!" value="{{ old('about_education') }}"></textarea>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-12 @error('work_experience') has-error @enderror">
                            <label for="training_information">@lang('front.techaq')</label>
                            <textarea class="form-control" name="work_experience" id="exprience_information" rows="5" placeholder="@lang('front.melumatver')!" value="{{ old('work_experince') }}"></textarea>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-12 @error('skills') has-error @enderror">
                            <label for="training_information">@lang('front.serthaq')</label>
                            <textarea class="form-control" name="skills" id="certificate_information" rows="5" placeholder="@lang('front.melumatver')!" value="{{ old('skills') }}"></textarea>
                            
                        </div>
                        
                        <div class="container" data-repeater-list="group-a">
                            <div id="repeater">
                                <label for="" class="form-label">@lang('front.portfolio')</label> <br>
                                <input type="button" id="createElement" class="btn btn-danger" value="İş Yeri Əlavə Et" />
                                <div class='row' id="structure" style="display:none">
                                    <div class='col-lg-3'>
                                        <label for='first-name'>@lang('front.isinadi')</label> <br>
                                        <input type="text" name="work_name" id="job_name" value="" class="form-control" placeholder="@lang('front.daxilet')" />
                                    </div>
                                    <div class='col-lg-3'>
                                        <br>
                                        <label for='first-name'> @lang('front.companies')</label> <br>
                                        <input type="text" name="work_company" id="comp_name" value="" class="form-control" placeholder="@lang('front.daxilet')" />
                                    </div>
                                    <div class='col-lg-3'>
                                    <br>
                                        <label for='first-name'>@lang('front.link')</label> <br>
                                        <input type="url" name="work_link" id="comp_link" value="" class="form-control" placeholder="@lang('front.daxilet')" />
                                    </div>
                                </div>
                                <div id="containerElement"></div>   
                            </div>
   
                        </div>  


                        <h3 class="col-12">@lang('front.contact')</h3>
                        <div class="form-group create-cv-input-group col-md-6 @error('contact_email') has-error @enderror">
                            <label for="e_poçt">@lang('front.conmail')</label>
                            <input type="email" name="contact_mail" class="form-control" id="e_poçt" placeholder="@lang('front.emaildaxilet')" value="{{ old('contact_email') }}"  />
                            @error('contact_email')
                            <span class="text-danger" style="font-size: 14x">@lang('validation.contact_mail_email')</span>
                            @enderror
                        </div>
                        <div class="form-group create-cv-input-group col-md-6 @error('contact_phone') has-error @enderror">
                            <label for="contact_number">@lang('front.contel')</label>
                            <input type="number" class="form-control" name="contact_phone" id="contact_number" placeholder="@lang('front.nomredaxilet')" value="{{ old('contact_phone') }}" />
                            
                        </div>
                        
                        <div class="form-group create-cv-input-group col-12 @error('cv') has-error @enderror">
                            <label for="images2" class="add-cv-label">@lang('front.cv')</label>
                            <div class="custom-file add-cv-custom-file">
                                <input type="file" name="cv" class="custom-file-input js-custom-file-input-enabled" accept="application/pdf,application/vnd.ms-excel" data-toggle="custom-file-input" id="images2" required>
                                <label class="custom-file-label" for="image" id="file-label">@lang('front.yalnizpng')</label>
                                <span id="file-name"></span> <!-- Dosya adını görüntülemek için eklenen <span> -->
                                <div id="preview-container"></div>
                                @error('cv')
                                <span class="text-danger" style="font-size: 14px">@lang('validation.contact_mail_email')</span>
                                @enderror
                            </div>
                        </div>
                        
                        <script>
                            document.getElementById('images2').addEventListener('change', function(e) {
                                var file = e.target.files[0];
                                var fileName = file.name;
                                document.getElementById('file-name').textContent = fileName;
                        
                                var allowedExtensions = /(\.png|\.jpg|\.jpeg|\.gif)$/i;
                                var fileLabel = document.getElementById('file-label');
                                var previewContainer = document.getElementById('preview-container');
                        
                                if (allowedExtensions.exec(fileName)) {
                                    fileLabel.textContent = fileName;
                                    
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        var img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.style.maxWidth = '200px';
                                        img.style.maxHeight = '200px';
                                        img.style.objectFit = 'cover';
                                        previewContainer.innerHTML = '';
                                        previewContainer.appendChild(img);
                                    };
                                    reader.readAsDataURL(file);
                                } 
                            });
                        </script>
                        
                        
                                                

                        <div class="create-cv-form-button">
                            <button type="submit">@lang('front.elaveet')</button>
                        </div>
                    </form>
                    <div class="tab-pane create-cv-card-wrapper fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4 class="create-cv-header">@lang('front.cvler')</h4>
                        <div class="row">
                            @foreach($cvs as $key=>$cv)
                            <div class="col-lg-6 col-md-6 d-flex justify-content-center create-cv-card-col">
                                <a href="{{route('cvedit', $cv->id)}}" class="job-search-card cv-jobsearcher cv-jobsearcher">
                                    <img class="job-search-avatar" src="{{$cv->image}}" alt="job-search-card1">

                                    <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.38092 12.2816L8.30584 12.3566L8.22325 12.2816C4.65696 9.04914 2.29945 6.91164 2.29945 4.74414C2.29945 3.24414 3.42565 2.11914 4.92724 2.11914C6.08347 2.11914 7.20967 2.86914 7.60759 3.88914H9.00408C9.402 2.86914 10.5282 2.11914 11.6844 2.11914C13.186 2.11914 14.3122 3.24414 14.3122 4.74414C14.3122 6.91164 11.9547 9.04914 8.38092 12.2816ZM11.6844 0.619141C10.378 0.619141 9.12421 1.22664 8.30584 2.17914C7.48747 1.22664 6.23363 0.619141 4.92724 0.619141C2.61478 0.619141 0.797852 2.42664 0.797852 4.74414C0.797852 7.57164 3.35057 9.88914 7.21718 13.3916L8.30584 14.3816L9.3945 13.3916C13.2611 9.88914 15.8138 7.57164 15.8138 4.74414C15.8138 2.42664 13.9969 0.619141 11.6844 0.619141Z" fill="#8843E1"></path>
                                        
                                    </svg>
                                    <img class="job-edit-img" src="{{asset('back/assets/images/icons/Vector.png')}}" alt=""/>
                                    

                                    <div class="jobsearch-card-information">

                                        <h4>{{$cv->name}} {{$cv->surname}}</h4>
                                        <p>{{$cv->position}}</p>
                                        <h3>{{ $cv->salary ? $cv->salary.'₼' : '~' }}</h3>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            <div class="add-training-card-more-button">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane row cv-liked-card-wrapper fade" id="v-pills-liked-cv" role="tabpanel" aria-labelledby="v-pills-liked-cv-tab">
                        @foreach ($favorits as $fav)
                            
                        <div class="col-lg-6 jobsearch-card-col mt-3">
                            <div class="job-search-card">
                                <img class="job-search-avatar" src="{{$fav->image}}" alt="job-search-card1">
                                
                                <img src="{{ asset('back/assets/images/icons/heart.png') }}" alt="heart" class="heart-icon" data-cv-id="{{$fav->id}}" style="{{ in_array($fav->id, $likes) ? 'display: none;' : 'display: inline-block;' }}">
                                <img src="{{ asset('back/assets/images/icons/red-heart.png') }}" alt="red-heart" class="red-heart-icon" data-cv-id="{{$fav->id}}" style="{{in_array($fav->id, $likes) ? 'display: inline-block;' : 'display: none;' }}">
                                <div class="jobsearch-card-information">
                                    <a href="{{ route('jobsearchdetail', $fav->id) }}"><h4>{{$fav->name}} {{$fav->surname}}</h4></a>
                                    <p>{{$fav->position}}</p>
                                    <h3>{{ $fav->salary ? $fav->salary.'₼' : '~' }}</h3>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var heartIcons = document.querySelectorAll('.red-heart-icon');

        heartIcons.forEach(function (icon) {
            icon.addEventListener('click', function () {
                var cvId = this.getAttribute('data-cv-id');
                var redHeartIcon = document.querySelector('.heart-icon[data-cv-id="' + cvId + '"]');
                var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

                if (isLoggedIn) {
                    this.style.display = 'none';
                    redHeartIcon.style.display = 'inline-block';
                }

                // AJAX isteği
                var xhr = new XMLHttpRequest();
                var url = '{{ route('cvdislike') }}'; // Dislike işlemi için uygun URL'yi buraya yazın
                var params = 'cv_id=' + cvId + '&_token=' + '{{ csrf_token() }}';

                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            if (!isLoggedIn) {
                                redHeartIcon.style.display = 'inline-block';
                                icon.style.display = 'none'; // Hide the white heart icon for anonymous users

                            }
                        } else if (xhr.status === 403) {
                            var response = JSON.parse(xhr.responseText);
                            alert(response.error);
                        }
                    }
                };

                xhr.send(params);
            });
        });
        });
    </script>
@endsection

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('front/css/create-cv.css')}}">
<link rel="stylesheet" href="{{asset('front/css/jobsearch.css')}}">
<link rel="stylesheet" href="{{asset('front/css/header.css')}}">
@endsection

@section('js-link')
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/add-training.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="{{asset('front/js/repeater.js')}}"></script>
@endsection


<script src="https://cdn.tiny.cloud/1/fnxhgzthj2q2iqh3di27mlytx4bdj9wbroguqsoawsbwwfyn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

    tinymce.init({
        selector: 'textarea',
        
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        editimage_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        toolbar_sticky_offset: isSmallScreen ? 102 : 108,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        link_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        importcss_append: true,
        file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
            }
        },
        templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 400,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>



@section('js')


<script>
      $(function () {
        $("#repeater").repeater({
          items: [
            {
              elements: [
                {
                  id: "first_name",
                  value: "",
                },
                {
                  id: "languages",
                  value: "css",
                },
              ],
            },
          ],
        });
      });

      const removeBtn = document.querySelector('.removeElement')
      console.log('Remove BTN',removeBtn)
    </script>
@endsection