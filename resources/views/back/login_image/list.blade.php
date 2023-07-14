@extends('back.layouts.master')
@section('title','1is | Giriş səhifəsi (Şəkil)')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Giriş səhifəsi (Şəkil)</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('adminIndex')}}">Ana səhifə</a></li>
                        <li class="breadcrumb-item active">Giriş səhifəsi (Şəkil)</li>
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
                        <button class="btn btn-success" onclick="addImage()">Giriş səhifəsi (Şəkil) əlavə et</button>
                    </div>
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Şəkil</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $key=>$image)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{asset($image->image)}}" alt="" style="width: 200px;height: 100px"></td>
                                <td>
                                    <p class="d-none">{{$image->status == 1 ? "Active" : "Deactive"}}</p>
                                    <input type="checkbox" id="switch{{$image->id}}" switch="none" {{$image->status == 1 ? "checked" : ""}} onchange="changeStatus({{$image->id}})" />
                                    <label for="switch{{$image->id}}" data-on-label="On" data-off-label="Off"></label>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger" onclick="deleteImage({{$image->id}})"><i class="bx bxs-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="addImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('imagePost')}}" method="POST" class="modal-dialog" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Giriş səhifəsi (Şəkil) əlavə et</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <label for="image" class="form-label">Şəkil seçin...</label>
                            <input class="form-control" type="file" id="image" name="image">
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
        const addImage = () => {
          $('#addImage').modal('show');
        }

        const changeStatus = (id) => {

            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                url: "/admin/login-images/status",
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
        const deleteImage = (id) => {
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
                        url: "/admin/login-images/delete",
                        data: {
                            _token: CSRF_TOKEN,
                            id,

                        },
                        success: function (data) {
                            if(data == 1){
                                Swal.fire({
                                    title: "Uğurlu!",
                                    text: "İstifaçi şərti uğurla silindi.",
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


