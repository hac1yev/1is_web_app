@extends('back.layouts.master')

@section('title','1is | Şirkət şərhləri | Şərh redaktə et')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Şərh redaktə et</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Əsas Səhifə</a></li>
                        <li class="breadcrumb-item active">Şərh redaktə et</li>
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
                    <h4 class="card-title mb-4">Şərh redaktə et</h4>
                    @include('back.layouts.messages')
                    <form action="{{route('reviewPost')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$review->id}}">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="title" class="form-label">Ad <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{$review->fullname}}" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="title" class="form-label">Şirkət<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{ $review->getCompany() ? $review->getCompany()->name : '' }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="title" class="form-label">Reyting<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{ $review->getRating() ? $review->getRating()->rating : 0 }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="about" class="form-label">Şərh <span class="text-danger">*</span></label>
                                <textarea name="message" id="about" cols="30" rows="5" class="form-control">{!! $review->message !!}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <label for="title" class="form-label">Status<span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="1" @if($review->status == 1) selected @endif>Aktiv</option>
                                    <option value="0" @if($review->status == 0) selected @endif>Deaktiv</option>
                                </select>
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


