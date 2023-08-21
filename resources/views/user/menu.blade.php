@extends('layouts.base')
@section('content')
    <div id="loading-overlay" class="loading-overlay" style="display: none;">
        <div id="loading" class="loading">
            <img src="{{ asset('loading.gif') }}" alt="Loading..." />
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Data Divisi</h6>
            <button type="button" class="btn btn-outline-primary ml-auto" data-toggle="modal"
                data-target="#PendaftaranModal" id="#myBtn">
                Tambah Data
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PendaftaranModal" tabindex="-1" role="dialog" aria-labelledby="PendaftaranModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PendaftaranModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambah" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row py-4">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <img src="" alt="" id="preview" class="mx-auto d-block pb-2"
                                        style="max-width: 200px; padding-top: 23px">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group fill">
                                    <label>Nama Menu</label>
                                    <input type="text" id="nama_menu" name="nama_menu" class="form-control"></input>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group fill">
                                    <label>Harga</label>
                                    <input type="number" id="harga" name="harga" class="form-control"></input>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                        <label class="custom-file-label" for="gambar" id="gambar-label">Image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" form="formTambah" class="btn btn-outline-primary">Submit Data</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function getDataMenu() {
                var dataTable = $("#dataTable").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                });
                $.ajax({
                    url: "{{ url('api/menu') }}",
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        var tableBody = "";
                        $.each(response.data, function(index, item) {
                            tableBody += "<tr>";
                            tableBody += "<td>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.nama_menu + "</td>";
                            tableBody += "<td>" + item.harga + "</td>";
                            tableBody += "<td><img src='/upload/Menu/" + item.gambar +
                                "' alt='" +
                                item.nama_menu +
                                "' class='img-thumbnail' style='width: 200px'></td>";
                            tableBody += "<td>" +
                                "<button type='button' class='btn btn-primary edit-modal' data-toggle='modal' data-target='#EditModal' " +
                                "data-uuid='" + item.uuid + "'>" +
                                "<i class='fa fa-edit'></i></button>" +
                                "<button type='button' class='btn btn-danger delete-confirm' data-uuid='" +
                                item.uuid + "'><i class='fa fa-trash'></i></button>" +
                                "</td>";
                            tableBody += "</tr>";
                        });
                        var table = $("#dataTable").DataTable();
                        table.clear().draw();
                        table.rows.add($(tableBody)).draw();
                    },
                    error: function() {
                        console.log("Failed to get data from server");
                    }
                });
            }
            getDataMenu();
        });
    </script>
@endsection
