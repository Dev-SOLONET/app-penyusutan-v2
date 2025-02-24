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
<div class="container">
    <!-- Textual inputs start -->
    <div class="col-12 mt-5 mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Form Tambah Transaksi Kas / Bank</h4>
                <p class="text-muted font-italic font-14 mb-4">Transaksi yang dimasukan berasal dari kas / bank akan otomatis terintegrasi dengan pengeluaran di jurnal harian</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">No Invoice</label>
                            <input class="form-control" type="text" name="no_invoice" placeholder="Masukan no invoice">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Tanggal Invoice</label>
                            <input class="form-control" type="date" name="tgl_beli" placeholder="Masukan tanggal beli pada invoice">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-search-input" class="col-form-label">Item</label>
                    <textarea class="form-control" name="nama" placeholder="Masukan item yang dibeli / keterangan transaksi"></textarea>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="example-email-input" class="col-form-label">Nominal</label>
                            <input class="form-control" type="number" name="harga_total" placeholder="Masukan nominal transaksi">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Umur</label>
                            <input class="form-control" type="number" name="umur" placeholder="Masukan umur item yang akan disusutkan">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Penggunaan</label>
                            <select name="penggunaan" id="penggunaan" class="form-control" data-live-search="true">
                                <option value="all" selected>Semua</option>
                                @foreach ($penggunaan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="example-search-input" class="col-form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" placeholder="Opsional jika ada keterangan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')=
@endsection