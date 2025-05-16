<?php $this->load->view('layouts/head'); ?>
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Kelas</h5>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKelasModal"><i class="fa-solid fa-plus"></i> Tambah</button>
                            <hr>

                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($kelas as $k): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $k->nama_kelas ?></td>
                                            <td><?= $k->tahun_ajaran ?></td>
                                            <td><?= $k->status ?></td>
                                            <td>
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editKelas<?= $k->id ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteKelas<?= $k->id ?>"><i class="fa-regular fa-trash-can"></i></button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editKelas<?= $k->id ?>" tabindex="-1">
                                            <div class="modal-dialog">
												<form method="post" action="<?= base_url('kelas/update') ?>">
													<div class="modal-header">
														<h5 class="modal-title">Edit Kelas</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
													</div>
													<div class="modal-body">
														<input type="hidden" name="id" value="<?= $k->id ?>">
														<div class="form-group">
															<label>Nama Kelas</label>
															<input type="text" name="nama_kelas" class="form-control" value="<?= $k->nama_kelas ?>" required>
														</div>
														<div class="form-group">
															<label>Tahun Ajaran</label>
															<input type="text" name="tahun_ajaran" class="form-control" value="<?= $k->tahun_ajaran ?>" required>
														</div>
														<div class="form-group">
															<label>Status</label>
															<select name="status" class="form-select">
																<option <?= $k->status == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
																<option <?= $k->status == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
															</select>
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary">Simpan</button>
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
													</div>
												</form>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteKelas<?= $k->id ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post" action="<?= base_url('kelas/delete') ?>">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Hapus Kelas</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Yakin ingin menghapus kelas <strong><?= $k->nama_kelas ?></strong>?</p>
                                                            <input type="hidden" name="id" value="<?= $k->id ?>">
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
    <div class="modal fade" id="addKelasModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="<?= base_url('kelas/add') ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-select">
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                            </select>
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

    <?php $this->load->view('layouts/footer'); ?>
</body>
</html>
