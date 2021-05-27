<div class="auth-wrapper mt-4">
  <p class="lead">Daftar Akun!</p>
  <?= $this->session->flashdata('alert'); ?>
  <hr>
  <form action="<?= base_url(); ?>home/post_register?<?= $_SERVER['QUERY_STRING']; ?>" method="post">
    <div class="form-group">
      <label for="name">Nama Lengkap</label>
      <input type="text" id="name" name="name" autocomplete="off" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" autocomplete="off" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" autocomplete="off" class="form-control" required>
    </div>
    <button type="submit" class="btn my-3 btn-block btn-primary px-4">Daftar</button>
    <hr>
    <small><a href="<?= base_url(); ?>login?<?= $_SERVER['QUERY_STRING']; ?>" class="text-primary">Sudah punya akun? Login sekarang.</a></small>
  </form>
</div>