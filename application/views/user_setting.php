<?php $this->load->view('layouts/head'); ?>
<main id="main" class="main">
  <section class="section">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title" style="font-weight: bold; font-size: 20px;">Setting Profil</h3>
            <hr>

            <form method="post" action="<?= base_url('user/update_profile') ?>">
              <input type="hidden" name="id" value="<?= $user->id ?>">
              
              <!-- Username -->
              <div class="form-group mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?= $user->username ?>" required>
              </div>

              <!-- Password -->
              <div class="form-group mb-3 mt-2">
                <label>Password Baru (kosongkan jika tidak ingin mengubah)</label>
                <div class="input-group">
                  <input type="password" name="password" class="form-control passwordInput" id="password" required>
                  <span class="input-group-text togglePassword" style="cursor: pointer;">
                    <i class="fa fa-eye"></i>
                  </span>
                </div>
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  // Toggle password visibility in all instances
  document.addEventListener('click', function (e) {
    // Check if the clicked element is a toggle password button
    if (e.target && e.target.classList.contains('togglePassword')) {
      // Find the corresponding password input field within the same modal or form
      var passwordInput = e.target.closest('.modal, .form-group').querySelector('.passwordInput');
      var eyeIcon = e.target.querySelector('i');

      // Toggle the password input type and the eye icon
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

  // Automatically toggle visibility based on role selection in "Add User" modal
  document.addEventListener("DOMContentLoaded", function() {
    // This ensures that when the page is loaded, the toggle behavior for password works
    const togglePasswordButtons = document.querySelectorAll('.togglePassword');
    togglePasswordButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        var input = this.closest('.input-group').querySelector('.passwordInput');
        var icon = this.querySelector('i');
        
        if (input.type === "password") {
          input.type = "text";
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          input.type = "password";
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }
      });
    });
  });
</script>


<?php $this->load->view('layouts/footer'); ?>
