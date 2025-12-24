<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kejahatan - Crime Alert</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; font-size: 12px; }
        .header { text-align: center; border-bottom: 2px solid #2c3e50; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #e74c3c; margin: 0; text-transform: uppercase; font-size: 24px; }
        .header p { margin: 5px 0 0; color: #7f8c8d; }

        .summary-box { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ddd; }
        .summary-box table { width: 100%; }
        .summary-box td { font-weight: bold; }

        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #2c3e50; color: #fff; text-transform: uppercase; font-size: 10px; }
        .table tr:nth-child(even) { background-color: #f2f2f2; }

        .status { padding: 3px 8px; border-radius: 10px; font-size: 9px; font-weight: bold; text-transform: uppercase; }
        .status-pending { background: #fde68a; color: #b45309; }
        .status-proses { background: #bfdbfe; color: #1e40af; }
        .status-selesai { background: #d1fae5; color: #065f46; }

        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 5px; }
    </style>
</head>
<body>

<div class="header">
    <h1>Crime Alert Report</h1>
    <p>Sistem Pelaporan Kejahatan Masyarakat &bull; {{ $stats['periode'] }}</p>
</div>

<div class="summary-box">
    <table>
        <tr>
            <td>Total Laporan: <span style="color: #2c3e50">{{ $stats['total'] }}</span></td>
            <td>Selesai: <span style="color: #27ae60">{{ $stats['selesai'] }}</span></td>
            <td>Proses: <span style="color: #3498db">{{ $stats['proses'] }}</span></td>
            <td>Pending: <span style="color: #f39c12">{{ $stats['pending'] }}</span></td>
        </tr>
    </table>
</div>

<table class="table">
    <thead>
    <tr>
        <th width="5%">ID</th>
        <th width="20%">Tanggal</th>
        <th width="35%">Judul Laporan & Kategori</th>
        <th width="25%">Pelapor / Petugas</th>
        <th width="15%">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($laporans as $laporan)
        <tr>
            <td align="center">#{{ $laporan->id }}</td>
            <td>{{ \Carbon\Carbon::parse($laporan->tgl_lapor)->format('d/m/Y') }}</td>
            <td>
                <strong>{{ $laporan->judul_laporan }}</strong><br>
                <small style="color: #666 italic">{{ $laporan->kategori }}</small>
            </td>
            <td>
                P: {{ $laporan->user->name ?? 'N/A' }}<br>
                <small style="color: #3498db">Pol: {{ $laporan->polisi->nama ?? 'Belum Ditugaskan' }}</small>
            </td>
            <td align="center">
                    <span class="status status-{{ strtolower($laporan->status) }}">
                        {{ $laporan->status }}
                    </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    Dicetak pada: {{ date('d F Y H:i') }} &bull; Crime Alert Admin System
</div>

</body>
</html>
