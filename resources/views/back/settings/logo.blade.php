@extends('back.layouts.master')

@section('title','1is | Tənzimləmələr | Logo və Favicon')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tənzimləmələr</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas səhifə</a></li>
                        <li class="breadcrumb-item active">Logo və Favicon</li>
                    </ol>
                </div>

            </div>
            @include('back.layouts.messages')
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Logo</h4>
                    @if(session('empty_logo'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            Logo boş buraxıla bilməz!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{route('settingsLogoPost')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <p class="text-center">Cari Logo: </p>
                            <div class="col-lg-12 d-flex justify-content-center" >
                                <img src="{{asset($settings->logo)}}" alt="Logo" width="250px" height="250px">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Şəkil seçin</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="file" name="image">
                            </div>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Favicon</h4>
                    @if(session('empty_favicon'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            Favicon boş buraxıla bilməz!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{route('settingsFaviconPost')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <p class="text-center">Cari Favicon: </p>
                            <div class="col-lg-12 d-flex justify-content-center" >
                                <img src="{{asset($settings->favicon)}}" alt="Favicon" width="50px" height="50px">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Şəkil seçin</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="file" name="image">
                            </div>
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

@section('js')
    <!-- Plugins js -->
    <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
@endsection
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

