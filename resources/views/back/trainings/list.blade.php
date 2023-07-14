@extends('back.layouts.master')
@section('title','1is | Təlimlər')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Təlimlər</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Ana səhifə</a></li>
                        <li class="breadcrumb-item active">Təlimlər</li>
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
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Şirkət</th>
                            <th>Ad</th>
                            <th>Ödəniş</th>
                            <th>Baxış</th>
                            <th>Status</th>
                            <th>Tarix</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trainings as $key=>$training)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    @if ($training->getCompany())
                                        <a href="{{ route('companiesEdit', $training->getCompany()->id) }}" target="_blank">
                                            {{ $training->getCompany()->name }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{$training->title}}</td>
                                <td>@if($training->payment_type == '0') Ödənişsiz @else {{$training->price}} AZN @endif</td>
                                <td>{{$training->view}}</td>
                                <td>
                                    <p class="d-none">{{$training->status == 1 ? "Active" : "Deactive"}}</p>
                                    <input type="checkbox" id="switch{{$training->id}}" switch="none" {{$training->status == 1 ? "checked" : ""}} onchange="changeStatus({{$training->id}})" />
                                    <label for="switch{{$training->id}}" data-on-label="On" data-off-label="Off"></label>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($training->created_at)->format('j F, Y') }}</td>
                                <td>
                                    <a href="{{route('trainingEdit',$training->id)}}">
                                        <button class="btn btn-outline-warning"><i class="bx bxs-edit"></i></button>
                                    </a>
                                    <button class="btn btn-outline-danger" onclick="deleteCompanies({{$training->id}})"><i class="bx bxs-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

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

        const changeStatus = (id) => {

            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "/admin/trainings/status",
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

        const deleteCompanies = (id) => {
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: "Əminsiniz?",
                text: "Silinən məlumat geri qaytarılmır!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Bəli, sil!",
                cancelButtonText: "Xeyr, ləğv et!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if(t.value){
                    $.ajax({
                        type: "POST",
                        url: "/admin/trainings/delete",
                        data: {
                            _token: CSRF_TOKEN,
                            id,

                        },
                        success: function (data) {
                            if(data == 1){
                                Swal.fire({
                                    title: "Uğurlu!",
                                    text: "Təlim uğurla silindi.",
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


                }else{
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Silinmə ləğv edildi!",
                        icon: "error"
                    })
                }

            })

        }
    </script>

@endsection


