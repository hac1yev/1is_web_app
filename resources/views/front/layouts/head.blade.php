<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if(app()->getLocale() == 'EN')
            {{ $setting->meta_title_en }}
        @elseif(app()->getLocale() == 'RU')
            {{ $setting->meta_title_ru }}
        @elseif(app()->getLocale() == 'TR')
            {{ $setting->meta_title_tr }}
        @else
            {{ $setting->meta_title_az }}
        @endif
    </title>
    
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/main-filter.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/dark.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    @yield('css-link')
    <!-- SEO TAGS -->
    <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon" />

    <meta name="website" content="https://www.1is.az" />

    <meta name="keywords" content="
    @php
        $locale = strtolower(app()->getLocale());

        $keywords = [];

        if ($locale == 'AZ') {
            $blogKeywords = DB::table('blogs')->pluck('keywords_az');
            $keywords = $blogKeywords->toArray();
        } else {
            $settingKeywords = $setting->{'meta_keywords_' . $locale};
            if ($settingKeywords) {
                $settingKeywords = json_decode($settingKeywords, true);
                $keywords = array_column($settingKeywords, 'value');
            }
        }

        $keywordStrings = implode(', ', $keywords);
        echo $keywordStrings;
    @endphp
">





    <meta name="description" content="
     @if(app()->getLocale() == 'EN')
    {{ $setting->meta_description_en }}
@elseif(app()->getLocale() == 'RU')
    {{ $setting->meta_description_ru }}
@elseif(app()->getLocale() == 'TR')
    {{ $setting->meta_description_tr }}
@else
    {{ $setting->meta_description_az }}
@endif " />

    <meta property="og:title" content="
    @if(app()->getLocale() == 'EN')
    {{ $setting->meta_title_en }}
@elseif(app()->getLocale() == 'RU')
    {{ $setting->meta_title_ru }}
@elseif(app()->getLocale() == 'TR')
    {{ $setting->meta_title_tr }}
@else
    {{ $setting->meta_title_az }}
@endif" />
    <meta property="og:description" content="
    @if(app()->getLocale() == 'EN')
        {{ $setting->meta_description_en }}
    @elseif(app()->getLocale() == 'RU')
        {{ $setting->meta_description_ru }}
    @elseif(app()->getLocale() == 'TR')
        {{ $setting->meta_description_tr }}
    @else
        {{ $setting->meta_description_az }}
    @endif " />


    <meta property="og:image" content="./images/1iş-logo.png" />
    <meta property="og:type" content="Website" />
    <meta property="og:url" content="https://1is.az/" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link 
    href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
    rel="stylesheet"  type='text/css'> 
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css"> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/4.0.0/jquery.validate.unobtrusive.min.js" integrity="sha512-xq+Vm8jC94ynOikewaQXMEkJIOBp7iArs3IhFWSWdRT3Pq8wFz46p+ZDFAR7kHnSFf+zUv52B3prRYnbDRdgog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>