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
            <th colspan="2">Periode Laporan</th>
            <th colspan="6">: </th>
        </tr>
        <tr>
            <th colspan="2">Dicetak oleh</th>
            <th colspan="6">: {{ Auth::user()->name }} pada
                {{ Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</th>
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
        @forelse ($data as $item)
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
        @empty
        <tr>
            <td colspan="8"> Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>