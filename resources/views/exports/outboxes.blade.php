<table>
    <thead>
        <tr>
            <th colspan="8">Laporan Surat Keluar</th>
        </tr>
        <tr>
            <th colspan="8">Pengadilan Agama Mentok</th>
        </tr>
        <tr>
            <th colspan="8"></th>
        </tr>
        <tr>
            <th>Periode:</th>
            <th colspan="4"></th>
            <th colspan="3">Dicetak oleh: {{ Auth::user()->name }} pada
                {{ Carbon\Carbon::now()->format('d-m-Y H:i:s') }} </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Tanggal Surat</th>
            <th>Index</th>
            <th>Klasifikasi</th>
            <th>Perihal</th>
            <th>Tujuan</th>
            <th>Pegawai</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->reff }}</td>
            <td>{{ Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
            <td>{{ $item->index . $item->suffix }}</td>
            <td>{{ $item->category->group->name }}</td>
            <td>{{ $item->subject }}</td>
            <td>{{ $item->destination }}</td>
            <td>{{ $item->user->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>