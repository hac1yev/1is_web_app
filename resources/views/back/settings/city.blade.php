@extends('back.layouts.master')
@section('title','1is | Şəhərlər')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Şəhərlər</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Ana səhifə</a></li>
                        <li class="breadcrumb-item active">Şəhərlər</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        @include('back.layouts.messages')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 d-flex justify-content-end mb-4">
                        <button class="btn btn-success" onclick="addCity()">Şəhər əlavə et</button>
                    </div>
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Başlıq</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cities as $key=>$city)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$city->title_az}}</td>
                                <td>{{$city->slug}}</td>
                                <td>
                                    <p class="d-none">{{$city->status == 1 ? "Active" : "Deactive"}}</p>
                                    <input type="checkbox" id="switch{{$city->id}}" switch="none" {{$city->status == 1 ? "checked" : ""}} onchange="changeStatus({{$city->id}})" />
                                    <label for="switch{{$city->id}}" data-on-label="On" data-off-label="Off"></label>
                                </td>
                                <td>
                                    <button class="btn btn-outline-warning" onclick="getCity({{$city->id}})"><i class="bx bxs-edit"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- sample modal content -->
    <div class="modal fade" id="getCity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('settingsCitiesPost')}}" method="POST" class="modal-dialog">
            @csrf
            <div class="modal-content">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sektor Redaktə<span id="get_name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            @foreach($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{$language->id == '1' ? 'active' : ''}}" data-bs-toggle="tab" href="#{{$language->shortname}}" role="tab">
                                        <span class="d-block d-sm-none">{{$language->fullname}}</span>
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
                                            <label for="title_{{$language->shortname}}" class="form-label"> Başlıq ({{$language->shortname}})</label>
                                            <input type="text" class="form-control" id="title_{{$language->shortname}}" name="title_{{$language->shortname}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                    <button type="submit" class="btn btn-success">Təsdiqlə</button>
                </div>
            </div>
        </form>
    </div>
    <!-- sample modal content -->
    <div class="modal fade" id="addCity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('settingsCitiesAdd')}}" method="POST" class="modal-dialog">
            @csrf
            <div class="modal-content">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Şəhər Əlavə<span id="get_name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            @foreach($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{$language->id == '1' ? 'active' : ''}}" data-bs-toggle="tab" href="#add_{{$language->shortname}}" role="tab">
                                        <span class="d-block d-sm-none">{{$language->fullname}}</span>
                                        <span class="d-none d-sm-block">{{$language->fullname}}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            @foreach($languages as $language)
                                <div class="tab-pane {{$language->id == '1' ? 'active' : ''}}" id="add_{{$language->shortname}}" role="tabpanel">
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <label for="title_{{$language->shortname}}" class="form-label"> Başlıq ({{$language->shortname}})</label>
                                            <input type="text" class="form-control" id="title_{{$language->shortname}}" name="title_{{$language->shortname}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                    <button type="submit" class="btn btn-success">Təsdiqlə</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('css')

    <!-- DataTables -->
    <link href="{{asset('back/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('back/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('back/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="{{asset('back/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('js')

    <!-- Required datatable js -->
    <script src="{{asset('back/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('back/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('back/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{asset('back/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('back/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('back/assets/js/pages/datatables.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('back/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Sweet alert init js-->
    <script src="{{asset('back/assets/js/pages/sweet-alerts.init.js')}}"></script>

    <script>
        const addCity = () => {
            $('#addCity').modal('show');
        }

        const getCity = (id) => {
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: "/admin/settings/cities/edit",
                data: {
                    _token: CSRF_TOKEN,
                    id,
                },
                success: function (data) {
                    if(data != 0){

                        document.getElementById("edit_id").value = data.id;
                        document.getElementById("title_az").value = data.title_az;
                        document.getElementById("title_en").value = data.title_en;
                        document.getElementById("title_ru").value = data.title_ru;
                        document.getElementById("title_tr").value = data.title_tr;

                        $('#getCity').modal('show');
                    }else{
                        Swal.fire({
                            title: "Ooops",
                            text: "Gözlənilməyən xəta baş verdi!",
                            icon: "error"
                        })
                    }
                },
                error: function () {
                    Swal.fire({
                        title: "Ooops",
                        text: "Gözlənilməyən xəta baş verdi!",
                        icon: "error"
                    })
                }
            })
        }

        const changeStatus = (id) => {

            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "/admin/cities/status",
                data: {
                    _token: CSRF_TOKEN,
                    id,
                },
                success: function (data) {
                    if(data == 1){
                        Swal.fire({
                            title: "Uğurlu!",
                            text: "Status uğurla dəyişdirildi!",
                            icon: "success"
                        })
                        setTimeout(()=>{
                            location.reload();
                        },1500)
                    }else{
                        Swal.fire({
                            title: "Ooops",
                            text: "Gözlənilməyən xəta baş verdi!",
                            icon: "error"
                        })
                    }
                },
                error: function () {
                    Swal.fire({
                        title: "Ooops",
                        text: "Gözlənilməyən xəta baş verdi!",
                        icon: "error"
                    })
                }
            })
        }
    </script>

@endsection


