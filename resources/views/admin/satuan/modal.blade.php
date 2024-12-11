<!-- Modal -->
<div class="modal fade" id="modal_satuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_satuan" method="POST" action="{{ route('admin.satuan.store') }}">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Nama Satuan</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Satuan"
                                required>
                            <span class="text-danger">
                                <strong id="satuan"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom02">Keterangan</label>
                            <textarea class="form-control" name="keterangan"
                                placeholder="Masukan Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->