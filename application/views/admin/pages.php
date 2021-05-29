<h1 class="h4 mb-2 text-gray-800">Halaman</h1>

<div class="card shadow mb-4">
  <div class="card-header">
    <a href="<?= base_url(); ?>admin/add_page" class="btn btn-primary">Tambah Halaman</a>
  </div>
  <div class="card-body">
    <?php if ($pages->num_rows() > 0) { ?>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center" width="60">No.</th>
              <th>Judul Halaman</th>
              <th>Slug</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot></tfoot>
          <tbody class="data-content">
            <?php $no = 1 ?>
            <?php foreach ($pages->result_array() as $data) : ?>
              <tr>
                <td class="text-center"><?= $no ?></td>
                <td><?= $data['title']; ?></td>
                <td><?= $data['slug']; ?></td>
                <td>
                  <a target="_blank" href="<?= base_url() . $data['slug']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                  <a href="<?= base_url(); ?>admin/edit_page/<?= $data['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                  <a href="<?= base_url(); ?>admin/delete_page/<?= $data['id']; ?>" onclick="return confirm('Yakin ingin menghapus halaman?');" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php $no++ ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      <div class="alert alert-warning" role="alert">
        Opss, halaman masih kosong, yuk tambah sekarang.
      </div>
    <?php } ?>
  </div>
</div>