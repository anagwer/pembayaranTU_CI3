<?php $this->load->view('layouts/head'); ?>
<main id="main" class="main">
	<section class="section">
		<div class="row">
            <div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Data Siswa</h5>
						<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSiswaModal">
							<i class="fa-solid fa-plus"></i> Tambah
						</button>
						<hr>

						<div class="table-responsive">
							<table class="table datatable">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>NIS</th>
										<th>Kelas</th>
										<th>No HP</th>
										<th>Alamat</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; foreach ($siswa as $s): ?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $s->nama ?></td>
										<td><?= $s->nis ?></td>
										<td><?= $s->nama_kelas ?> (<?= $s->tahun_ajaran ?>)</td>
										<td><?= $s->no_hp ?></td>
										<td><?= $s->alamat ?></td>
										<td>
											<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editSiswa<?= $s->id ?>"><i class="fa-solid fa-pen-to-square"></i></button>
											<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSiswa<?= $s->id ?>"><i class="fa-regular fa-trash-can"></i></button>
										</td>
									</tr>

									<!-- Modal Edit -->
									<div class="modal fade" id="editSiswa<?= $s->id ?>" tabindex="-1">
										<div class="modal-dialog">
        									<div class="modal-content">
												<form method="post" action="<?= base_url('siswa/update') ?>" class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Edit Siswa</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<input type="hidden" name="id" value="<?= $s->id ?>">
														<div class="form-group">
															<label>Nama</label>
															<input type="text" name="nama" value="<?= $s->nama ?>" class="form-control" required>
														</div>
														<div class="form-group">
															<label>NIS</label>
															<input type="text" name="nis" value="<?= $s->nis ?>" class="form-control" required>
														</div>
														<div class="form-group">
															<label>Kelas</label>
															<select name="kelas_id" class="form-select" required>
																<?php foreach ($kelas as $k): ?>
																	<option value="<?= $k->id ?>" <?= $s->kelas_id == $k->id ? 'selected' : '' ?>>
																		<?= $k->nama_kelas ?> (<?= $k->tahun_ajaran ?>)
																	</option>
																<?php endforeach; ?>
															</select>
														</div>
														<div class="form-group">
															<label>No HP</label>
															<input type="text" name="no_hp" value="<?= $s->no_hp ?>" class="form-control">
														</div>
														<div class="form-group">
															<label>Alamat</label>
															<textarea name="alamat" class="form-control"><?= $s->alamat ?></textarea>
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

									<!-- Modal Delete -->
									<div class="modal fade" id="deleteSiswa<?= $s->id ?>" tabindex="-1">
										<div class="modal-dialog">
                                            <div class="modal-content">
												<form method="post" action="<?= base_url('siswa/delete') ?>" class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Hapus Siswa</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<p>Yakin ingin menghapus <strong><?= $s->nama ?></strong>?</p>
														<input type="hidden" name="id" value="<?= $s->id ?>">
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

<!-- Modal Add Siswa -->
<div class="modal fade" id="addSiswaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
			<form method="post" action="<?= base_url('siswa/add') ?>" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Siswa</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" required>
					</div>
					<div class="form-group">
						<label>NIS</label>
						<input type="text" name="nis" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Kelas</label>
						<select name="kelas_id" class="form-select" required>
							<option value="">-- Pilih Kelas --</option>
							<?php foreach ($kelas as $k): ?>
								<option value="<?= $k->id ?>"><?= $k->nama_kelas ?> (<?= $k->tahun_ajaran ?>)</option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>No HP</label>
						<input type="text" name="no_hp" class="form-control">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
				</div>
			</form>
    	</div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>
