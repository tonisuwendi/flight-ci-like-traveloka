<h1 class="h4 mb-2 text-gray-800">Tambah Halaman</h1>

<div class="card shadow mb-4">
  <div class="card-body">
    <?= $this->session->flashdata('alert'); ?>
    <form action="<?= base_url(); ?>admin/add_page" method="post">
      <div class="form-group">
        <label for="title">Judul Halaman</label>
        <input type="text" class="form-control" id="title" name="title" required autocomplete="off" />
      </div>
      <div class="form-group">
        <label for="slug">Slug Halaman</label>
        <input type="text" class="form-control" id="slug" name="slug" required autocomplete="off" />
        <small class="text-muted">Gunakan tanda - jika lebih dari 1 kata. Contoh: about-us</small>
      </div>
      <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
      </div>
      <button type="submit" class="btn mr-2 btn-primary">Tambah Halaman</button>
      <a href="<?= base_url(); ?>admin/pages" class="btn px-4 btn-danger">Batal</a>
    </form>
  </div>
</div>