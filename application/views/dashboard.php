<?php $this->load->view('layouts/head'); ?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card text-center p-3" style="padding:2%;height:125px;">
                    <h3>Jumlah Siswa<br><b><?= $jumlah_siswa_aktif ?></b></h3>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card text-center p-3" style="padding:2%;height:125px;">
                    <h3>Jumlah Kelas<br><b><?= $jumlah_kelas ?></b></h3>
                </div>
            </div>
            <?php foreach ($pembayaran_chart as $index => $p): ?>
                <div class="col-md-3 mb-4">
					<div class="card text-center p-3" style="padding:2%;">
                    <canvas id="donutChart<?= $index ?>"></canvas>
                	</div>
                </div>
            <?php endforeach; ?>
            <div class="col-lg-6">
				<div class="card text-center p-3" style="padding:2%;">
                <canvas id="barChart"></canvas>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card text-center p-4" style="height:200px;">
                    <h5>Pembayaran Belum Lunas</h5>
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($belum_lunas as $bl): ?>
                            <li><?= $bl->jenis ?>: <b><?= $bl->jumlah ?></b></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Bar Chart - Pembayaran Belum Lunas
        const barData = {
            labels: [<?php foreach ($belum_lunas as $item) echo "'$item->jenis',"; ?>],
            datasets: [{
                label: 'Belum Lunas',
                data: [<?php foreach ($belum_lunas as $item) echo "$item->jumlah,"; ?>],
                backgroundColor: ['#f44336', '#e91e63', '#9c27b0', '#3f51b5']
            }]
        };

        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: barData,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Jumlah Pembayaran Belum Lunas per Jenis'
                    }
                }
            }
        });

        // Donut Charts - Pembayaran per Jenis
        <?php foreach ($pembayaran_chart as $index => $p): ?>
            new Chart(document.getElementById('donutChart<?= $index ?>'), {
                type: 'doughnut',
                data: {
                    labels: ['Sudah Bayar', 'Belum Bayar'],
                    datasets: [{
                        data: [<?= $p['sudah'] ?>, <?= $p['belum'] ?>],
                        backgroundColor: ['#4CAF50', '#F44336'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: '<?= $p['jenis'] ?>'
                        }
                    }
                }
            });
        <?php endforeach; ?>
    });
</script>

<?php $this->load->view('layouts/footer'); ?>
</body>
</html>
