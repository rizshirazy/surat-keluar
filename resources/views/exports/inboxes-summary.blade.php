<table>
    <thead>
        <tr>
            <th colspan="4">Laporan Surat Masuk</th>
        </tr>
        <tr>
            <th colspan="4">Pengadilan Agama Mentok</th>
        </tr>
        <tr>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th colspan="2">Periode Laporan</th>
            <th colspan="2">: {{ $periode }}</th>
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
        @php
        $total = 0;
        @endphp

        @forelse ($data as $item)
        @php
        $qty = $item->qty ? $item->qty : 0;
        $total = $total + $qty;
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->code }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $qty }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4"> Tidak ada data</td>
        </tr>
        @endforelse

        @if (count($data) > 0)
        <tr>
            <td colspan="3">TOTAL</td>
            <td>{{ $total }}</td>
        </tr>
        @endif
    </tbody>
</table>