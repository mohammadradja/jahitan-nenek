<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan - Jahitan Nenek</title>
    <style>
        body { font-family: 'serif'; padding: 40px; color: #2E2A27; }
        h1 { text-align: center; font-size: 24px; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #E7D7C9; padding: 12px; text-align: left; font-size: 12px; }
        th { bg-color: #F8F3EC; font-weight: bold; }
        .footer { margin-top: 50px; text-align: right; font-size: 10px; color: #9ca3af; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #D8A7B1; color: white; border: none; border-radius: 8px; cursor: pointer;">Cetak PDF</button>
        <p style="font-size: 10px; color: #9ca3af; margin-top: 10px;">Gunakan fitur "Save as PDF" pada dialog cetak browser Anda.</p>
    </div>

    <h1>Laporan Data Pelanggan</h1>
    <p>Tanggal Cetak: {{ date('d F Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No. Handphone</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>#{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone ?? '-' }}</td>
                    <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak secara otomatis oleh Sistem Jahitan Nenek.
    </div>
</body>
</html>
