@extends('back.layouts.master')

@section('title','1is | Tənzimləmələr | Sosial Media')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tənzimləmələr</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Sosial Media</li>
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
                    <h4 class="card-title mb-4">Sosial Media</h4>
                    @include('back.layouts.messages')

                    <form action="{{route('settingsSocialPost')}}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-facebook-f"></i></div>
                                    <input type="text" class="form-control" name="facebook" value="{{$social->facebook}}" id="autoSizingInputGroup" placeholder="Email daxil edin:" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                                    <input type="text" class="form-control" name="instagram" value="{{$social->instagram}}" id="autoSizingInputGroup" placeholder="Telefon daxil edin:" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-linkedin-in"></i></div>
                                    <input type="text" class="form-control" name="linkedin" value="{{$social->linkedin}}" id="autoSizingInputGroup" placeholder="Telefon daxil edin:" required>
                                </div>
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


