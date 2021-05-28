<h1 class="h3 mb-4 text-gray-800">Maskapai Penerbangan</h1>

<div class="card shadow">
  <div class="card-header">
    <p class="mb-0 lead">Tambah Maskapai</p>
  </div>
  <div class="card-body">
    <form action="<?= base_url(); ?>admin/<?= isset($_GET['id']) ? 'edit_airline/' . $_GET['id'] : 'airlines/' ?>" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Nama Maskapai</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Garuda Indonesia" value="<?= isset($_GET['name']) ? $_GET['name'] : null ?>" required autocomplete="off">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="logo">Logo Maskapai</label>
            <input type="file" name="img" id="logo" class="form-control-file">
            <small style="display: <?= isset($_GET['logo']) ? "block" : "none" ?>" class="text-secondary">Pilih file baru untuk mengganti logo</small>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary"><?= isset($_GET['id']) ? 'Edit' : 'Tambah' ?> Maskapai</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card shadow mt-5">
  <div class="card-header">
    <p class="mb-0 lead">List Maskapai</p>
  </div>
  <div class="card-body">
    <?php if ($airline->num_rows() > 0) { ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Logo</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($airline->result_array() as $data) : ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $data['name'] ?></td>
              <td><img height="30px" src="<?= base_url(); ?>assets/img/maskapai/<?= $data['logo'] ?>" alt="<?= $data['name'] ?>"></td>
              <td>
                <a href="<?= base_url(); ?>admin/airlines?id=<?= $data['id'] ?>&name=<?= $data['name'] ?>&logo=<?= $data['logo'] ?>" class="btn btn-sm btn-info">edit</a>
                <a href="<?= base_url(); ?>admin/delete_airline/<?= $data['id'] ?>" onclick="return confirm('Yakin ingin menghapus maskapai: <?= $data['name'] ?>?')" class="btn btn-sm btn-danger">hapus</a>
              </td>
            </tr>
          <?php $no++;
          endforeach; ?>
        </tbody>
      </table>
    <?php } else { ?>
      <div class="alert alert-warning">
        Belum ada maskapai
      </div>
    <?php } ?>
  </div>
</div>