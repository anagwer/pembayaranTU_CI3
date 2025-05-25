<?php $this->load->view('layouts/head'); ?>
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title" style="font-weight: bold; font-size: 20px;">Manajemen User</h3>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fa-solid fa-plus"></i> Tambah
                        </button>
                        <hr>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($users as $u): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $u->username ?></td>
                                        <td><?= ucfirst($u->role) ?></td>
                                        <td><?= $u->created_at ?></td>
                                        <td>
                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editUser<?= $u->id ?>">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>

                                            <!-- Modal delete -->
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUser<?= $u->id ?>">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>

                                            <!-- Modal Edit User -->
											<div class="modal fade" id="editUser<?= $u->id ?>" tabindex="-1">
													<div class="modal-dialog">
															<div class="modal-content">
																	<form method="post" action="<?= base_url('user/update') ?>">
																			<div class="modal-header">
																					<h5 class="modal-title">Edit User</h5>
																					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
																			</div>
																			<div class="modal-body">
																					<input type="hidden" name="id" value="<?= $u->id ?>">
																					<div class="form-group">
																							<label>Username</label>
																							<input type="text" name="username" value="<?= $u->username ?>" class="form-control" required>
																					</div>
																					<div class="form-group mt-2">
																							<label>Role</label>
																							<select name="role" class="form-select" required>
																									<option value="Siswa" <?= $u->role == 'Siswa' ? 'selected' : '' ?>>Siswa</option>
																									<option value="Ortu" <?= $u->role == 'Ortu' ? 'selected' : '' ?>>Ortu</option>
																									<option value="Admin" <?= $u->role == 'Admin' ? 'selected' : '' ?>>Admin</option>
																							</select>
																					</div>
																					<div class="form-group mt-2">
																							<label>Password (Kosongkan jika tidak ingin diubah)</label>
																							<div class="input-group">
																									<input type="password" name="password" class="form-control passwordInput" required>
																									<span class="input-group-text togglePassword" style="cursor: pointer;">
																											<i class="fa fa-eye"></i>
																									</span>
																							</div>
																					</div>
																			</div>
																			<div class="modal-footer">
																					<button class="btn btn-primary" type="submit">Simpan Perubahan</button>
																					<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
																			</div>
																	</form>
															</div>
													</div>
											</div>

                                            <!-- Modal Delete User -->
                                            <div class="modal fade" id="deleteUser<?= $u->id ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post" action="<?= base_url('user/delete/' . $u->id) ?>">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Hapus User</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus user <strong><?= $u->username ?></strong>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Tambah User -->
                        <div class="modal fade" id="addUserModal" tabindex="-1">
									<div class="modal-dialog">
											<div class="modal-content">
													<form method="post" action="<?= base_url('user/add') ?>">
															<div class="modal-header">
																	<h5 class="modal-title">Tambah User</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
															</div>
															<div class="modal-body">
																	<div class="form-group">
																			<label>Role</label>
																			<select name="role" class="form-select" id="roleSelect" onchange="toggleUserField()" required>
																					<option value="Siswa">Siswa</option>
																					<option value="Admin">Admin</option>
																			</select>
																	</div>
																	<div class="form-group" id="siswaField" style="display: none;">
																			<label>Pilih NIS Siswa</label>
																			<select name="nis" class="form-select">
																					<?php foreach ($siswa as $s): ?>
																							<option value="<?= $s->nis ?>"><?= $s->nama ?> (<?= $s->nis ?>)</option>
																					<?php endforeach; ?>
																			</select>
																	</div>
																	<div class="form-group" id="adminField" style="display: none;">
																			<label>Username</label>
																			<input type="text" name="username" class="form-control">
																	</div>
																	<div class="form-group mt-2">
																			<label>Password</label>
																			<div class="input-group">
																					<input type="password" name="password" class="form-control passwordInput" required>
																					<span class="input-group-text togglePassword" style="cursor: pointer;">
																							<i class="fa fa-eye"></i>
																					</span>
																			</div>
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

                        <script>
                            function toggleUserField() {
                                let role = document.getElementById('roleSelect').value;
                                document.getElementById('siswaField').style.display = 'none';
                                document.getElementById('adminField').style.display = 'none';

                                if (role === 'Siswa') {
                                    document.getElementById('siswaField').style.display = 'block';
                                } else if (role === 'Admin') {
                                    document.getElementById('adminField').style.display = 'block';
                                }
                            }

                            document.addEventListener("DOMContentLoaded", function() {
                                toggleUserField();
                            });
                        </script>

                        <script>
                            document.addEventListener('click', function (e) {
									if (e.target && e.target.classList.contains('togglePassword')) {
											// Cari elemen input password di dalam modal yang diklik
											var passwordInput = e.target.closest('.modal').querySelector('.passwordInput');
											var eyeIcon = e.target.querySelector('i');

											// Toggle tipe input dan ikon mata
											if (passwordInput.type === "password") {
													passwordInput.type = "text";
													eyeIcon.classList.remove('fa-eye');
													eyeIcon.classList.add('fa-eye-slash');
											} else {
													passwordInput.type = "password";
													eyeIcon.classList.remove('fa-eye-slash');
													eyeIcon.classList.add('fa-eye');
											}
									}
							});


                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php $this->load->view('layouts/footer'); ?>
