<!-- Modal -->
<div class="modal fade" id="modal_import_pembelian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Dari Penjualan Toko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_satuan" method="GET" action="{{ route('admin.barang.store') }}">
                    <input type="hidden" name="id">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">No Invoice</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan No Invoice"
                                required>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"><i class="ti-search"></i> Cari Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->