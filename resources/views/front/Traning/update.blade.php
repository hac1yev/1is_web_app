<!DOCTYPE html>

@extends('front.layouts.master')


@section('content')
@foreach ($banner as $ban)

<section class="header-info" style="background-image:linear-gradient(0deg, rgba(4, 15, 15, 0.6), rgba(32, 34, 80, 0.6)),
      url({{asset($ban->image)}})">
      @endforeach
      
        <div class="header-links-div">
            <a class="header-links" href="{{route('profile')}}">
                Ümumi
             </a>
             <a class="header-links" href="{{route('traningcreate')}}">
                 Təlimlər
             </a>
             <a class="header-links" href="{{route('cvindex')}}">
                 İş Axtaran
             </a>
             <a class="header-links" href="{{route('announcesindex')}}">
                 İşə Götürən
             </a>
        </div>
    </section>

    <section class="add-training">
        <div class="container add-training-container">
            <div class="row">   
                <form action="{{route('trainingEditPost')}}" method="POST" enctype="multipart/form-data" class="tab-pane add-training-form fade show active col-12" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    @csrf
                    <input type="hidden" name="id" value="{{$training->id}}">
                    <div class="form-group add-training-input-group">                            
                        <img src="{{asset($training->image)}}" alt="" width="200" height="200">

                        <label for="images">Şəkil əlavə et</label>

                        <div class="custom-file training-custom-file edit-training-input-group @error('image') has-error @enderror ">
                            <input type="file" class="custom-file-input js-custom-file-input-enabled" data-toggle="custom-file-input" id="images" name="image" value="{{$training->image}}" accept="image/png, image/jpeg, image/svg+xml, image/webp">
                            <label class="custom-file-label" for="image">Şəkil seçin</label>   
                            @error('image')
                        <span class="text-danger" style="font-size: 14x">@lang('validation.image_max')</span>
                        @enderror                   

                        </div>
                    </div>
                    <div class="form-group add-training-input-group @error('title') has-error @enderror">
                        <label for="training_name">Təlim adı</label>
                        <input type="text" class="form-control" id="training_name" name="title" placeholder="Təlimin adını qeyd edin" value="{{$training->title}}" required />
                        
                    </div>
                    <div class="form-group add-training-input-group @error('deadline') has-error @enderror">
                        <label for="training_date">Son müraciət tarixi</label>
                        <input type="date" class="form-control" name="deadline" id="training_date" value="{{$training->deadline}}" required />
                        
                    </div>
                    <div class="form-group add-training-input-group @error('about') has-error @enderror">
                        <label for="training_information">Təlim haqqında ətraflı məlumat</label>
                        <textarea class="form-control" id="training_information" name="about" rows="5" required>{!! html_entity_decode($training->about) !!}</textarea>
                        
                    </div>
                    <div class="form-group add-training-input-group @error('company') has-error @enderror">
                        <label for="training_companies">Şirkətlər</label>
                        <select class="form-control" id="training_companies" name="company">
                            <option selected disabled>Şirkət seçin...</option>
                            @foreach($companies as $company)
                            <option value="{{$company->id}}" @if($company->id == $training->company_id) selected @endif>{{$company->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group add-training-input-group @error('link') has-error @enderror">
                        <label for="training_url">Yönləndirmə qeydiyyat linki</label>
                        <input type="url" placeholder="Url daxil edin" name="link" class="form-control" id="training_url" value="{{$training->redirect_link}}" required />
                        
                    </div>
                    <div class="form-group add-training-input-group @error('payment_type') has-error @enderror">
                        <label for="training_payment">Ödəniş tipi</label>
                        <select name="payment_type" id="payment_type" class="form-control" onchange="getPayment(this.value)" required>
                            <option disabled selected>Ödeniş methodunu seçin...</option>
                            <option value="0" @if($training->payment_type == '0') selected @endif>Ödənişsiz</option>
                            <option value="1" @if($training->payment_type == '1') selected @endif>Ödənişli</option>
                        </select>
                        @error('payment_type')
                        <span class="text-danger" style="font-size: 14x">@lang('validation.payment_type_numeric')</span>
                        @enderror
                    </div>
                    <div class="form-group add-training-input-group">                    
                        <div class="row mb-4" id="price" @if($training->payment_type == '0') style="display: none" @endif >

                        <label for="training_name">Qiymət</label>
                        <input class="form-control" type="number"  name="price" step="1" placeholder="Qiymət daxil edin:" value="{{$training->price}}">
                    </div>
                    
                    <div class="add-training-form-button">
                        <button type="submit">Yenilə</button>
                    </div>
                </form>
                
            </div>
        </div>
    </section>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        function getPayment(id){
            if(id == 1){
                $('#price').slideDown()
            }else{
                $('#price').slideUp()
            }
        }
    </script>
@endsection

<script src="https://cdn.tiny.cloud/1/fnxhgzthj2q2iqh3di27mlytx4bdj9wbroguqsoawsbwwfyn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

    tinymce.init({
        selector: '#training_information',
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



@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/add-training.css')}}">
<link rel="stylesheet" href="{{asset('front/css/header.css')}}">
@endsection

@section('js-link')
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
@endsection


