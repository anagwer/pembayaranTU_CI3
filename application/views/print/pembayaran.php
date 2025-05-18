<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran <?= ucfirst($jenis) ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin: 0;
            font-size: 18pt;
        }

        .header p {
            margin: 2px 0;
            font-size: 10pt;
        }

        hr {
            border: 1px solid #000;
            margin: 10px 0 20px 0;
        }

        .info {
            margin-bottom: 20px;
            font-size: 10pt;
        }

        .info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 30px;
            font-size: 10pt;
            text-align: right;
        }

        .footer p {
            margin-bottom: 60px;
        }

        .signature {
            text-align: right;
            font-size: 10pt;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>LAPORAN PEMBAYARAN</h2>
    <p><strong>Jenis Pembayaran:</strong> <?= strtoupper($jenis) ?></p>
</div>

<hr>

<div class="info">
    <?php if ($kelas): ?>
        <p><strong>Kelas:</strong> <?= $kelas->nama_kelas ?> (<?= $kelas->tahun_ajaran ?>)</p>
    <?php endif; ?>
    <?php if ($from && $to): ?>
        <p><strong>Periode:</strong> <?= date('d-m-Y', strtotime($from)) ?> s.d. <?= date('d-m-Y', strtotime($to)) ?></p>
    <?php endif; ?>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Jumlah</th>
            <th>Tanggal Bayar</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach ($pembayaran as $p): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td style="text-align: left;"><?= $p->nama_siswa ?></td>
            <td><?= $p->nama_kelas ?></td>
            <td style="text-align: right;">Rp<?= number_format($p->jumlah, 0, ',', '.') ?></td>
            <td><?= $p->tanggal_bayar != '0000-00-00' ? date('d-m-Y', strtotime($p->tanggal_bayar)) : '-' ?></td>
            <td style="text-align: left;"><?= $p->keterangan ?></td>
            <td><?= $p->tanggal_bayar != '0000-00-00' ? 'Lunas' : 'Belum Lunas' ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="footer">
    <p>Dicetak pada: <?= date('d-m-Y') ?></p>
    <div class="signature">
        <p>Admin / Petugas</p>
        <p>______________________</p>
    </div>
</div>

</body>
</html>
