<div class="banner banner-search">
  <div class="content">
    <h2>Partner Maskapai</h2>
    <div class="line"></div>
  </div>
</div>

<div class="content-container">
  <p>Kami bekerja sama dengan berbagai maskapai penerbangan di seluruh dunia untuk menerbangkan Anda ke mana pun Anda inginkan!</p>
  <div class="img">
    <?php foreach ($airline->result_array() as $data) : ?>
      <img src="<?= base_url(); ?>assets/img/maskapai/<?= $data['logo'] ?>" alt="maskapai <?= $data['name'] ?>">
    <?php endforeach; ?>
  </div>
</div>