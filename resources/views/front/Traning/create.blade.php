<!DOCTYPE html>

@extends('front.layouts.master')

<style>
    .image-preview {
  width: 150px;
  height: 150px;
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

    <section class="add-training">
        <div class="container add-training-container">
            <div class="row">   
                <div class="nav flex-column nav-pills add-training-tabs col-md-6" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active trending-nav-link1" id="v-pills-home-tab" data-toggle="pill" href="#register_form" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <img id="training_icon1" src="{{asset('back/assets/images/icons/add-training-white.png')}}" alt="add-training-white" /> @lang('front.telimadd')
                    </a>
                    <a class="nav-link nav-link-2 trending-nav-link2" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <img id="training_icon2" src="{{asset('back/assets/images/icons/training-list-purple1.png')}}" alt="training-list-purple" /> @lang('front.telimlist')
                    </a>
                    
                </div>


                <form class="tab-pane add-training-form fade show active col-md-6" action="{{route('trainingAddPost')}}" method="POST" enctype="multipart/form-data" id="register_form" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        @csrf
                    <div class="form-group add-training-input-group">
                        <label for="training_name">@lang('front.tad') <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" id="training_name" placeholder="@lang('front.tad')" value="{{old('title')}}" />
                        
                    </div>
                    <div class="form-group add-training-input-group">
                        <label for="training_date">@lang('front.sonmur') <span class="text-danger">*</span></label>
                        <input type="date" name="deadline" class="form-control" id="training_date" value="{{old('deadline')}}"/>
                        
                    </div>
                    <div class="form-group add-training-input-group">
                        <label for="training_information">@lang('front.telhaq') <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="about" id="training_information" rows="5" placeholder="@lang('front.melumatver')!">{{old('about', isset($data) ? $data->about : '')}}</textarea>
                    </div>
                    
                    <div class="form-group add-training-input-group">
                        <label for="training_companies">@lang('front.companies') <span class="text-danger">*</span></label>
                        <select class="form-control" id="training_companies" name="company">
                            <option value="" disabled {{ old('company') ? '' : 'selected' }}>@lang('front.companies')</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                            @endforeach
                        </select>
                        
                        
                    </div>
                    <div class="form-group add-training-input-group">
                        <label for="training_url">@lang('front.yonlink') <span class="text-danger">*</span></label>
                        <input type="url" name="link" placeholder="@lang('front.urldaxilet')" class="form-control" id="training_url" value="{{old('link')}}" />
                        
                    </div>
                    <div class="form-group add-training-input-group">
                        <label for="training_payment">@lang('front.odenistip') <span class="text-danger">*</span></label>
                        <select name="payment_type" class="form-control" id="training_payment" onchange="getPayment(this.value)">
                            <option disabled selected>@lang('front.odenismetod')...</option>
                            <option value="0" {{ old('payment_type') == '0' ? 'selected' : '' }}>@lang('front.pulsuz')</option>
                            <option value="1" {{ old('payment_type') == '1' ? 'selected' : '' }}>@lang('front.pullu')</option>
                        </select>
                    </div>
                    
                    <div class="form-group add-training-input-group">
                        <div class="row mb-4" id="price" @if(old('payment_type') == '0' || !old('payment_type')) style="display: none" @endif>
                            <label for="training_name">Qiymət</label>
                            <input class="form-control" type="number" name="price" step="1" placeholder="Qiymət daxil edin:" value="{{ old('price') }}">
                        </div>
                    </div>
                    
                    <div class="form-group add-training-input-group">
                        <label for="images">@lang('front.sekiladd') <span class="text-danger">*</span></label>
                        <div class="custom-file training-custom-file">
                          <input type="file" class="custom-file-input js-custom-file-input-enabled" data-toggle="custom-file-input" id="images" name="image">
                          <label class="custom-file-label add-image-label" for="images">@lang('front.sekilsec')</label>
                        </div>
                        <div id="image-preview-container"></div>
                      </div>
                      
                      <script>
                        $("#images").change(function() {
                          var file = $(this)[0].files[0];
                          if (file) {
                            $(".add-image-label").text(file.name); // Seçilen dosyanın adını etikete ata
                            var reader = new FileReader();
                            reader.onload = function(e) {
                              var previewHtml = '<img src="' + e.target.result + '" alt="Image Preview" class="image-preview">';
                              $("#image-preview-container").html(previewHtml); // Seçilen resmi önizleme alanına ekle
                            }
                            reader.readAsDataURL(file);
                          } else {
                            $(".add-image-label").text("@lang('front.sekilsec')");
                            $("#image-preview-container").html(""); // Önizleme alanını temizle
                          }
                        });
                      </script>
                      
                    <div class="add-training-form-button">
                        <button type="submit">@lang('front.elaveet')</button>
                    </div>
                </form>

                
                <div class="tab-pane add-training-card-wrapper col-12 fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="row mt-4">
                        @foreach($trainings as $key=>$train)
                        <div class="col-md-4 mb-3">
                            <div class="add-training-card">
                                <div class="add-training-card-image">
                                    <img src="{{asset($train->image)}}" alt="training-list-avatar" />
                                </div>
                                <p>{{$train->title}}</p>
                                @if($train->price == NULL)
                                <span>@lang('front.pulsuz')</span>
                              @else
                              <span>{{$train->price}} AZN</span>
                              @endif
                                <a href="{{route('trainingsdetail', $train->id)}}" class="training-list-thin">@lang('front.readmore')</a>
                                <a href="{{route('traniningedit', $train->id)}}" class="training-list-edit">
                                    <img src="{{asset('back/assets/images/icons/training-list-message.png')}}" alt="training-list-edit" />
                                </a>
                                <img class="training-list-green" src="{{asset('back/assets/images/icons/training-list-green.png')}}" alt="training-list-green" />
                            </div>
                        </div>
                        @endforeach
                        
                        <div class="add-training-card-more-button">
                        </div>
                    </div>
                </div>
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

@section('css-link')
<link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('front/css/add-training.css')}}">
<link rel="stylesheet" href="{{asset('front/css/header.css')}}">
@endsection

@section('js-link')
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/slick.min.js')}}"></script>
<script src="{{asset('front/js/add-training.js')}}"></script>
@endsection

@section('js')
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





<script>
    $(document).ready(function() {
        var lang = "{{ app()->getLocale() }}"; // Dil seçimini al

        function getErrorMessage(field, lang) {
            var errorMessages = {
                required: {
                    'AZ': 'Bu sahə doldurulmalıdır!',
                    'EN': 'This field is required!',
                    'RU': 'Поле обязательно для заполнения!',
                    'TR': 'Bu alan zorunludur!'
                },
                
                minlength: {
                    'AZ': 'Bu sahə üçün minimum 9 simvol limiti keçilməlidir!',
                    'EN': 'Minimum 9 characters limit should not be exceeded for this field!',
                    'RU': 'Минимальное количество символов для этого поля - 9!',
                    'TR': 'Bu alanda en az 9 karakter sınırı aşılmamalıdır!'
                },
                maxFileSize: {
                    'AZ': 'Şəkil üçün maksimum fayl ölçüsü 5MB olmalıdır!',
                    'EN': 'The maximum file size for the image should be 5MB!',
                    'RU': 'Максимальный размер файла для изображения должен быть 5 МБ!',
                    'TR': 'Resim için maksimum dosya boyutu 5MB olmalıdır!'
                },
                accept: {
                    'AZ': 'Lütfen bir resim dosyası seçin!',
                    'EN': 'Please select an image file!',
                    'RU': 'Пожалуйста, выберите файл изображения!',
                    'TR': 'Lütfen bir resim dosyası seçin!'
                },

               
            };

            return errorMessages[field][lang] || errorMessages[field]['AZ']; 
        }

        $("#register_form").validate({
            onclick: false, // Tıklama yapıldığında hata mesajlarını gösterme
            
            rules: {
                title: {
                    required: true,
                },
                deadline: {
                    required: true,
                },
                about: {
                    required: true,
                },

                company: {
                    required: true,
                },

                link: {
                    required: true,
                },

                payment_type: {
                    required: true,
                },
                price: {
                    required: function(element) {
                        return $("#training_payment").val() === '1';
                    }
                },

                image: {
                    required: true,
                    accept: "image/*",
                    maxFileSize: {
                        "param": 5242880, 
                    }
                },
                


            },
            messages: {
                title: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                },

                deadline: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                },

                about: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                  
                },

                company: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                    
                },
                link: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                },
                payment_type: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                },

                price: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                },

                image: {
                    required: function() {
                        return getErrorMessage('required', lang);
                    },
                    
                },

                
                
            },
            submitHandler: function(form) {
                form.submit(); // Formu gönder
            },
            errorPlacement: function(error, element) {
    // Hata mesajlarını görüntülemek için gerekli işlemleri yapın
    error.insertAfter(element); // Hata mesajını alanın hemen altına yerleştirin
  }
        });

         // Sayfa yüklendiğinde ödeme tipine göre fiyat alanını göster/gizle
    var initialPaymentType = $("#training_payment").val();
    if (initialPaymentType === '1') {
        $('#price').slideDown();
    } else {
        $('#price').slideUp();
    }
    
    // Ödeme tipi değiştiğinde fiyat alanını güncelle
    $("#training_payment").change(function() {
        var paymentType = $(this).val();
        if (paymentType === '1') {
            $('#price').slideDown();
        } else {
            $('#price').slideUp();
        }
    });
    });

   
</script>
@endsection