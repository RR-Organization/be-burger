@extends('layouts.base')
@section('content')
    <div id="loading-overlay" class="loading-overlay" style="display: none;">
        <div id="loading" class="loading">
            <img src="{{ asset('loading.gif') }}" alt="Loading..." />
        </div>
    </div>
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold ">Data Page</h6>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form id="formTambah" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="description">Deskripsi</label>
                    <input type="hidden" name="description" id="description">
                    <div id="summernote"></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        $(document).ready(function() {
            var isEditMode = false;
            // fungsi create and update
            $('#formTambah').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                var description = $('#summernote').summernote('code');
                formData.append('description', description);

                if (isEditMode) {
                    var id = $('#id').val();

                    $('#loading-overlay').show();

                    $.ajax({
                        type: "POST",
                        url: "{{ url('api/v1/4a3f479a-eb2e-498f-aa7b-e7d6e3f0c5f3/pendaftaran/update/') }}/" +
                            id,
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data);
                            $('#loading-overlay').hide();
                            if (data.message === 'check your validation') {
                                var error = data.errors;
                                var errorMessage = "";

                                $.each(error, function(key, value) {
                                    errorMessage += value[0] + "<br>";
                                });

                                Swal.fire({
                                    title: 'Error',
                                    html: errorMessage,
                                    icon: 'error',
                                    timer: 5000,
                                    showConfirmButton: true
                                });
                            } else {
                                console.log(data);
                                $('#loading-overlay').hide();
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Data Success Update',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(data) {
                            $('#loading-overlay').hide();
                            var errors = data.responseJSON.errors;
                            var errorMessage = "";

                            $.each(errors, function(key, value) {
                                errorMessage += value + "<br>";
                            });

                            Swal.fire({
                                title: "Error",
                                html: errorMessage,
                                icon: "error",
                                timer: 5000,
                                showConfirmButton: true
                            });
                        }
                    });
                } else {
                    $('#loading-overlay').show();
                    var description = $('#summernote').summernote('code');
                    formData.append('description', description);
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('api/page/create') }}',
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data)
                            $('#loading-overlay').hide();
                            if (data.message === 'Check your validation') {
                                var error = data.errors;
                                var errorMessage = "";

                                $.each(error, function(key, value) {
                                    errorMessage += value[0] + "<br>";
                                });

                                Swal.fire({
                                    title: 'Error',
                                    html: errorMessage,
                                    icon: 'error',
                                    timer: 5000,
                                    showConfirmButton: true
                                });
                            } else if (data.code == 400) {
                                var errorMessage = data.message;
                                Swal.fire({
                                    title: 'Error',
                                    html: errorMessage,
                                    icon: 'error',
                                    timer: 5000,
                                    showConfirmButton: true
                                });
                            } else {
                                console.log(data);
                                $('#loading-overlay').hide();
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Data Success Create',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK'
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(data) {
                            $('#loading-overlay').hide();

                            var error = data.responseJSON.errors;
                            var errorMessage = "";

                            $.each(error, function(key, value) {
                                errorMessage += value[0] + "<br>";
                            });

                            Swal.fire({
                                title: 'Error',
                                html: errorMessage,
                                icon: 'error',
                                timer: 5000,
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
