<div class="modal fade" id="authLoginModal" tabindex="-1" aria-labelledby="authLoginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Login Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" autocomplete="off" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="off" class="form-control" required>
          </div>
          <button type="submit" class="btn my-3 btn-block btn-primary px-4">Login</button>
          <hr>
          <small><a href="#" data-toggle="modal" data-target="#authRegisterModal" data-dismiss="modal" class="text-primary">Belum punya akun? Daftar dulu.</a></small>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="authRegisterModal" tabindex="-1" aria-labelledby="authRegisterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Daftar Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url(); ?>home/register?redirect=<?= $this->uri->segment(1); ?>" method="post">
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" autocomplete="off" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="username2">Username</label>
            <input type="text" id="username2" name="username" autocomplete="off" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" autocomplete="off" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password2">Password</label>
            <input type="password" id="password2" name="password" autocomplete="off" class="form-control" required>
          </div>
          <button type="submit" class="btn my-3 btn-block btn-primary px-4">Daftar</button>
          <hr>
          <small><a href="#" data-toggle="modal" data-target="#authLoginModal" data-dismiss="modal" class="text-primary">Sudah punya akun? Login sekarang.</a></small>
        </form>
      </div>
    </div>
  </div>
</div>