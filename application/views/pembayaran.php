<?php $this->load->view('layouts/head'); ?>

<main id="main" class="main">
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title" style="font-weight: bold; font-size: 20px;">Data Pembayaran - <?= ucfirst($jenis) ?></h3>
										<?php if ($this->session->userdata('role') == 'Admin'): ?>
										<div class="d-flex justify-content-between mb-3">
											<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPembayaranModal">
													<i class="fa-solid fa-plus"></i> Tambah
											</button>
											<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#printPembayaranModal">
													<i class="fa-solid fa-file-pdf"></i> Cetak PDF
											</button>
										</div>
										<?php endif;?>
                    <hr>

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
																		<?php if(ucfirst($jenis)=='SPP'){
																			echo '<th>Bulan</th>';
																		}?>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
																		<?php if ($this->session->userdata('role') == 'Admin'): ?>
                                    <th>Aksi</th>
																		<?php endif;?>
																		
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($pembayaran as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <?php
                                    if(ucfirst($jenis)=='SPP'){
                                            $bulanIndo = [
                                                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                                                    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                                                    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                                                    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                            ];

                                            $tanggal = date('Y-m-d', strtotime($p->created_at)); // pastikan formatnya benar
                                            list($tahun, $bulan, $hari) = explode('-', $tanggal);

                                            echo '<td>'.$bulanIndo[$bulan] . ' ' . $tahun.'</td>';
                                        }
                                        ?>
                                    <td><?= $p->nama_siswa ?></td>
                                    <td><?= $p->nama_kelas ?></td>
                                    <td>Rp<?= number_format($p->jumlah, 0, ',', '.') ?></td>
                                    <td><?php if($p->tanggal_bayar=='0000-00-00'){
																			echo '-';
																		}else{
																			echo $p->tanggal_bayar;
																		} ?></td>
                                    <td><?= $p->keterangan ?></td>
                                    <td><?php if($p->tanggal_bayar=='0000-00-00'){
																			echo 'Belum Lunas';
																		}else{
																			echo 'Lunas';
																		} ?></td>
																		<?php if ($this->session->userdata('role') == 'Admin'): ?>
                                    <td>
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editPembayaran<?= $p->id ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePembayaran<?= $p->id ?>"><i class="fa-regular fa-trash-can"></i></button>
                                    </td>
																		
																		<?php endif;?>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editPembayaran<?= $p->id ?>" tabindex="-1">
                                    <div class="modal-dialog">
            							<div class="modal-content">
											<form method="post" action="<?= base_url('pembayaran/update') ?>" class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Edit Pembayaran</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													<input type="hidden" name="id" value="<?= $p->id ?>">
													<input type="hidden" name="jenis" value="<?= $jenis ?>">
													<div class="form-group">
														<label>Jumlah</label>
														<input type="number" name="jumlah" class="form-control" value="<?= $p->jumlah ?>" required>
													</div>
													<div class="form-group">
														<label>Tanggal Bayar</label>
														<input type="date" name="tanggal_bayar" class="form-control" value="<?= $p->tanggal_bayar ?>" required>
													</div>
													<div class="form-group">
														<label>Keterangan</label>
														<textarea name="keterangan" class="form-control"><?= $p->keterangan ?></textarea>
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary">Simpan</button>
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
												</div>
											</form>
										</div>
                                    </div>
                                </div>

                                <div class="modal fade" id="deletePembayaran<?= $p->id ?>" tabindex="-1">
                                    <div class="modal-dialog">
            							<div class="modal-content">
											<form method="post" action="<?= base_url('pembayaran/delete') ?>" class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Hapus Pembayaran</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
												</div>
												<div class="modal-body">
													<p>Yakin ingin menghapus pembayaran untuk <strong><?= $p->nama_siswa ?></strong>?</p>
													<input type="hidden" name="id" value="<?= $p->id ?>">
													<input type="hidden" name="jenis" value="<?= $jenis ?>">
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-danger">Hapus</button>
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
												</div>
											</form>
										</div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
</main>

<!-- Add Modal -->
<div class="modal fade" id="addPembayaranModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
			<form method="post" action="<?= base_url('pembayaran/add') ?>" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Pembayaran</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="jenis" value="<?= $jenis ?>">
					<div class="form-group">
						<label>Kelas</label>
						<select name="id_kelas" class="form-select" required>
							<option value="">-- Pilih Kelas --</option>
							<?php foreach ($kelas as $k): ?>
								<option value="<?= $k->id ?>"><?= $k->nama_kelas ?> (<?= $k->tahun_ajaran ?>)</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" name="jumlah" class="form-control" required>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
				</div>
			</form>
    	</div>
    </div>
</div>
<!-- Modal Cetak PDF -->
<div class="modal fade" id="printPembayaranModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('pembayaran/export_pdf') ?>" target="_blank">
                <div class="modal-header">
                    <h5 class="modal-title">Cetak Data Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="jenis" value="<?= $jenis ?>">

                    <div class="form-group mb-2">
                        <label>Kelas</label>
                        <select name="kelas_id" class="form-select">
                            <option value="">-- Semua Kelas --</option>
                            <?php foreach ($kelas as $k): ?>
                                <option value="<?= $k->id ?>"><?= $k->nama_kelas ?> (<?= $k->tahun_ajaran ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label>Dari Tanggal</label>
                        <input type="date" name="from_date" class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="to_date" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-warning" type="submit"><i class="fa fa-print"></i> Cetak</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $this->load->view('layouts/footer'); ?>
