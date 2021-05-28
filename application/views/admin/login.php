<div class="auth-wrapper mt-5">
  <p class="lead">Login Admin!</p>
  <?= $this->session->flashdata('alert'); ?>
  <hr>
  <form action="<?= base_url(); ?>home/post_login_admin" method="post">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" autocomplete="off" class="form-control" required value="<?= $this->session->flashdata('username'); ?>">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" autocomplete="off" class="form-control" required>
    </div>
    <button type="submit" class="btn my-3 btn-block btn-primary px-4">Login</button>
  </form>
</div>