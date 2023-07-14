@extends('back.layouts.master')
@section('title','1is | Hesab')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Hesab</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Ana səhifə</a></li>
                        <li class="breadcrumb-item active">Hesab</li>
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
                    <h4 class="card-title mb-4">Admin Hesab</h4>
                    @include('back.layouts.messages')
                    <div class="row mb-4">
                        <div class="col-lg-12 text-center">
                            <h4 class="card-title mb-4">Cari şəkil</h4>
                            <img style="width: 150px;height: 150px;border-radius: 50%" src="{{asset($user->image)}}" alt="{{$user->name}}">
                        </div>
                    </div>
                    <form action="{{route('adminProfilePost')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Ad</label>
                            <div class="col-lg-10">
                                <input id="name" value="{{$user->name}}" name="name" type="text" class="form-control" placeholder="Ad daxil edin...">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="email" class="col-form-label col-lg-2">Email</label>
                            <div class="col-lg-10">
                                <input id="email" name="email" value="{{$user->email}}" type="text" class="form-control" placeholder="Email daxil edin..." disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-form-label col-lg-2">Şəkil</label>
                            <div class="col-lg-10">
                                <label for="image" class="form-label">Şəkil seçin...</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-lg-10">
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
    <!-- dropzone css -->
    <link href="{{asset('back/assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <!-- dropzone plugin -->
    <script src="{{asset('back/assets/libs/dropzone/min/dropzone.min.js')}}"></script>
@endsection
