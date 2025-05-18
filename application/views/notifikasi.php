<?php $this->load->view('layouts/head'); ?>
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Notifikasi</h5>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
                                        <th>Waktu</th>
										<?php if ($this->session->userdata('role') == 'Ortu'): ?>
                                        <th>Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($notifikasi as $n): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $n->nis ?></td>
                                        <td><?= $n->nama ?></td>
                                        <td><?= $n->pesan ?></td>
                                        <td>
                                            <?php if ($n->is_read): ?>
                                                <span class="badge bg-success">Dibaca</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Belum Dibaca</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($n->created_at)) ?></td>
                                            <?php if (!$n->is_read && $this->session->userdata('role') == 'Ortu'): ?>
                                        <td>
                                                <form method="post" action="<?= base_url('notifikasi/mark_as_read') ?>" style="display:inline-block;">
                                                    <input type="hidden" name="id" value="<?= $n->id ?>">
                                                    <button type="submit" class="btn btn-success btn-sm" title="Tandai sudah dibaca">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                </form>
                                        </td>
                                            <?php endif; ?>
                                    </tr>
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
<?php $this->load->view('layouts/footer'); ?>
