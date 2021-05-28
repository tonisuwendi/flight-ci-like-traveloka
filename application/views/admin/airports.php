<h1 class="h3 mb-4 text-gray-800">Bandara</h1>

<div class="card shadow">
  <div class="card-header">
    <p class="mb-0 lead">Tambah Bandara</p>
  </div>
  <div class="card-body">
    <form action="<?= base_url(); ?>admin/<?= isset($_GET['id']) ? 'edit_airport/' . $_GET['id'] : 'airports/' ?>" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Nama Bendara</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Adi Soemarmo" value="<?= isset($_GET['name']) ? $_GET['name'] : null ?>" required autocomplete="off">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="location">Lokasi Kota</label>
            <input type="text" id="location" name="location" class="form-control" placeholder="Solo" value="<?= isset($_GET['location']) ? $_GET['location'] : null ?>" required autocomplete="off">
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary"><?= isset($_GET['id']) ? 'Edit' : 'Tambah' ?> Bandara</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="card shadow mt-5">
  <div class="card-header">
    <p class="mb-0 lead">List Bandara</p>
  </div>
  <div class="card-body">
    <?php if ($airport->num_rows() > 0) { ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Lokasi</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($airport->result_array() as $data) : ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $data['name'] ?></td>
              <td><?= $data['location'] ?></td>
              <td>
                <a href="<?= base_url(); ?>admin/airports?id=<?= $data['id'] ?>&name=<?= $data['name'] ?>&location=<?= $data['location'] ?>" class="btn btn-sm btn-info">edit</a>
                <a href="<?= base_url(); ?>admin/delete_airport/<?= $data['id'] ?>" onclick="return confirm('Yakin ingin menghapus bandara: <?= $data['name'] ?>?')" class="btn btn-sm btn-danger">hapus</a>
              </td>
            </tr>
          <?php $no++;
          endforeach; ?>
        </tbody>
      </table>
    <?php } else { ?>
      <div class="alert alert-warning">
        Belum ada bandara
      </div>
    <?php } ?>
  </div>
</div>