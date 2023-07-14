<!DOCTYPE html>

@extends('front.layouts.master')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
       @endforeach

        <div>
            <h3>@lang('front.vacancies') </h3>
        </div>
        
    </section>

    <section class="edit-announce mt-3">
        <div class="container edit-announce-container">
            <form action="{{route('elanEditPost')}}" method="POST" enctype="multipart/form-data" class="tab-pane row company-announce-form fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <input type="hidden" name="id" value="{{$vacancy->id}}">
                    @csrf
                <div class="form-group company-announce-input-group col-12">
                    <label for="possession">@lang('front.vezife')</label>
                    <input type="text" class="form-control" name="position" id="possession" placeholder="@lang('front.vezife')" value="{{$vacancy->position}}" required />
                </div>
                <div class="form-group company-announce-input-group col-12">
                    <label for="city">@lang('front.city')</label>
                    <select name="city" id="companies" class="form-control" required>
                        <option value="" selected disabled>@lang('front.birsec')...</option>
                        @php
                            $lang = config('app.locale');
                        @endphp
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" @if($vacancy->city_id == $city->id) selected @endif>
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
                <div class="form-group company-announce-input-group col-md-6">
                    <label for="category">@lang('front.cats')</label>
                    <select class="form-control" name="category" id="category" required>
                        <option value="" selected disabled>@lang('front.birsec')...</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($vacancy->category_id == $category->id) selected @endif>
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
                <div class="form-group company-announce-input-group col-md-6">
                    <label for="work_graf">@lang('front.jobtype')</label>
                    <select name="jobtype" class="form-control" id="work_graf" required>
                        @foreach($jobtypes as $jobtype)
                        <option value="{{$jobtype->id}}" @if($vacancy->job_type_id == $jobtype->id) selected @endif>
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
                <div class="form-group company-announce-input-group col-md-5">
                    <label for="min">@lang('front.minsalary') (AZN)</label>
                    <input type="number" name="min_salary" class="form-control" id="min" placeholder="@lang('front.minsalary')" value="{{$vacancy->min_salary}}" @if($vacancy->salary_type != '0') @endif />
                </div>
                <div class="form-group company-announce-input-group col-md-5">
                    <label for="max">@lang('front.maxsal') (AZN)</label>
                    <input type="number" name="max_salary" class="form-control" id="max" placeholder="@lang('front.maxsal')" value="{{$vacancy->max_salary}}" @if($vacancy->salary_type != '0') @endif />
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-end mb-3">
                    <label for="musahibe" class="musahibe-check-label">@lang('front.musahibe')</label>
                    <input type="checkbox" class="musahibe-check-input" id="musahibe" name="salary_type" @if($vacancy->salary_type == '1') checked @endif> 
                </div>
                
                <div class="form-group company-announce-input-group col-md-3">
                    <label for="education">@lang('front.educ')</label>
                    <select name="education" class="form-control" id="education" required>
                        <option value="" selected disabled>@lang('front.tehsilsec')...</option>
                        @foreach($educations as $education)
                            <option value="{{$education->id}}" @if($vacancy->education_id == $education->id) selected @endif>
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
                <div class="form-group company-announce-input-group col-md-3">
                    <label for="age_min">@lang('front.minyas')</label>
                    <input type="number" name="min_age" class="form-control" id="age_min" placeholder="@lang('front.minyas'):" value="{{$vacancy->min_age}}"/>
                </div>
                <div class="form-group company-announce-input-group col-md-3">
                    <label for="age_max">@lang('front.maxyas')</label>
                    <input type="number" name="max_age" class="form-control" id="age_max" placeholder="@lang('front.maxyas'):" value="{{$vacancy->max_age}}"/>
                </div>
                <div class="form-group company-announce-input-group col-md-3">
                    <label for="work_exprience">@lang('front.exp')</label>
                    <select name="experience" class="form-control" id="work_exprience" required>
                        <option value="" selected disabled>@lang('front.expsec')...</option>
                        @foreach($experiences as $experience)
                            <option value="{{$experience->id}}" @if($vacancy->experience_id == $experience->id) selected @endif>
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
                <div class="form-group company-announce-input-group col-12">
                    <label for="demands">@lang('front.namteleb')</label>
                    <textarea class="form-control" name="requirements" id="demands" rows="5" placeholder="@lang('front.melumatver')!" required>
                        {!! $vacancy->requirement !!}</textarea>
                </div>
                <div class="form-group company-announce-input-group col-12">
                    <label for="about_work">@lang('front.ismelumat')</label>
                    <textarea class="form-control" name="description" id="about_work" rows="5" placeholder="@lang('front.melumatver')!" required>
                        {!! $vacancy->description !!}</textarea>
                </div>
                <div class="form-group company-announce-input-group col-6">
                    <label for="companies">@lang('front.companies')</label>
                    <select class="form-control" id="companies" name="company" required>
                        <option value="" selected disabled>@lang('front.birsec')...</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}" @if($vacancy->company_id == $company->id) selected @endif>{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group company-announce-input-group col-6 pl-3">
                    <label for="responsible_person">@lang('front.elaqesexs')</label>
                    <input type="text" class="form-control" name="contact_name" id="responsible_person" placeholder="@lang('front.adsoyad')" value="{{$vacancy->contact_name}}"/>
                </div>
                <div class="form-group company-announce-input-group col-12">
                    <label for="accept_cv">@lang('front.cvqebull')</label>
                    <select name="accept_type" class="form-control" id="accept_cv" onchange="getContact(this.value)">
                      <option selected disabled>@lang('front.birsec')...</option>
                      @foreach($types as $key=>$type)
                        <option value="{{$key}}" @if($key == $vacancy->accept_type) selected @endif>
                            @if ($lang == 'EN')
                                        {{$type->title_en}}
                                    @elseif ($lang == 'RU')
                                        {{$type->title_ru}}
                                    @elseif ($lang == 'TR')
                                        {{$type->title_tr}}
                                    @else
                                        {{$type->title_az}}
                                    @endif</option>
                    @endforeach
                    </select>
                </div>
                
                <div class="col-lg-12 mb-4" id="type_link" style="@if($vacancy->accept_type == '0') display:none; @endif">
                    <label for="contact_link" class="form-label">@lang('front.contactlink') <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="contact_link" name="contact_link" placeholder="@lang('front.contactlink'):" value="@if($vacancy->accept_type == '2') {{$vacancy->contact_info}} @endif">
                </div>
                <div class="col-lg-12 mb-4" id="type_email" style="@if($vacancy->accept_type == '2') display:none; @endif;">
                    <label for="contact_email" class="form-label">@lang('front.conmail') <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="contact_email" name="contact_email" placeholder="@lang('front.conmail'):" value="@if($vacancy->accept_type == '0') {{$vacancy->contact_info}} @endif">
                </div>



                <div class="form-group company-announce-input-group col-12">
                    <label for="end_date">@lang('front.deadline')</label>
                    <input type="date" name="deadline" class="form-control" id="end_date" value="{{$vacancy->deadline}}" required />
                </div>
                <div class="d-flex justify-content-end edit-announce-buttons col-12 my-4">
                    <button class="save-announce" type="submit">@lang('front.elaveet')</button>
                </div>
            </form>
        </div>
    </section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<script>
        
        $(document).ready(function() {
    var acceptType = $('#accept_cv').val();
    
    getContact(acceptType);
    
    $('#accept_cv').on('change', function() {
      var selectedType = $(this).val();
      
      getContact(selectedType);
    });
  });
  function getContact(id) {
    if (id == 1) {
        $('#type_email').slideUp();
        $('#type_link').slideUp();
    } else if (id == 0) {
        $('#type_email').slideDown();
        $('#type_link').slideUp();
    } else if (id == 2) {
        $('#type_email').slideUp();
        $('#type_link').slideDown();
    } else {
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


@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/jobsearch.css')}}">
<link rel="stylesheet" href="{{asset('front/css/companies-announces.css')}}">
@endsection

