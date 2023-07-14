@extends('back.layouts.master')

@section('title','1is | Banner')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Banner</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas səhifə</a></li>
                        <li class="breadcrumb-item active">Banner</li>
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
                    <h4 class="card-title mb-4">Banner (Şəkil)</h4>
                    @if(session('empty_logo'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            Banner şəkil boş buraxıla bilməz!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{route('bannerImagePost')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <p class="text-center">Cari şəkil: </p>
                            <div class="col-lg-12 d-flex justify-content-center" >
                                <img src="{{asset($banner->image)}}" alt="Logo" width="300px" height="150px">
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

