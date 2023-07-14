@extends('back.layouts.master')

@section('title','1is | Məlumat dəyişilmələri | Şirkətlər')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Məlumat dəyişilmələri</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Məlumat dəyişilmələri</li>
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
                    <h4 class="card-title mb-4">Məlumat dəyişilmələri</h4>
                    @include('back.layouts.messages')
                    <form action="{{route('companiesDataPost')}}" method="POST" id="addTraining" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-12 mb-4">
                                <label for="request-company" class="form-label">Əvvəlki Şirkət  <span class="text-danger">*</span></label>
                                <select name="request_company" id="request-company" class="form-control ">
                                    <option value="0" selected disabled>Əvvəlki Şirkət seçin...</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}} - {{ $company->getUser() ? $company->getUser()->name : ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="accept-company" class="form-label">Yeni Şirkət  <span class="text-danger">*</span></label>
                                <select name="accept_company" id="accept-company" class="form-control ">
                                    <option value="0" selected disabled>Yeni Şirkət seçin...</option>
                                    @foreach($companies as $company)
                                    <option value="{{$company->id}}">{{$company->name}} - {{ $company->getUser() ? $company->getUser()->name : ''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-end" >
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary">Dəyiş</button>
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
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#request-company').select2();
            $('#accept-company').select2();
        });
    </script>


@endsection


