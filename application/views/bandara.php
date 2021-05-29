<div class="banner banner-search">
  <div class="content">
    <h2>Daftar Semua Bandara</h2>
    <div class="line"></div>
  </div>
</div>

<div class="content-container">
  <p>Kami bekerja sama dengan berbagai bandara di seluruh dunia untuk menerbangkan Anda ke mana pun Anda inginkan!</p>
  <div class="row mt-3">
    <?php foreach ($airport->result_array() as $data) : ?>
      <div class="col-md-4 mb-2">
        <div class="card">
          <div class="card-body">
            <strong><?= $data['name'] ?></strong><br>
            <span><?= $data['location'] ?></span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>