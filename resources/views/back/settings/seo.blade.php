@extends('back.layouts.master')

@section('title','1is | Tənzimləmələr | SEO')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tənzimləmələr</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">SEO</li>
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
                    <h4 class="card-title mb-4">SEO</h4>
                    @include('back.layouts.messages')

                    <form action="{{route('settingsSeoPost')}}" method="POST" id="seo">
                        @csrf
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            @foreach($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{$language->id == '1' ? 'active' : ''}}" data-bs-toggle="tab" href="#{{$language->shortname}}" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">{{$language->fullname}}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            @foreach($languages as $language)
                                <div class="tab-pane {{$language->id == '1' ? 'active' : ''}}" id="{{$language->shortname}}" role="tabpanel">
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <label for="meta_title_{{$language->shortname}}" class="form-label"> Başlıq {{$language->shortname}}</label>
                                            <input type="text" value="{{$settings['meta_title_'.$language->shortname]}}" name="meta_title_{{$language->shortname}}" class="form-control" id="title_{{$language->short_name}}" placeholder="Başlıq {{$language->short_name}} daxil edin">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <label for="meta_description_{{$language->shortname}}" class="form-label"> Qısa izah {{$language->shortname}}</label>
                                            <textarea type="text" name="meta_description_{{$language->shortname}}" class="form-control" id="meta_description_{{$language->shortname}}" placeholder="Qısa izah {{$language->short_name}} daxil edin">{{$settings['meta_description_'.$language->shortname]}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="tags" class="form-label">Açar sözlər ({{$language->shortname}}) <span class="text-danger">*</span></label>
                                        <div class="chips">
                                            <input name='meta_keywords_{{$language->shortname}}' value='{{$settings['meta_keywords_'.$language->shortname]}}' class="form-control" autofocus required>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row justify-content-end" >
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary">Yenilə</button>
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
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endsection
@section('js')
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script>
        // The DOM element you wish to replace with Tagify
        var inputaz = document.querySelector('input[name=meta_keywords_az]');
        var inputen = document.querySelector('input[name=meta_keywords_en]');
        var inputru = document.querySelector('input[name=meta_keywords_ru]');
        var inputtr = document.querySelector('input[name=meta_keywords_tr]');

        // initialize Tagify on the above input node reference
        new Tagify(inputaz)
        new Tagify(inputen)
        new Tagify(inputru)
        new Tagify(inputtr)
    </script>
    <script>
        $("#seo").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>
@endsection

