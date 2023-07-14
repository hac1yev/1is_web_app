@extends('back.layouts.master')

@section('title','1is | Bloglar | Blog Redaktə et')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Blog redaktə et</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Blog redaktə et</li>
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
                    <div class="col-lg-12 text-center">
                        <p>Cari şəkil: </p>
                        <img src="{{asset($blog->image)}}" alt="" style="width: 250px;height: 250px">
                    </div>
                    <h4 class="card-title mb-4">Blog redaktə et</h4>
                    @include('back.layouts.messages')

                    <form action="{{route('blogEditPost')}}" method="POST" id="editBlog" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$blog->id}}">
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
                                            <label for="title_{{$language->shortname}}" class="form-label"> Başlıq {{$language->shortname}} <span class="text-danger">*</span></label>
                                            <input type="text" value="{{$blog['title_'.$language->shortname]}}" name="title_{{$language->shortname}}" class="form-control" id="title_{{$language->short_name}}" placeholder="Başlıq {{$language->short_name}} daxil edin">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <label for="content_{{$language->shortname}}" class="form-label"> Məzmun {{$language->shortname}} <span class="text-danger">*</span></label>
                                            <textarea name="content_{{$language->shortname}}" id="content_{{$language->shortname}}" cols="30" rows="10" class="editor" >{!! $blog['content_'.$language->shortname] !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="tags" class="form-label">Açar sözlər ({{$language->shortname}}) <span class="text-danger">*</span></label>
                                        <div class="chips">
                                            <input name='keywords_{{$language->shortname}}' value='{{$blog['keywords_'.$language->shortname]}}' class="form-control" autofocus>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-4">
                            <label for="view" class="form-label">Baxış sayı:</label>
                                <input type="number" name='view' value='{{$blog->view}}' class="form-control" autofocus>

                            <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
                                <i class="mdi mdi-alert-outline me-2"></i>
                                Baxış sayında dəyişiklik edilən zaman diqqətli olun!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="image" class="form-label">Şəkil seçin...</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="row justify-content-end" >
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary">Redaktə et</button>
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
    <script src="{{asset('back/assets/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('back/assets/js/news_tinymce.js')}}"></script>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script>

        // The DOM element you wish to replace with Tagify
        var inputaz = document.querySelector('input[name=keywords_az]');
        var inputen = document.querySelector('input[name=keywords_en]');
        var inputru = document.querySelector('input[name=keywords_ru]');
        var inputtr = document.querySelector('input[name=keywords_tr]');

        // initialize Tagify on the above input node reference
        new Tagify(inputaz)
        new Tagify(inputen)
        new Tagify(inputru)
        new Tagify(inputtr)
    </script>
    <script>
        $("#editBlog").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>
@endsection


