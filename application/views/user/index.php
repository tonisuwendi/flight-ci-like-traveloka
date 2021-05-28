<div class="wrapper">
  <div class="menu">
    <?php include 'menu.php' ?>
  </div>
  <div class="content">
    <h3 class="title">Profilku</h3>
    <hr>
    <?= $this->session->flashdata('alert'); ?>
    <form action="<?= base_url(); ?>user/edit_user" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" value="<?= $user['name'] ?>" id="name" autocomplete="off" name="name" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" value="<?= $user['username'] ?>" id="username" autocomplete="off" name="username" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="<?= $user['email'] ?>" id="email" autocomplete="off" name="email" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" class="form-control">
            <small class="text-secondary">Kosongi jika tidak ingin mengubah password</small>
          </div>
        </div>
      </div>
      <button class="btn btn-primary px-3">Update Profil</button>
    </form>
  </div>
</div>