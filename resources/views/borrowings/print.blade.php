<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Peminjaman Alat - {{ $request->id }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: #000;
            max-width: 210mm; /* A4 width */
            margin: 0 auto;
            padding: 20mm;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .header h1, .header h2, .header h3 {
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header h1 { font-size: 16pt; }
        .header h2 { font-size: 14pt; }
        .header h3 { font-size: 12pt; }
        .content {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 40%;
        }
        .signature-box .name {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            @page {
                size: A4;
                margin: 20mm;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h2>
        <h1>UNIVERSITAS MULAWARMAN</h1>
        <h2>FAKULTAS TEKNIK</h2>
        <h3>LABORATORIUM TEKNIK</h3>
    </div>

    <div class="content">
        <p style="text-align: center; font-weight: bold; font-size: 14pt; text-decoration: underline;">SURAT PEMINJAMAN ALAT</p>
        <p style="text-align: center;">Nomor: {{ str_pad($request->id, 4, '0', STR_PAD_LEFT) }}/LAB/{{ date('Y') }}</p>

        <p>Yang bertanda tangan di bawah ini:</p>
        
        <table style="border: none;">
            <tr style="border: none;">
                <td style="border: none; width: 150px;">Nama</td>
                <td style="border: none; width: 10px;">:</td>
                <td style="border: none;">{{ $request->user->name }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">NIP/NIM</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ $request->user->email }}</td> <!-- Assuming email is identity for now -->
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Keperluan</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ $request->purpose }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Tanggal Pinjam</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ \Carbon\Carbon::parse($request->borrow_date)->format('d F Y') }}</td>
            </tr>
            <tr style="border: none;">
                <td style="border: none;">Tanggal Kembali</td>
                <td style="border: none;">:</td>
                <td style="border: none;">{{ \Carbon\Carbon::parse($request->return_date)->format('d F Y') }}</td>
            </tr>
        </table>

        <p>Mengajukan peminjaman alat laboratorium sebagai berikut:</p>

        <table>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No</th>
                    <th>Nama Alat</th>
                    <th style="width: 100px; text-align: center;">Jumlah</th>
                    <th>Kondisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($request->items as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->inventoryItem->name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td>{{ $item->inventoryItem->condition }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Saya bertanggung jawab penuh atas alat yang dipinjam dan bersedia mengganti jika terjadi kerusakan atau kehilangan selama masa peminjaman.</p>
    </div>

    <div class="signature">
        <div class="signature-box">
            <p>Mengetahui,<br>Kepala Laboratorium</p>
            <div class="name">( ..................................... )</div>
            <p>NIP.</p>
        </div>
        <div class="signature-box">
            <p>Samarinda, {{ date('d F Y') }}<br>Peminjam</p>
            <div class="name">{{ $request->user->name }}</div>
            <p>NIP/NIM.</p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>