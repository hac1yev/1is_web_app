@extends('back.layouts.master')

@section('title','1is | Tənzimləmələr | Əlaqə Məlumatları')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tənzimləmələr</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Əlaqə Məlumatları</li>
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
                    <h4 class="card-title mb-4">Əlaqə Məlumatları</h4>
                    @include('back.layouts.messages')

                    <form action="{{route('settingsContactPost')}}" method="POST">
                        @csrf

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
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-search-location"></i></div>
                                                <input type="text" class="form-control" name="address_{{$language->shortname}}" value="{{$data['address_'.$language->shortname]}}" id="autoSizingInputGroup" placeholder="Ünvan ({{$language->shortname}}) daxil edin:" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bx bx-envelope"></i></div>
                                    <input type="text" class="form-control" name="email" value="{{$data->email}}" id="autoSizingInputGroup" placeholder="Email daxil edin:" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fas fa-phone-square"></i></div>
                                    <input type="text" class="form-control" name="phone" value="{{$data->phone}}" id="autoSizingInputGroup" placeholder="Telefon daxil edin:" required>
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


