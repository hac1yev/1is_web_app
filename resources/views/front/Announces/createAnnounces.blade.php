<!DOCTYPE html>

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
                    <a class="nav-link trending-nav-link1" href="{{route('announcesindex')}}">
                        <img id="training_icon1" src="https://1is.butagrup.az/back/assets/images/icons/companies-purple.png" alt="company-white" /> @lang('front.sirketlerim')
                    </a>
                    <a class="nav-link active nav-link-2 trending-nav-link2" href="{{route('createAnnounces')}}">
                        <img id="training_icon2" src="https://1is.butagrup.az/back/assets/images/icons/create-announces-white.png" alt="create-announce-purple" />@lang('front.elanyarat')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link3" href="{{route('myAnnounces')}}">
                        <img id="training_icon3" src="https://1is.butagrup.az/back/assets/images/icons/announces-purple.png" alt="announces-purple" /> @lang('front.elanlarim')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link4" href="{{route('candidate')}}">
                        <img id="training_icon4" src="https://1is.butagrup.az/back/assets/images/icons/namizedler-purple.png" alt="namizedler-purple" />  @lang('front.namizedler')
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="tab-pane row create-announce-row" id="elan-yarat">
                        <form action="{{route('elanPost')}}" method="POST" enctype="multipart/form-data" class="tab-pane row company-announce-form fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                @csrf
                            
                            <div class="form-group company-announce-input-group col-12 @error('position') has-error @enderror ">
                                <label for="possession">@lang('front.vezife')</label>
                                <input type="text" name="position" class="form-control" id="possession" placeholder="@lang('front.vezife')" value="{{ old('position') }}" required />
                                @error('position')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.position_max')</span>
                                @enderror
                                
                                </div>
                            <div class="form-group company-announce-input-group col-12 @error('city') has-error @enderror ">
                                <label for="city">@lang('front.city')</label>
                                <select class="form-control" name="city" id="category" onchange="getRegion(this.value)" required >
                                    <option value="" selected disabled>@lang('front.birsec')...</option>
                                    @php
                                        $lang = config('app.locale');
                                    @endphp
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}"@if(old('city') == $city->id) selected @endif>
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
                                <div class="col-lg-12 mb-4" id="type_region" style="display: none">
                                    <label for="region" class="form-label d-block"> Bakı rayonları  <span class="text-danger">*</span></label>
                                    <select name="region" id="region" class="form-control mb-4">
                                        <option value="" selected disabled>Bakı rayonu...</option>
                                        @foreach($regions as $region)
                                            <option value="{{$region->id}}"@if(old('region') == $region->id) selected @endif>
                                                @if ($lang == 'EN')
                                                {{$region->title_en}}
                                            @elseif ($lang == 'RU')
                                                {{$region->title_ru}}
                                            @elseif ($lang == 'TR')
                                                {{$region->title_tr}}
                                            @else
                                                {{$region->title_az}}
                                            @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="form-group company-announce-input-group col-md-6 @error('category') has-error @enderror">
                                <label for="category">@lang('front.cat')</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="" selected disabled>@lang('front.cat')...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"@if(old('category') == $category->id) selected @endif>
                                            @if ($lang == 'EN')
                                    {{$category->title_en}}
                                @elseif ($lang == 'RU')
                                    {{$category->title_ru}}
                                @elseif ($lang == 'TR')
                                    {{$category->title_tr}}
                                @else
                                    {{$category->title_az}}
                                @endif</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="form-group company-announce-input-group col-md-6 @error('jobtype') has-error @enderror ">
                                <label for="work_graf">@lang('front.jobtype')</label>
                                    <select name="jobtype" id="jobtype" class="form-control" required >
                                        @foreach($jobtypes as $jobtype)
                                            <option value="{{$jobtype->id}}" @if(old('jobtype') == $jobtype->id) selected @endif>
                                                @if ($lang == 'EN')
                                        {{$jobtype->title_en}}
                                    @elseif ($lang == 'RU')
                                        {{$jobtype->title_ru}}
                                    @elseif ($lang == 'TR')
                                        {{$jobtype->title_tr}}
                                    @else
                                        {{$jobtype->title_az}}
                                    @endif</option>
                                        @endforeach
                                    </select>
                                    
                                </select>
                            </div>
                            <div class="form-group company-announce-input-group col-md-4">
                                <input type="number" class="form-control" id="min" name="min_salary" placeholder="@lang('front.minsalary')" value="{{ old('min_salary') }}" />
                                
                            </div>
                            <div class="form-group company-announce-input-group col-md-4">
                                <input type="number" class="form-control" id="max" name="max_salary" placeholder="@lang('front.maxsal')" value="{{ old('max_salary') }}" />
                                
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-end mb-3 ">
                                <label for="musahibe" class="musahibe-check-label">@lang('front.musahibe')</label>
                                <input type="checkbox" class="musahibe-check-input" id="musahibe" name="salary_type" />
                            </div>
                            <div class="form-group company-announce-input-group col-md-6 @error('min_age') has-error @enderror ">
                                <input type="number" class="form-control" id="age_min" name="min_age" placeholder="@lang('front.minyas'):" value="{{ old('min_age') }}" />
                                @error('min_age')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.min_age_numeric')</span>
                                @enderror
                            </div>
                            <div class="form-group company-announce-input-group col-md-6 @error('max_age') has-error @enderror ">
                                <input type="number" class="form-control" id="age_max" name="max_age" placeholder="@lang('front.maxyas'):" value="{{ old('max_age') }}"/>
                                @error('max_age')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.max_age_numeric')</span>
                                @enderror
                            </div>
                            <div class="form-group company-announce-input-group col-md-6 @error('experience') has-error @enderror ">
                                <select name="experience" id="experience" class="form-control" required>
                                    <option value="" selected disabled>@lang('front.expsec')...</option>
                                    @foreach($experiences as $experience)
                                        <option value="{{$experience->id}}"@if(old('experience') == $experience->id) selected @endif>
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
                            <div class="form-group company-announce-input-group col-md-6 @error('education') has-error @enderror ">
                                <select name="education" id="education" class="form-control" required>
                                    <option value="" selected disabled>@lang('front.tehsilsec')...</option>
                                    @foreach($educations as $education)
                                        <option value="{{$education->id}}" @if(old('education') == $education->id) selected @endif>
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
                            <div class="form-group company-announce-input-group col-12 @error('requirements') has-error @enderror">
                                <label for="demands">@lang('front.namteleb')</label>
                                <textarea name="requirements" class="form-control" id="demands" rows="5" placeholder="@lang('front.melumatver')!">{{ old('requirements') }}</textarea>
                            </div>
                            
                            <div class="form-group company-announce-input-group col-12 @error('description') has-error @enderror">
                                <label for="about_work">@lang('front.ismelumat')</label>
                                <textarea name="description" class="form-control" id="about_work" rows="5" placeholder="@lang('front.melumatver')!">{{ old('description') }}</textarea>
                               
                            </div>
                            <div class="form-group company-announce-input-group col-12 @error('company') has-error @enderror">
                                <label for="companies">@lang('front.companies')</label>
                                <select class="form-control" id="companies" name="company" required value="{{ old('company') }}" required>
                                    <option value="" selected disabled>@lang('front.sirketsec')...</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}"@if(old('company') == $company->id) selected @endif>{{$company->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="form-group company-announce-input-group col-12 @error('contact_name') has-error @enderror">
                                <label for="responsible_person">@lang('front.elaqesexs')</label>
                                <input type="text" name="contact_name" class="form-control" id="responsible_person" placeholder="@lang('front.adsoyad')" value="{{ old('contact_name') }}">
                            </div>

                            <div class="form-group company-announce-input-group col-12 @error('accept_type') has-error @enderror">
                                <label for="accept_cv">@lang('front.cvqebull')</label>
                                <select name="accept_type" id="accept_type" class="form-control" onchange="getContact(this.value)" required>
                                    <option selected disabled>@lang('front.birsec')...</option>
                                    @foreach($types as $key=>$type)
                                        <option value="{{$key}}" @if(old('accept_type') == $type->id) selected @endif>
                                            @if ($lang == 'EN')
                                            {{$type->title_en}}
                                        @elseif ($lang == 'RU')
                                            {{$type->title_ru}}
                                        @elseif ($lang == 'TR')
                                            {{$type->title_tr}}
                                        @else
                                            {{$type->title_az}}
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                                @error('accept_type')
                                <span class="text-danger" style="font-size: 14px">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="col-lg-12 mb-4 @error('contact_link') has-error @enderror" id="type_link" @if ($errors->has('contact_link')) style="display:block" @else style="display:none" @endif>
                                <label for="contact_link" class="form-label">@lang('front.contactlink') <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="contact_link" name="contact_link" placeholder="@lang('front.contactlink'):" value="{{old('contact_link')}}">
                                @error('contact_link')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.contact_link_active_url')</span>
                                @enderror
                            </div>
                            
                            <div class="col-lg-12 mb-4 @error('contact_email') has-error @enderror" id="type_email" @if ($errors->has('contact_email')) style="display:block" @else style="display:none" @endif>
                                <label for="contact_email" class="form-label">@lang('front.conmail') <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="contact_email" name="contact_email" placeholder="@lang('front.conmail'):" value="{{old('contact_email')}}">
                                @error('contact_email')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.contact_email_email')</span>
                                @enderror
                            </div>
                            
                            <div class="form-group company-announce-input-group col-12 @error('deadline') has-error @enderror">
                                <label for="end_date">@lang('front.deadline')</label>
                                <input type="date" class="form-control" name="deadline" id="end_date" required value="{{ old('deadline') }}"/>
                                @error('deadline')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.deadline_date')</span>
                                @enderror
                            </div>
                            
                            <div class="col-md-8 d-flex align-items-center ">
                                <label class="accept-demand-label" for="accept-demands">@lang('front.cvqebul')</label>
                                <input class="accept-demand-input" type="checkbox"  id="accept-demands" reqz />
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