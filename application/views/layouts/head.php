<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SISTEM PEMBAYARAN TU</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- DataTables Bootstrap -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

  <!-- Your Custom CSS -->
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

  <style>
    table.dataTable {
      border-collapse: collapse;
    }

    table.dataTable th,
    table.dataTable td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    table.dataTable th {
      font-weight: bold;
      border-bottom: 2px solid #ddd;
      text-align: center;
    }

    table.dataTable tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    table.dataTable tr:hover {
      background-color: #ddd;
    }
  </style>
</head>


<?php
if (!function_exists('time_elapsed_string')) {
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' lalu' : 'baru saja';
    }
}


$this->load->library('notif_lib');
$notifikasi = $this->notif_lib->get_notifikasi();
?>

<body>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="<?= base_url('dashboard') ?>" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">SIYARTU</span>
        </a>
        <i class="fa-solid fa-bars toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
					 <li class="nav-item dropdown">

						<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
								<i class="fa-solid fa-bell"></i>
								<span class="badge bg-primary badge-number"><?= count($notifikasi) ?></span>
						</a>

						<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
								<li class="dropdown-header">
										You have <?= count($notifikasi) ?> new notifications
										<a href="<?= base_url('notifikasi') ?>"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
								</li>

								<li><hr class="dropdown-divider"></li>

								<?php foreach ($notifikasi as $notif): ?>
									<li class="notification-item d-flex justify-content-between align-items-start">
											<div class="me-2">
													<i class="bi bi-info-circle text-primary"></i>
											</div>
											<div class="flex-grow-1">
													<h4>Pemberitahuan</h4>
													<p><?= $notif->pesan ?></p>
													<p class="small text-muted"><?= time_elapsed_string($notif->created_at) ?> ago</p>
											</div>

											<?php if ($this->session->userdata('role') === 'Ortu' && !$notif->is_read): ?>
													<form method="post" action="<?= base_url('notifikasi/mark_as_read') ?>">
															<input type="hidden" name="id" value="<?= $notif->id ?>">
															<button type="submit" class="btn btn-sm btn-success" title="Tandai sudah dibaca">
																	<i class="fa-solid fa-check"></i>
															</button>
													</form>
											<?php endif; ?>
									</li>
									<li><hr class="dropdown-divider"></li>
							<?php endforeach; ?>


								<?php if (empty($notifikasi)): ?>
										<li class="notification-item">
												<div><p>Tidak ada notifikasi.</p></div>
										</li>
								<?php endif; ?>

								<li class="dropdown-footer">
										<a href="<?= base_url('notifikasi') ?>">Show all notifications</a>
								</li>
						</ul>

					</li><!-- End Notification Nav -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-circle-user" style="margin-right:10px;font-size:30px;"></i>
                    <?= $this->session->userdata('username'); ?>
                </a>
								<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
									<li class="dropdown-header">
										<h6><?= $this->session->userdata('username'); ?></h6>
										<span><?= $this->session->userdata('role'); ?></span>
									</li>
									<li>
										<hr class="dropdown-divider">
									</li>

									<li>
										<a class="dropdown-item d-flex align-items-center" href="<?= base_url('user/setting') ?>">
											<i class="fa-solid fa-gear"></i>
											<span>Setting Profil</span>
										</a>
									</li>
									<li>
										<hr class="dropdown-divider">
									</li>

									<li>
										<a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
											<i class="fa-solid fa-right-from-bracket"></i>
											<span>Sign Out</span>
										</a>
									</li>

								</ul><!-- End Profile Dropdown Items -->
            </li>
        </ul>
    </nav>
</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <?php 
        $current_page = $this->uri->segment(1); 
    ?>
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?= $current_page == 'dashboard' ? '' : 'collapsed'; ?>" href="<?= base_url('dashboard') ?>">
                <i class="fa-solid fa-house"></i><span>Beranda</span>
            </a>
        </li>
				<li class="nav-heading">Data Master</li>
				<?php if ($this->session->userdata('role') == 'Admin'): ?>
        <li class="nav-item">
            <a class="nav-link <?= $current_page == 'kelas' ? '' : 'collapsed'; ?>" href="<?= base_url('kelas') ?>">
               <i class="fa-solid fa-school"></i> <span>Data Kelas</span>
            </a>
        </li>
				<li class="nav-item">
            <a class="nav-link <?= $current_page == 'siswa' ? '' : 'collapsed'; ?>" href="<?= base_url('siswa') ?>">
               <i class="fa-regular fa-address-card"></i> <span>Data Siswa</span>
            </a>
        </li>
				<?php endif;?>
        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="fa-regular fa-money-bill-1"></i><span>Pembayaran</span><i class="fa-solid fa-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
							<a href="<?= base_url('pembayaran?jenis=SPP') ?>">
									<i class="fa-solid fa-circle"></i><span>SPP</span>
							</a>
					</li>
					<li>
							<a href="<?= base_url('pembayaran?jenis=Uang Gedung') ?>">
									<i class="fa-solid fa-circle"></i><span>Uang Gedung</span>
							</a>
					</li>
					<li>
							<a href="<?= base_url('pembayaran?jenis=Kegiatan') ?>">
									<i class="fa-solid fa-circle"></i><span>Kegiatan</span>
							</a>
					</li>
					<li>
							<a href="<?= base_url('pembayaran?jenis=Ujian') ?>">
									<i class="fa-solid fa-circle"></i><span>Ujian</span>
							</a>
					</li>
        </ul>
      </li><!-- End Charts Nav -->
<?php if ($this->session->userdata('role') == 'Admin'): ?>
			<li class="nav-heading">Manajemen Pengguna</li>

        <li class="nav-item">
            <a class="nav-link <?= $current_page == 'user' ? '' : 'collapsed'; ?>" href="<?= base_url('user') ?>">
                <i class="fa-solid fa-users"></i><span>Data Pengguna</span>
            </a>
        </li>
<?php endif;?>
    </ul>
</aside><!-- End Sidebar -->

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('auth/logout') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Logout</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
