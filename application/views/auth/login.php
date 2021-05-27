<div class="auth-wrapper mt-5">
  <p class="lead">Login Akun!</p>
  <?= $this->session->flashdata('alert'); ?>
  <hr>
  <form action="<?= base_url(); ?>home/post_login?<?= $_SERVER['QUERY_STRING']; ?>" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" autocomplete="off" class="form-control" required value="<?= $this->session->flashdata('username'); ?>">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" autocomplete="off" class="form-control" required>
    </div>
    <button type="submit" class="btn my-3 btn-block btn-primary px-4">Login</button>
    <hr>
    <small><a href="<?= base_url(); ?>register?<?= $_SERVER['QUERY_STRING']; ?>" class="text-primary">Belum punya akun? Daftar sekarang.</a></small>
  </form>
</div>