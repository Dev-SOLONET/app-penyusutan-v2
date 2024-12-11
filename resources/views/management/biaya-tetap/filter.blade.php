<!-- Modal -->
<div class="modal fade" id="modal-filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('management.biaya-tetap.index') }}">
                    <div class="form-row">
                        <div class="col-md-12 col-12 mb-3">
                            <label>Tahun</label>
                            <select name="tahun" class="form-control selectpicker" data-live-search="true">
                                @for ($i = 2021; $i <= date('Y'); $i++)
                                    @if($tahun == $i)
                                    <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @else
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Account Debit</label>
                            <select name="account_debit" class="form-control selectpicker" data-live-search="true">
                                <option selected value="0">--Semua Account--</option>
                                <option value="56">Biaya Marketing Proyek</option>
                                <option value="65">Biaya Marketing</option>
                                <option value="59">Cadangan THR</option>
                                <option value="47">PPN</option>
                                <option value="46">PPh ps 23</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Account Kredit</label>
                            <select name="account_kredit" class="form-control selectpicker" data-live-search="true">
                                @if($account_kredit == 0)
                                <option selected value="0">--Semua Account--</option>
                                <option value="17">Hutang Biaya</option>
                                <option value="27">Hutang Fee</option>
                                <option value="4">Biaya Dibayar Dimuka</option>
                                @elseif($account_kredit == 17)
                                
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-simpan" class="btn btn-primary">Filter Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->