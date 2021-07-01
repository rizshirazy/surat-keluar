<table>
    <thead>
        <tr>
            <th colspan="8">Laporan Surat Masuk</th>
        </tr>
        <tr>
            <th colspan="8">Pengadilan Agama Mentok</th>
        </tr>
        <tr>
            <th colspan="8"></th>
        </tr>
        <tr>
            <th colspan="2">Periode Laporan</th>
            <th colspan="6">: {{ $periode }}</th>
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
            <th>Sifat</th>
            <th>Kode</th>
            <th>Perihal</th>
            <th>Tujuan</th>
            <th>Pegawai</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        @php
        $show = !$item->confidential || role('PETUGAS') || role('SUPER ADMIN')
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ $show ? $item->reff : '-' }}
            </td>
            <td>{{ Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
            <td>{{ $item->type->name }}</td>
            <td>
                {{ $show ? $item->category->group->code : '-' }}
            </td>
            <td>
                {{ $show ? $item->subject : '-' }}</td>
            <td>
                {{ $show ? $item->origin : '-' }}</td>
            <td>
                {{ $show ? $item->user->name : '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8"> Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>