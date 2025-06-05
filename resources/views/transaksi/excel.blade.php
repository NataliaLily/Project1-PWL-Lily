<table>
    <tr>
        <td>Type</td>
        <td>{{$request->in_out ?? "Semua Tipe"}}</td>
    </tr>
    <tr>
        <td>Wallet</td>
        <td>{{App\Models\Wallet::find($request->wallet_id)->name ?? "Semua Wallet"}}</td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td>{{App\Models\Kategori::find($request->kategori_id)->name ?? "Semua Kategori"}}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>{{$request->tanggal ?? "-"}}</td>
    </tr>
    <tr></tr>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Jenis</th>
            <th>Wallet</th>
            <th>Kategori</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        @php($i = 1)
        @foreach ($transaksi as $t)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $t->tanggal }}</td>
            <td>{{ $t->deskripsi }}</td>
            <td>{{ $t->in_out }}</td>
            <td>{{ $t->Wallet->name }}</td>
            <td>{{ $t->Kategori->name }}</td>
            <td>{{ $t->nominal}}</td>

        </tr>
        @endforeach
    </tbody>
</table>
