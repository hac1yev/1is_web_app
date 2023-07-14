@extends('back.layouts.master')

@section('title','1is | Cv-lər | Cv Əlavə et')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cv əlavə et</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Cv əlavə et</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cv əlavə et</h4>
                    @include('back.layouts.messages')
                    <form action="{{route('vacanciesAddPost')}}" method="POST" class="outer-repeater" id="addTraining" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-6 mb-4">
                                <label for="category" class="form-label"> Kateqoriya  <span class="text-danger">*</span></label>
                                <select name="category" id="category" class="form-control">
                                    <option value="0" selected disabled>Kateqoriya seçin...</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="city" class="form-label"> Şəhər  <span class="text-danger">*</span></label>
                                <select name="city" id="city" class="form-control mb-4" onchange="getRegion(this.value)">
                                    <option value="0" selected disabled>Şəhər seçin...</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="jobtype" class="form-label"> İş rejimi  <span class="text-danger">*</span></label>
                                <select name="jobtype" id="jobtype" class="form-control" >
                                    <option value="0" selected disabled>İş rejimi seçin...</option>
                                    @foreach($jobtypes as $jobtype)
                                        <option value="{{$jobtype->id}}">{{$jobtype->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="jobtype" class="form-label"> Cins  <span class="text-danger">*</span></label>
                                <select name="jobtype" id="jobtype" class="form-control" >
                                    <option value="0" selected disabled>Cins seçin...</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}">{{$gender->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mb-4" id="type_region" style="display: none">
                                <label for="region" class="form-label d-block"> Bakı rayonları  <span class="text-danger">*</span></label>
                                <select name="region" id="region" class="form-control mb-4">
                                    <option value="0" selected disabled>Bakı rayonu...</option>
                                    @foreach($regions as $region)
                                        <option value="{{$region->id}}">{{$region->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="experience" class="form-label"> Təcrübə  <span class="text-danger">*</span></label>
                                <select name="experience" id="experience" class="form-control">
                                    <option value="0" selected disabled>Təcrübə seçin...</option>
                                    @foreach($experiences as $experience)
                                        <option value="{{$experience->id}}">{{$experience->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="education" class="form-label"> Təhsil  <span class="text-danger">*</span></label>
                                <select name="education" id="education" class="form-control">
                                    <option value="0" selected disabled>Təhsil seçin...</option>
                                    @foreach($educations as $education)
                                        <option value="{{$education->id}}">{{$education->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="education" class="form-label"> Cins  <span class="text-danger">*</span></label>
                                <select name="education" id="education" class="form-control">
                                    <option value="0" selected disabled>Cins seçin...</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}">{{$gender->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6 mb-4">
                                <label for="name" class="form-label">Ad <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Ad daxil edin:" value="{{old('name')}}">
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="surname" class="form-label">Soyad <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="surname" name="surname" placeholder="Soyad daxil edin:" value="{{old('surname')}}">
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="father_name" class="form-label">Ata adı <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="father_name" name="father_name" placeholder="Ata adı daxil edin:" value="{{old('father_name')}}">
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="Email daxil edin:" value="{{old('email')}}">
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label for="title" class="form-label">Vəzifə <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="title" name="title" placeholder="Vəzifə daxil edin:" value="{{old('title')}}">
                            </div>
                            <div class="col-lg-3 mb-4">
                                <label for="salary" class="form-label">Maaş <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="salary" name="salary" placeholder="Maaş daxil edin:" value="{{old('salary')}}">
                            </div>
                            <div class="col-lg-3">
                                <label for="birth" class="form-label">Doğum tarixi <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="birth"  name="birth" placeholder="Doğum tarixi daxil edin:" value="{{old('birth')}}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 mb-4">
                                <label for="about_education" class="form-label">Təhsil haqqında <span class="text-danger">*</span></label>
                                <textarea name="about_education" id="about_education" cols="30" rows="5" class="editor" placeholder="Təhsil haqqında məlumat daxil edin:">{{old('about_education')}}</textarea>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="work_experience" class="form-label">İş təcrübəsi <span class="text-danger">*</span></label>
                                <textarea name="work_experience" id="work_experience" cols="30" rows="5" class="editor" placeholder="İş təcrübəsi barədə məlumat məlumat daxil edin:">{{old('work_experience')}}</textarea>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="skills" class="form-label">Sertifikatlar və fəaliyyətlər <span class="text-danger">*</span></label>
                                <textarea name="skills" id="skills" cols="30" rows="5" class="editor" placeholder="Sertifikatlar və fəaliyyətlər barədə məlumat məlumat daxil edin:">{{old('skills')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 mb-4" id="type_link">
                                <label for="contact_phone" class="form-label">Əlaqə telefonu <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="contact_phone" name="contact_phone" placeholder="Əlaqə telefonu daxil edin:" value="{{old('contact_phone')}}">
                            </div>
                            <div class="col-lg-12 mb-4" id="type_email" >
                                <label for="contact_email" class="form-label">Əlaqə maili <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="contact_email" name="contact_email" placeholder="Əlaqə maili daxil edin:" value="{{old('contact_email')}}">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="image" class="form-label">Şəkil seçin... <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="cv" class="form-label">Cv seçin... <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="cv" name="cv">
                            </div>
                            <div class="col-12 mb-4" data-repeater-list="group-a">
                                <label for="" class="form-label">Portfolio</label>
                                <div class="row" data-repeater-item>
                                    <div class="col-lg-3 mb-2">
                                        <label for="work_name">İşin adı</label>
                                        <input type="text" id="work_name" name="work_name" class="form-control" placeholder="İşin adı daxil edin">
                                    </div>
                                    <div class="col-lg-3 mb-2">
                                        <label for="work_company">Şirkət adı</label>
                                        <input type="text" id="work_company" name="work_company" class="form-control" placeholder="Şirkət adı daxil edin">
                                    </div>
                                    <div class="col-lg-3 mb-2">
                                        <label for="work_link">Şirkət linki</label>
                                        <input type="text" id="work_link" name="work_link" class="form-control" placeholder="Şirkət linki daxil edin">
                                    </div>

                                    <div class="col-lg-3 mt-4 mb-2 align-self-center">
                                        <div class="d-grid">
                                            <input data-repeater-delete="" type="button" class="btn btn-primary" value="Sil">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input data-repeater-create="" type="button" style="width: 20%;" class="text-center btn btn-success mt-3 mt-lg-0" value="Portfolio əlavə et">
                        </div>
                        <div class="row justify-content-end" >
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary">Əlavə et</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>

        /* For other boilerplate styles, see: /docs/general-configuration-guide/boilerplate-content-css/ */
        /*
        * For rendering images inserted using the image plugin.
        * Includes image captions using the HTML5 figure element.
        */

        figure.image {
            display: inline-block;
            border: 1px solid gray;
            margin: 0 2px 0 1px;
            background: #f5f2f0;
        }

        figure.align-left {
            float: left;
        }

        figure.align-right {
            float: right;
        }

        figure.image img {
            margin: 8px 8px 0 8px;
        }

        figure.image figcaption {
            margin: 6px 8px 6px 8px;
            text-align: center;
        }


        /*
         Alignment using classes rather than inline styles
         check out the "formats" option
        */

        img.align-left {
            float: left;
        }

        img.align-right {
            float: right;
        }

        /* Basic styles for Table of Contents plugin (toc) */
        .mce-toc {
            border: 1px solid gray;
        }

        .mce-toc h2 {
            margin: 4px;
        }

        .mce-toc li {
            list-style-type: none;
        }
        .tox-mbtn__select-label{
            color: white !important;
        }

    </style>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/z18njsd2wp7b71bq9pvmfw9g8jmaaa2nog8tj87p4jdnkmk1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- form repeater js -->
    <script src="{{asset('back/assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

    <script src="{{asset('back/assets/js/pages/form-repeater.int.js')}}"></script>
    <script>
        const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

        tinymce.init({
            selector: 'textarea.editor',
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
            height: 600,
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
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#companies').select2();
            $('#category').select2();

            $('#city').select2();
        });
        function getContact(id){
            if(id == 0 || id == 1){
                $('#type_email').slideDown()
                $('#type_link').slideUp()
            }else{
                $('#type_link').slideDown()
                $('#type_email').slideUp()
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


@endsection


