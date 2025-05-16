<?php $this->load->view('layouts/head'); ?>

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card text-center p-3" style="padding:2%;height:125px;">
                        <h3>Jumlah Kategori<br><b><?= $jumlah_kategori ?></b></h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-center p-3" style="padding:2%;height:125px;">
                        <h3>Jumlah Sub Kategori<br><b><?= $jumlah_sub_kategori ?></b></h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-center p-3" style="padding:2%;height:125px;">
                        <h3>Jumlah Anggaran<br><b><?= $jumlah_anggaran ?></b></h3>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card text-center p-3" style="padding:2%;height:125px;">
                        <h3>Jumlah Detail Anggaran<br><b><?= $jumlah_detail_anggaran ?></b></h3>
                    </div>
                </div>

                <!-- Modal Notification -->
                <?php if ($this->input->get('login') == 'success'): ?>
                    <div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="loginSuccessModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loginSuccessModalLabel">Login Berhasil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Selamat datang! <?= $this->session->userdata('NAMA'); ?> Anda telah berhasil login.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var loginSuccessModal = new bootstrap.Modal(document.getElementById('loginSuccessModal'));
                            loginSuccessModal.show();
                        });
                    </script>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php $this->load->view('layouts/footer'); ?>
</body>
</html>
