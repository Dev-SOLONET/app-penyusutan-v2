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
        <div class="row">
            <div class="col-md-3 col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="title">Filter Data</h5>
                        <div class="row">
                            <div class="col-md-12 col-12 mt-2">
                                <label>Periode : </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="from"
                                        placeholder="Pilih Tanggal Awal" value="{{ date('Y-m-d') }}" id="from">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <label>Penggunaan : </label>
                                <select name="penggunaan" id="penggunaan" class="form-control selectpicker"
                                    data-live-search="true">
                                    <option value="all" selected>Semua</option>
                                    @foreach ($penggunaan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-12">
                                <hr style="border-top: 1px solid #000;">
                                <table class="table table-borderless mt-3">
                                    <tr>
                                        <td>Total Nilai Buku</td>
                                        <td>:</td>
                                        <td><span id="total_nilai_buku"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Total Akumulasi</td>
                                        <td>:</td>
                                        <td><span id="total_akumulasi"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table start -->
            <div class="col-md-9 col-12">
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="header-title">Daftar Nilai Buku</h4>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Alat</th>
                                    <th>Pengunaan</th>
                                    <th>Umur</th>
                                    <th>Nilai Buku</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
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
</script>
@endsection