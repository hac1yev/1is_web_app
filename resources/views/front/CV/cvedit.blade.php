<!DOCTYPE html>

@extends('front.layouts.master')


@section('content')
<style>

    .create-cv{
        margin-top: 50px;
    }

    #structure{
            align-items: flex-end;
        }

    #structure label{
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 17px;
        color: #020202;
    }

        #comp_linkk, #comp_namee, #job_namee, .silinmeli input{
        background: #FFFFFF;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        padding: 12px 14px!important;
    }

    .removeElement , .silinmeli button{
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

    .silinmeli{
        align-items: end;
        margin-bottom: 15px;
    }

    .silinmeli label{
        font-family: 'Montserrat';
        font-style: normal;
        font-weight: 600;
        font-size: 14px;
        line-height: 17px;
        color: #020202;
    }
</style>


@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
        @endforeach

    </section>
    <section class="create-cv" >
        <div class="container create-cv-container">
            <div class="row m-0">   
                
                <div class="tab-content col-lg-8 m-auto" id="v-pills-tabContent">
                    <form action="{{route('cveditPost')}}" method="POST" enctype="multipart/form-data" class="tab-pane row create-cv-form fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <input type="hidden" name="id" value="{{$cv->id}}">

                        @csrf
                        <h3 class="col-12"></h3>
                        <img src="{{asset($cv->image)}}" alt="" width="200" height="200">

                        <div class="form-group create-cv-input-group col-md-12  @error('image') has-error @enderror">
                            <label for="images">@lang('front.sekiladd')</label>
                            <div class="custom-file create-cv-custom-file">
                                <input type="file" name="image" class="custom-file-input js-custom-file-input-enabled" value="{{$cv->image}}" data-toggle="custom-file-input" id="images" accept="image/png, image/jpeg, image/svg+xml, image/webp">
                                <label class="custom-file-label add-image-label" for="image">@lang('front.elaveet')</label>
                            </div>
                            @error('image')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.image_max')</span>
                                @enderror
                        </div>

                        <div class="form-group create-cv-input-group col-md-6  @error('name') has-error @enderror">
                            <label for="name">@lang('front.ad')</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$cv->name}}" placeholder="@lang('front.addaxilet')" required />
                             
                        </div>
                        <div class="form-group create-cv-input-group col-md-6  @error('surname') has-error @enderror">
                            <label for="surName">@lang('front.soyad')</label>
                            <input type="text" name="surname" class="form-control" id="surName" value="{{$cv->surname}}" placeholder="@lang('front.soyaddaxil')" required />
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-6  @error('father_name') has-error @enderror">
                            <label for="fatherName">@lang('front.ata')</label>
                            <input type="text" name="father_name" class="form-control" id="fatherName" value="{{$cv->father_name}}" placeholder="@lang('front.atadaxilet')" required/>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-6  @error('email') has-error @enderror">
                            <label for="Email">@lang('front.epoct')</label>
                            <input type="email" name="email" class="form-control" id="Email" value="{{$cv->email}}" placeholder="@lang('front.emaildaxilet')" required />
                            @error('email')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.email_email')</span>
                                @enderror
                        </div>
                        <div class="form-group create-cv-input-group col-12  @error('position') has-error @enderror">
                            <label for="possession">@lang('front.vezife')</label>
                            <input type="text" class="form-control" name="position" value="{{$cv->position}}" id="possession" placeholder="@lang('front.vezifedaxilet')" required />
                            @error('position')
                            <span class="text-danger" style="font-size: 14x">@lang('validation.position_max')</span>
                            @enderror
                        </div>
                        <h3 class="col-12">@lang('front.gostericiler')</h3>
                        <div class="form-group create-cv-input-group col-md-4  @error('category') has-error @enderror">
                            <select class="form-control" name="category" id="cv_categories" >
                              <option disabled selected>@lang('front.cats')</option>
                              @php
                                $lang = config('app.locale');
                            @endphp
                              @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($cv->category_id == $category->id) selected @endif>
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
                        <div class="form-group create-cv-input-group col-md-4  @error('city') has-error @enderror">
                            <select class="form-control" name="city" id="city">
                              <option  disabled selected>@lang('front.city')</option>
                              @foreach($cities as $city)
                            <option value="{{$city->id}}" @if($cv->city_id == $city->id) selected @endif>
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
                        <div class="form-group create-cv-input-group col-md-4  @error('education') has-error @enderror">
                            <select class="form-control" name="education" id="education">
                                <option selected disabled>@lang('front.educ')...</option>
                                @foreach($educations as $education)
                                    <option value="{{$education->id}}" @if($cv->education_id == $education->id) selected @endif>
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
                        <div class="form-group create-cv-input-group col-md-4  @error('experience') has-error @enderror">
                            <select class="form-control" name="experience" id="exprience">
                                <option selected disabled>@lang('front.exp')...</option>
                                @foreach($experiences as $experience)
                            <option value="{{$experience->id}}" @if($cv->experience_id == $experience->id) selected @endif>
                                @if ($lang == 'EN')
                                    {{$experience->title_en}}
                                @elseif ($lang == 'RU')
                                    {{$experience->title_ru}}
                                @elseif ($lang == 'TR')
                                    {{$experience->title_tr}}
                                @else
                                    {{$experience->title_az}}
                                @endif</option>
                            @endforeach
                            
                            </select>
                        </div>
                        <div class="form-group create-cv-input-group col-md-4  @error('jobtype') has-error @enderror">
                            <select class="form-control" name="jobtype" id="work_graf">
                                <option selected disabled>@lang('front.jobtype')...</option>
                                @foreach($jobtypes as $key=>$type)
                                    <option value="{{$key}}" @if($key == $cv->accept_type) selected @endif>
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
                        </div>
                        <div class="form-group create-cv-input-group col-md-4  @error('salary') has-error @enderror">
                            <input type="number" class="form-control" name="salary" id="min-number" placeholder="@lang('front.minsalary')" value="{{$cv->salary}}"/>
                            
                        </div>
                        <h3 class="col-12">@lang('front.sexsi')</h3>
                        <div class="form-group create-cv-input-group col-md-4 @error('birth') has-error @enderror">
                            <label for="training_date">@lang('front.dogum')</label>
                            <input type="date" class="form-control" name="birth" value="{{$cv->birth_date}}" id="birth_date"/>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-md-4  @error('gender') has-error @enderror">
                            <label for="training_companies">@lang('front.cinssec')</label>
                            <select class="form-control" id="cins" name="gender">
                                <option selected disabled>@lang('front.cinssec')...</option>
                                @foreach($genders as $gender)
                                    <option value="{{$gender->id}}" @if($cv->gender_id == $gender->id) selected @endif>
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
                        
                        
                        <div class="form-group create-cv-input-group col-12 @error('about_education') has-error @enderror">
                            <label for="training_information">@lang('front.tehsilhaq')</label>
                            <textarea class="form-control" name="about_education" id="education_information" rows="5" placeholder="Məlumat verin!">
                                {{ htmlspecialchars_decode($cv->about_education) }}</textarea>
                               
                        </div>
                        <div class="form-group create-cv-input-group col-12 @error('work_experince') has-error @enderror">
                            <label for="training_information">@lang('front.techaq')</label>
                            <textarea class="form-control" name="work_experience" id="exprience_information" rows="5" placeholder="Məlumat verin!">
                                {{ htmlspecialchars_decode($cv->work_experience) }}
                            </textarea>
                            
                        </div>
                        <div class="form-group create-cv-input-group col-12 @error('skills') has-error @enderror">
                            <label for="training_information">@lang('front.serthaq')</label>
                            <textarea class="form-control" name="skills" id="certificate_information" rows="5" placeholder="Məlumat verin!">
                                {{ htmlspecialchars_decode($cv->skills) }}</textarea>
                                
                        </div>

                        
                            
                                <div class="container" data-repeater-list="group-a">
                                    <div id="repeater">
                                        <label for="" class="form-label">@lang('front.portfolio')</label> <br>
                                        <input type="button" id="createElement" class="btn btn-danger" value="İş Yeri Əlavə Et" />
                                        <div class='row' id="structure" style="display:none">
                                            <div class='col-lg-3'>
                                                <label for='first-name'>@lang('front.isinadi')</label> <br>
                                                <input type="text" name="work_name" id="job_namee" value="" class="form-control" placeholder="@lang('front.daxilet')" />
                                            </div>
                                            <div class='col-lg-3'>
                                                <br>
                                                <label for='first-name'> @lang('front.companies')</label> <br>
                                                <input type="text" name="work_company" id="comp_namee" value="" class="form-control" placeholder="@lang('front.daxilet')" />
                                            </div>
                                            <div class='col-lg-3'>
                                            <br>
                                                <label for='first-name'>@lang('front.link')</label> <br>
                                                <input type="url" name="work_link" id="comp_linkk" value="" class="form-control" placeholder="@lang('front.daxilet')" />
                                            </div>
                                        </div>
                                        <div id="containerElement"></div>   
                                    </div>
                                </div>

                            <div class="container" data-repeater-list="group-a">

                            @php
                                $portfolio = json_decode($cv->portfolio, true);
                                $itm = $portfolio['portfolio'];
                                
                                if (!$itm || !isset($itm[0]['job_name'])) {
                                    $itm = [['job_name' => '', 'company' => '', 'link' => '']];
                                }
                                
                                $count = count($itm);
                            @endphp


                                @for ($i = 0; $i < $count; $i++)
                                @php
                                    $job_name = isset($itm[$i]['job_name']) ? $itm[$i]['job_name'] : '';
                                    $company = isset($itm[$i]['company']) ? $itm[$i]['company'] : '';
                                    $link = isset($itm[$i]['link']) ? $itm[$i]['link'] : '';
                                    $rnd =  rand().time();
                                    $portId = "port_id_" . $rnd;
                                
                                @endphp

                                <div class='row silinmeli' id="{{ $portId }}">
                                    <div class='col-lg-3'>
                                        <label for='first-name'>@lang('front.isinadi')</label> <br>
                                        <input type="text" name="group[{{ $rnd }}][work_name]" value="{{ $job_name }}" class="form-control" placeholder="@lang('front.daxilet')" />
                                    </div>
                                    <div class='col-lg-3'>
                                        <br>
                                        <label for='first-name'> @lang('front.companies')</label> <br>
                                        <input type="text" name="group[{{ $rnd }}][work_company]" value="{{ $company }}" class="form-control" placeholder="@lang('front.daxilet')" />
                                    </div>
                                    <div class='col-lg-3'>
                                        <br>
                                        <label for='first-name'>@lang('front.link')</label> <br>
                                        <input type="text" name="group[{{ $rnd }}][work_link]" value="{{ $link }}" class="form-control" placeholder="@lang('front.daxilet')" />
                                    </div>
                                    <button onclick="deleteRow('{{ $portId }}')" type="button" class="delete-btn">SIL</button>
                                </div>

                                <script>
                                function deleteRow(portId) {
                                    var element = document.getElementById(portId);
                                    element.parentNode.removeChild(element);
                                }
                                </script>

                                @endfor
                                </div>


                                <script>
                                    function deleteElement(){
                                        const deleteDiv=document.querySelector(".silinmeli");
                                        deleteDiv.remove()

                                    }
                                                                            
                                </script>
                        
                        
                        <h3 class="col-12">@lang('front.contact')</h3>
                        <div class="form-group create-cv-input-group col-md-12  @error('contact_mail') has-error @enderror">
                            <label for="e_poçt">@lang('front.conmail')</label>
                            <input type="email" name="contact_mail" value="{{$cv->contact_mail}}" class="form-control" id="e_poçt" placeholder="@lang('front.emaildaxilet')"  />
                            @error('contact_email')
                            <span class="text-danger" style="font-size: 14x">@lang('validation.contact_mail_email')</span>
                            @enderror
                        </div>
                        <div class="form-group create-cv-input-group col-12  @error('contact_phone') has-error @enderror">
                            <label for="contact_number">@lang('front.contel')</label>
                            <input type="number" class="form-control" name="contact_phone" id="contact_number" value="{{$cv->contact_phone}}" placeholder="@lang('front.nomredaxilet')"  />
                           
                        </div>
                        
                        <div class="form-group create-cv-input-group col-12 @error('cv') has-error @enderror">
                            <label for="images2" class="add-cv-label">@lang('front.cv')</label>
                            <div class="custom-file add-cv-custom-file">cv
                                <input type="file" name="cv" value="" class="custom-file-input js-custom-file-input-enabled" accept="application/pdf,application/vnd.ms-excel" data-toggle="custom-file-input" id="images2">
                                <label class="custom-file-label" for="image">@lang('front.yalnizpng')</label>
                                @error('cv')
                                <span class="text-danger" style="font-size: 14x">@lang('validation.contact_mail_email')</span>
                                @enderror
                            </div>

                            <p>Cari CV: </p>
                            @php
                            $fileExtension = pathinfo($cv->cv, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif']))
                            <img src="{{ asset($cv->cv) }}" alt="Resim" width="50%" height="auto">
                        @else
                            <iframe src="{{ asset($cv->cv) }}" frameborder="0" width="50%" height="500px"></iframe>
                        @endif
                            </div>

                        <div class="create-cv-form-button">
                            <button type="submit">@lang('front.elaveet')</button>
                        </div>
                    </form>



                    
                   
                </div>
            </div>
        </div>
    </section>
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
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="{{asset('front/js/repeater.js')}}"></script>
@endsection

@section('js')
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