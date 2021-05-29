<h1 class="h3 mb-4 text-gray-800">Edit Profil</h1>

<div class="card shadow">
  <div class="card-body">
    <form action="<?= base_url(); ?>admin/post_edit" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" autocomplete="off" class="form-control" value="<?= $admin['name'] ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" autocomplete="off" class="form-control" value="<?= $admin['username'] ?>">
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" id="password" autocomplete="off" class="form-control">
            <small class="text-secondary">Kosongi jika tidak ingin mengubah password</small>
          </div>
        </div>
      </div>
      <button class="btn btn-primary">Ubah Profil</button>
    </form>
  </div>
</div>