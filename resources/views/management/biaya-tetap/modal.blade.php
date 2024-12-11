<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{ route('management.biaya-tetap.store') }}">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="nama" placeholder="Masukan Nama / Keterangan"></textarea>
                            <span class="text-danger">
                                <strong id="nama"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Nominal</label>
                            <input type="number" class="form-control" name="nominal" placeholder="Masukan Nominal">
                            <span class="text-danger">
                                <strong id="nominal"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Awal</label>
                            <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="tgl">
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="tgl_akhir">
                            <span class="text-danger">
                                <strong id="tgl_akhir"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Account Debit</label>
                            <select name="id_account_debit" class="form-control selectpicker" data-live-search="true">
                                <option disabled selected value="0">--Pilih Account--</option>
                                <option value="56">Biaya Marketing Proyek</option>
                                <option value="65">Biaya Marketing</option>
                                <option value="59">Cadangan THR</option>
                                <option value="47">PPN</option>
                                <option value="46">PPh ps 23</option>
                            </select>
                            <span class="text-danger">
                                <strong id="id_account_debit"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Account Kredit</label>
                            <select name="id_account_kredit" class="form-control selectpicker" data-live-search="true">
                                <option disabled selected value="0">--Pilih Account--</option>
                                <option value="17">Hutang Biaya</option>
                                <option value="27">Hutang Fee</option>
                                <option value="4">Biaya Dibayar Dimuka</option>
                            </select>
                            <span class="text-danger">
                                <strong id="id_account_kredit"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->