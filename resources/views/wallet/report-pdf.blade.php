<html>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h1 {
            color: #2c3e50;
            font-size: 20px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 5px;
        }

        h3 {
            color: #16a085;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #bdc3c7;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #ecf0f1;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    <body>
        <h1>Report Wallet : {{$wallet->name}}</h1>
        <h3>Saldo : Rp {{number_format ($wallet->saldo)}}</h3>
        <p class="">
        </p>
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Nominal</th>
            </tr>
            @foreach ($wallet->Jurnal as $j )
                <tr>
                    <td>{{ $j->tanggal }}</td>
                    <td>{{ $j->keterangan }}</td>
                    <td>Rp {{ number_format($j->nominal) }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>