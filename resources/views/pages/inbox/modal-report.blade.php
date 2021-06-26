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
    <h5 class="modal-title" id="mainModalLabel">Laporan Surat Masuk</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form id="modalForm" action="{{ route('inbox.report') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="start_date">Tanggal Awal</label>
                    <input type="text" id="start_date" name="start_date"
                           class="form-control datepicker @error('start_date') is-invalid @enderror"
                           placeholder="Tanggal Awal"
                           data-provide="datepicker">

                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="text" id="end_date" name="end_date"
                           class="form-control datepicker @error('end_date') is-invalid @enderror"
                           placeholder="Tanggal Akhir"
                           data-provide="datepicker">

                    @error('end_date')
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