<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistem Pembayaran TU</title>

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Nunito:400,600|Poppins:400,500,600" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
	  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>

<main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="col-lg-12 col-md-6 pt-4 text-center">
                  <div class="pt-2 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login Sistem</h5>
                  </div>
                </div>

                <?php if (isset($error)) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif; ?>

                <form class="row g-3 needs-validation" method="POST" action="<?= base_url('auth/login') ?>">

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="yourUsername" placeholder="Masukkan username" required>
                    <div class="invalid-feedback">Please enter your username.</div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Masukkan password" required>
                      <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()" tabindex="-1">
                        <i class="fa fa-eye" id="toggleIcon"></i>
                      </button>
                    </div>
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>

                  <div class="col-12">
                    <input type="submit" name="submit" class="btn btn-primary w-100" value="Login">
                  </div>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<!-- Back to top -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>

<!-- Vendor JS Files -->
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Toggle Password Script -->
<script>
  function togglePassword() {
    const passwordInput = document.getElementById("yourPassword");
    const icon = document.getElementById("toggleIcon");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
			Icon.classList.remove('fa-eye');
			Icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = "password";
			Icon.classList.remove('fa-eye-slash');
			Icon.classList.add('fa-eye');
    }
  }
</script>

<!-- Main JS File -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>

</body>
</html>
