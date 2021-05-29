<h1 class="h4 mb-2 text-gray-800">Edit Halaman</h1>

<div class="card shadow mb-4">
  <div class="card-body">
    <?php echo $this->session->flashdata('failed'); ?>
    <form action="<?= base_url(); ?>admin/edit_page/<?= $page['id']; ?>" method="post">
      <div class="form-group">
        <label for="title">Judul Halaman</label>
        <input type="text" class="form-control" id="title" name="title" required autocomplete="off" value="<?= $page['title']; ?>" />
      </div>
      <div class="form-group">
        <label for="slug">Slug Halaman</label>
        <input type="text" class="form-control" id="slug" name="slug" required autocomplete="off" value="<?= $page['slug']; ?>" />
        <small class="text-muted">Gunakan tanda - jika lebih dari 1 kata. Contoh: about-us</small>
      </div>
      <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" cols="30" rows="10"><?= $page['content']; ?></textarea>
      </div>
      <button type="submit" class="btn mr-2 btn-primary">Edit Halaman</button>
      <a href="<?= base_url(); ?>admin/pages" class="btn btn-danger px-4">Batal</a>
    </form>
  </div>
</div>