@extends('back.layouts.master')

@section('title','1is | Şirkətlər | Şirkət Redaktə et')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Şirkət redaktə et</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Şirkət redaktə et</li>
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
                    <h4 class="card-title mb-4">Şirkət redaktə et  <p>Cari vakansiya sayı: {{count($company->getVacancy())}}</p></h4>
                    <div class="col-lg-12 text-center">
                        <p>Cari şəkil: </p>
                        <img src="{{asset($company->image)}}" alt="" width="200" height="200">
                    </div>
                    @include('back.layouts.messages')
                    <form action="{{route('companiesEditPost')}}" method="POST" id="editCompanies" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$company->id}}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="sector" class="form-label"> Sektor  <span class="text-danger">*</span></label>
                                <select name="sector" id="sector" class="form-control">
                                    <option value="0" selected disabled>Sektor seçin...</option>
                                    @foreach($sectors as $sector)
                                        <option value="{{$sector->id}}" @if($sector->id == $company->sector_id) selected @endif>{{$sector->title_az}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="image" class="form-label">Şəkil seçin...</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="name" class="form-label">Şirkət adı <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Şirkət adı daxil edin:" value="{{$company->name}}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="about" class="form-label">Şirkət haqqında <span class="text-danger">*</span></label>
                                <textarea name="about" id="about" cols="30" rows="5" class="form-control" placeholder="Şirkət haqqında məlumat daxil edin:">{{$company->about}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="hr" class="form-label">HR siyasəti</label>
                                <textarea name="hr" id="hr" cols="30" rows="5" class="form-control" placeholder="HR siyasəti haqqında daxil edin:">{{$company->hr}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="address" class="form-label">Ünvan <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="address" name="address" placeholder="Ünvan daxil edin:" value="{{$company->address}}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="website" class="form-label">Vebsayt <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="website" name="website" placeholder="Vebsayt daxil edin:" value="{{$company->website}}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="map" class="form-label">Xəritə <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="map" name="map" placeholder="Xəritə linki daxil edin:" value="{{$company->map}}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-instagram"></i></div>
                                    <input type="text" class="form-control" name="instagram" id="instagram" placeholder="İnstagram hesabı daxil edin:" value="{{$company->instagram}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-facebook"></i></div>
                                    <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook hesabı daxil edin:" value="{{$company->facebook}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-linkedin"></i></div>
                                    <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin hesabı daxil edin:" value="{{$company->linkedin}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fab fa-twitter"></i></div>
                                    <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter hesabı daxil edin:" value="{{$company->twitter}}">
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


