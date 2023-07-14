@extends('back.layouts.master')

@section('title','1is | Şifrə dəyiş')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Şifrə dəyiş</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Ana səhifə</a></li>
                        <li class="breadcrumb-item active">Şifrə dəyiş</li>
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
                    <h4 class="card-title mb-4">Şifrə dəyiş</h4>
                    @include('back.layouts.messages')

                    <form action="{{route('adminProfilePasswordPost')}}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2"> Cari şifrə</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" placeholder="Cari şifrəni daxil edin..." name="current_pass" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2"> Yeni şifrə</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" required name="new_pass" placeholder="Yeni şifrəni daxil edin" />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2"> Yeni şifrə (Təkrar)</label>
                            <div class="mt-2 col-lg-10">
                                <input type="password" class="form-control" required data-parsley-equalto="#pass2" name="new_pass_reply" placeholder="Yeni şifrə təkrarən daxil edin" />
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

@section('js')
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
@endsection

