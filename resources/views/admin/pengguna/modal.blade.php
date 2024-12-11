<!-- Modal -->
<div class="modal fade" id="modal_pengguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_pengguna" method="POST" action="{{ route('admin.pengguna.store') }}">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama"
                                placeholder="Masukan Data Pengguna" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Laba Rugi Account Debit</label>
                            <select name="debit" class="form-control selectpicker" data-live-search="true" data-size="7" required>
                                <option disabled selected value>--Pilih Account--</option>
                                @foreach ($account as $data)
                                    <option value="{{ $data->id_account }}">{{ $data->nama_account }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Laba Rugi Account Kredit</label>
                            <select name="kredit" class="form-control selectpicker" data-live-search="true" data-size="7" required>
                                <option disabled selected value>--Pilih Account--</option>
                                @foreach ($account as $data)
                                    <option value="{{ $data->id_account }}">{{ $data->nama_account }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Neraca Account Debit</label>
                            <select name="n_debit" class="form-control selectpicker" data-live-search="true" data-size="7" required>
                                <option disabled selected value>--Pilih Account--</option>
                                @foreach ($account as $data)
                                    <option value="{{ $data->id_account }}">{{ $data->nama_account }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Neraca Account Kredit</label>
                            <select name="n_kredit" class="form-control selectpicker" data-live-search="true" data-size="7" required>
                                <option disabled selected value>--Pilih Account--</option>
                                @foreach ($account as $data)
                                    <option value="{{ $data->id_account }}">{{ $data->nama_account }}</option>
                                @endforeach
                            </select>
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