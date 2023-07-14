@extends('back.layouts.master')

@section('title','1is | Şirkətlər | Şirkət Əlavə et')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Şirkət əlavə et</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Şirkət əlavə et</li>
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
                    <h4 class="card-title mb-4">Şirkət əlavə et</h4>
                    @include('back.layouts.messages')
                    <form action="{{route('companiesAddPost')}}" method="POST" id="addCompanies" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="sector" class="form-label"> Sektor  <span class="text-danger">*</span></label>
                                <select name="sector" id="sector" class="form-control" required>
                                    <option value="" selected disabled>Sektor seçin...</option>
                                    @foreach($sectors as $sector)
                                        <option value="{{$sector->id}}">{{$sector->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="image" class="form-label">Şəkil seçin... <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/png, image/jpeg, image/svg+xml, image/webp" data-toggle="custom-file-input" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="name" class="form-label">Şirkət adı <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Şirkət adı daxil edin:" value="{{old('name')}}" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="about" class="form-label">Şirkət haqqında <span class="text-danger">*</span></label>
                                <textarea name="about" id="about" cols="30" rows="5" class="form-control" placeholder="Şirkət haqqında məlumat daxil edin:" required>{{old('about')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="hr" class="form-label">HR siyasəti</label>
                                <textarea name="hr" id="hr" cols="30" rows="5" class="form-control" placeholder="HR siyasəti haqqında daxil edin:">{{old('hr')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="address" class="form-label">Ünvan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="address" name="address" placeholder="Ünvan daxil edin:" value="{{old('address')}}" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="website" class="form-label">Vebsayt <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="website" name="website" placeholder="Vebsayt daxil edin:" value="{{old('website')}}" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="map" class="form-label">Xəritə <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="map" name="map" placeholder="Xəritə linki daxil edin:" value="{{old('map')}}" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                                    <input type="text" class="form-control" name="instagram" id="instagram" placeholder="İnstagram hesabı daxil edin:" value="{{old('instagram')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-facebook"></i></div>
                                    <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook hesabı daxil edin:" value="{{old('facebook')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-linkedin"></i></div>
                                    <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin hesabı daxil edin:" value="{{old('linkedin')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-twitter"></i></div>
                                    <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter hesabı daxil edin:" value="{{old('twitter')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end" >
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary">Əlavə et</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection


