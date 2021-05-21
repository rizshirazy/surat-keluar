<script>
    sizeModal('md');

    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        language: 'id',
        autoclose: true,
        todayHighlight: true,
        daysOfWeekHighlighted: [0],
    });

    function submitModalForm() {
        $('#modalForm').submit();
        $('#mainModal').modal('hide');
    }
</script>

<div class="modal-header">
    <h5 class="modal-title" id="mainModalLabel">Laporan Surat Keluar</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form id="modalForm" action="{{ route('outbox.report') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="date_start">Tanggal Awal</label>
                    <input type="text" id="date_start" name="date_start"
                           class="form-control datepicker @error('date_start') is-invalid @enderror"
                           data-provide="datepicker">

                    @error('date_start')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="date_start">Tanggal Akhir</label>
                    <input type="text" id="date_start" name="date_start"
                           class="form-control datepicker @error('date_start') is-invalid @enderror"
                           data-provide="datepicker">

                    @error('date_start')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success" onclick="submitModalForm()">Unduh</button>
</div>