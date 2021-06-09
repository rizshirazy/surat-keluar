<table>
    <thead>
        <tr>
            <th colspan="4">Laporan Surat Keluar</th>
        </tr>
        <tr>
            <th colspan="4">Pengadilan Agama Mentok</th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th colspan="2">Periode Laporan</th>
            <th colspan="2">: </th>
        </tr>
        <tr>
            <th colspan="2">Dicetak oleh</th>
            <th colspan="2">: {{ Auth::user()->name }} pada
                {{ Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kode Surat</th>
            <th>Keterangan</th>
            <th>Jumlah</th>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->code }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->qty ?? '0' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4"> Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>