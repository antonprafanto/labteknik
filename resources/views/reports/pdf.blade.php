<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Laboratorium</title>
    <style>
        @page {
            margin: 0;
            size: A4;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            line-height: 1.3;
            margin: 0;
            padding: 2cm;
            background-color: #fff;
        }
        
        /* Kop Surat */
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .logo {
            width: 80px;
            height: auto;
            position: absolute;
            left: 0;
            top: 5px;
        }
        .kop-text {
            text-align: center;
            width: 100%;
            padding-left: 100px; /* Adjusted to prevent overlap with logo (80px + 20px gap) */
        }
        .kop-text h4 {
            margin: 0;
            font-size: 14px;
            font-weight: normal;
            text-transform: uppercase;
        }
        .kop-text h3 {
            margin: 2px 0;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .kop-text h2 {
            margin: 2px 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .kop-text p {
            margin: 0;
            font-size: 11px;
            font-style: italic;
        }

        /* Title */
        .report-title {
            text-align: center;
            margin-bottom: 30px;
        }
        .report-title h1 {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin: 0;
        }
        .report-title p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        /* Metrics */
        .metrics-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 15px;
        }
        .metric-box {
            flex: 1;
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        .metric-value {
            font-size: 18px;
            font-weight: bold;
            display: block;
        }
        .metric-label {
            font-size: 10px;
            text-transform: uppercase;
            margin-top: 5px;
            display: block;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 25px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .no-border-top { border-top: none; }
        .width-50 { width: 50px; }

        /* Signatures */
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            page-break-inside: avoid;
        }
        .signature-box {
            width: 40%;
            text-align: center;
        }
        .signature-space {
            height: 80px;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
        .signature-nip {
            font-size: 12px;
        }

        /* Print adjustments */
        @media print {
            body { 
                -webkit-print-color-adjust: exact; 
                padding: 0;
                margin: 2cm;
            }
            @page {
                margin: 2cm; /* Standard margin for printing */
            }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Kop Surat -->
    <div class="kop-surat">
        <!-- Official Logo: Use asset() for browser view compatibility -->
        <img src="{{ asset('logo-unmul.png') }}" 
             alt="Logo Unmul" 
             class="logo" 
             style="width: 80px; height: auto;">
        <div class="kop-text">
            <h4>Kementerian Pendidikan Tinggi, Sains dan Teknologi</h4>
            <h3>Universitas Mulawarman</h3>
            <h2>Fakultas Teknik</h2>
            <p>Jalan Sambaliung Kampus Gunung Kelua Samarinda 75119</p>
            <p>Laman: ft.unmul.ac.id | Email: fatek@unmul.ac.id</p>
        </div>
    </div>

    <!-- Title -->
    <div class="report-title">
        <h1>LAPORAN STATUS INVENTARIS LABORATORIUM</h1>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    <!-- Summary Metrics -->
    <div class="metrics-grid">
        <div class="metric-box">
            <span class="metric-value">{{ array_sum($itemStatus) }}</span>
            <span class="metric-label">Total Barang</span>
        </div>
        <div class="metric-box">
            <span class="metric-value">{{ $itemStatus['available'] ?? 0 }}</span>
            <span class="metric-label">Tersedia</span>
        </div>
        <div class="metric-box">
            <span class="metric-value">{{ $itemStatus['borrowed'] ?? 0 }}</span>
            <span class="metric-label">Dipinjam</span>
        </div>
        <div class="metric-box">
            <span class="metric-value">{{ ($itemStatus['damaged'] ?? 0) + ($itemStatus['maintenance'] ?? 0) }}</span>
            <span class="metric-label">Rusak / Maint.</span>
        </div>
    </div>

    <!-- Inventory by Category -->
    <h4>A. Rekapitulasi Inventaris per Kategori</h4>
    <table>
        <thead>
            <tr>
                <th width="10%">No.</th>
                <th>Kategori Barang</th>
                <th width="20%">Jumlah Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach($itemsByCategory as $index => $category)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="text-center">{{ $category->items_count }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-right"><strong>Total</strong></td>
                <td class="text-center"><strong>{{ $itemsByCategory->sum('items_count') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Inventory by Lab -->
    <h4>B. Distribusi Inventaris per Laboratorium</h4>
    <table>
        <thead>
            <tr>
                <th width="10%">No.</th>
                <th>Nama Laboratorium</th>
                <th width="20%">Jumlah Item</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labStats as $index => $lab)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $lab->name }}</td>
                    <td class="text-center">{{ $lab->items_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Recent Damage Reports (Optional, if space permits or crucial) -->
    <h4>C. Laporan Kerusakan Terkini (5 Terakhir)</h4>
    <table>
        <thead>
            <tr>
                <th width="15%">Tanggal</th>
                <th>Nama Barang</th>
                <th width="15%">Kondisi</th>
                <th width="20%">Pelapor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentDamageReports->take(5) as $report)
                <tr>
                    <td class="text-center">{{ $report->created_at->format('d/m/Y') }}</td>
                    <td>{{ $report->inventoryItem->name ?? '-' }}</td>
                    <td class="text-center">{{ ucfirst($report->damage_type) }}</td>
                    <td class="text-center">{{ $report->reporter->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada laporan kerusakan terkini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Signatures -->
    <div class="signature-section">
        <div class="signature-box">
            <!-- Left Signature (Optional, e.g. Laboran) -->
            <p>Mengetahui,</p>
            <p>Laboran / Teknisi</p>
            <div class="signature-space"></div>
            <p class="signature-name">( ....................................... )</p>
            <p class="signature-nip">NIP/NIDN. ..........................</p>
        </div>
        <div class="signature-box">
            <!-- Right Signature (Kepala Lab) -->
            <p>Samarinda, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Kepala Laboratorium</p>
            <div class="signature-space"></div>
            <p class="signature-name">( ....................................... )</p>
            <p class="signature-nip">NIP/NIDN. ..........................</p>
        </div>
    </div>

</body>
</html>

