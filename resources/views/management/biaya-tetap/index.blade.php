@extends('layouts.pembelian')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <!-- data table start -->
        <div class="col-md-12 col-12 mt-4">
            <div class="row">
                <div class="col-md-12 col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-info">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <h4 class="header-title">Data Biaya Tetap</h4>
                                </div>
                                <div class="col-md-6 col-12">
                                    <button onclick="tambah_data()"
                                        class="btn btn-outline-info float-right mb-2"><i
                                            class="ti-plus"> </i>
                                        Tambah Data</button>
                                    <button onclick="filter_data()"
                                        class="btn btn-outline-success float-right mb-2 mr-2"><i
                                            class="ti-filter"> </i>
                                        Filter Data</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="dataTable" class="text-center" width="100%">
                                    <thead class="bg-light text-capitalize align-middle">
                                        <tr>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Nominal</th>
                                            <th colspan="2">Periode</th>
                                            <th colspan="2">Account</th>
                                            <th rowspan="2" class="text-center">Action</th>
                                        </tr>
                                        <tr>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $bt)
                                            <tr>
                                                <td class="text-left">{{ $bt->nama }}</td>
                                                <td class="text-right">{{ number_format($bt->nominal) }}</td>
                                                <td class="text-left">{{ date('d/m/Y', strtotime($bt->tgl)) }}</td>
                                                <td class="text-left">{{ date('d/m/Y', strtotime($bt->tgl_akhir)) }}</td>
                                                <td class="text-left">{{ $bt->account_debit->nama_account }}</td>
                                                <td class="text-left">{{ $bt->account_kredit->nama_account }}</td>
                                                <td class="text-center align-middle">
                                                    <button type="button" onclick="edit_data({{ $bt->id }})"
                                                        class="btn btn-info btn-xs"><i
                                                            class="ti-pencil"></i></button>
                                                    <form action="{{ route('management.biaya-tetap.destroy', $bt->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" id="delete-button"
                                                            class="btn btn-danger btn-xs"><i
                                                                class="ti-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
    @include('management.biaya-tetap.modal')
    @include('management.biaya-tetap.filter')
</div>
<!-- main content area end -->
@endsection

@section('js')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script src="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#dataTable').DataTable({
            responsive: true,
            order: false
        });
    });

    function tambah_data(){
        $('#modal').modal('show');
        $('#form')[0].reset();
        // set modal title
        $('#exampleModalLabel').text('Tambah Biaya Tetap');
    }

    function filter_data(){
        $('#modal-filter').modal('show');
    }

    function edit_data(id){
        $('#form')[0].reset();
        $.ajax({
        url : "/management/biaya-tetap/" + id + "/edit",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="tgl"]').val(data.tgl);
            $('[name="tgl_akhir"]').val(data.tgl_akhir);
            $('[name="nominal"]').val(data.nominal);
            $('[name="id_account_debit"]').selectpicker('val', data.id_account_debit);
            $('[name="id_account_kredit"]').selectpicker('val', data.id_account_kredit);
            $('#modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus , errorThrown) {
            alert(errorThrown);
            }
        });
    }

    // delete-button on click
    $(document).on('click', '#delete-button', function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

    // disable submit form
    $('#form').submit(function(){
        $('#btn-simpan').attr('disabled', 'true');
        $('#btn-simpan').html('<i class="fa fa-spin fa-spinner"></i> Menyimpan...');
    });
</script>
@endsection