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
<!-- data table start -->
<div class="col-md-12 col-12 mt-2">
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
                            <h4 class="header-title">Data Barang Yang Disusutkan</h4>
                        </div>
                        <div class="col-md-6 col-12">
                            <a href="{{ route('admin.barang.create')}}" 
                                class="btn btn-info float-right mb-3"><i class="ti-plus"> </i>
                                Tambah Tansaksi Kas / Bank</a>
                            <button class="btn btn-warning float-right mb-3 mr-2"><i class="ti-import"> </i>
                                Import Dari Pembelian</button>
                            <button onclick="$('#modal_import_pembelian').modal('show');" class="btn btn-success float-right mb-3 mr-2"><i class="ti-import"> </i>
                                Import Dari Penjualan Toko</button>
                            <button class="btn btn-primary float-right mb-3 mr-2"><i class="ti-filter"> </i>
                                Filter</button>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-striped align-middle text-left" width="100%">
                        <thead class="bg-light text-capitalize align-middle">
                            <tr>
                                <th rowspan="2">#</th>
                                <th colspan="3" class="text-center" style="width: 50%">Invoice</th>
                                <th rowspan="2" class="text-center">Pengguna</th>
                                <th colspan="2" class="text-center">Penyusutan</th>
                                <th rowspan="2">Keterangan</th>
                                <th rowspan="2" class="text-center">Action</th>
                            </tr>
                            <tr>
                                <th>Invoice</th>
                                <th>Item</th>
                                <th>Nominal</th>
                                <th>Umur</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <p class="font-italic mb-0">{{ date('d/m/Y', strtotime($item->tgl_beli)) }}</p>
                                    <strong>{{ $item->no_invoice }}</strong>
                                </td>
                                <td class="align-middle">{{ $item->nama }}</td>
                                <td class="text-right align-middle">{{ number_format($item->harga_total) }}</td>
                                <td class="align-middle">{{ $item->pengguna->nama }}</td>
                                <td class="align-middle">{{ $item->umur }}</td>
                                <td class="text-right align-middle">{{ number_format($item->biaya_penyusutan) }}</td>
                                <td class="align-middle">{{ $item->keterangan }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="edit_satuan({{ $item->id }})"
                                            class="btn btn-outline-warning btn-sm"><i class="ti-pencil"></i></button>
                                        <button type="submit" id="delete-button" class="btn btn-danger btn-sm"><i
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
@include('admin.barang.import-pembelian')
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
        table = $('#dataTable').DataTable();
    });

    function edit_satuan(id){
        $('#form_satuan')[0].reset();
        $('#satuan').text('');
        // set modal title
        $('#exampleModalLabel').text('Edit Satuan');
        $.ajax({
            url : "satuan/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="keterangan"]').val(data.keterangan);
                $('#modal_satuan').modal('show');
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                console.log(errorThrown);
            }
        })
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
</script>
@endsection