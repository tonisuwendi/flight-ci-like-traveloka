<?php include 'templates/date.php' ?>

<div class="banner banner-search">
  <!-- <img src="<?= base_url(); ?>assets/img/pesawat.png" class="pesawat" alt="pesawat"> -->
  <div class="content">
    <h2>Terbang puas, tetap terjangkau</h2>
    <div class="line"></div>
  </div>
</div>

<div class="result-search mb-5">
  <div class="list">
    <div class="info-search shadow-sm">
      <p class="font-weight-bold mb-1"><?= $from['location'] . ' (' . $from['name'] . ')' ?> → <?= $to['location'] . ' (' . $to['name'] . ')' ?></p>
      <p class="info mb-0"><?= indoDate(isset($_GET['dd']) ? $_GET['dd'] : null, true) ?><span class="mx-2">|</span><?= isset($_GET['ps']) ? $_GET['ps'] : null ?> Penumpang<span class="mx-2">|</span><?= $class ?></p>
    </div>
    <div class="list-items">
      <?php if ($flights->num_rows() > 0) { ?>
        <?php foreach ($flights->result_array() as $data) : ?>
          <div class="item shadow-sm">
            <div class="content-no-action">
              <div class="content">
                <div class="icon-airlines">
                  <img src="<?= $data['logo'] ?>" alt="maskapai <?= $data['name'] ?>">
                  <p><?= $data['name'] ?></p>
                </div>
              </div>
              <div class="time">
                <div class="item-time">
                  <p class="clock mb-1"><?= date('H:i', strtotime($data['departure_datetime'])) ?></p>
                  <p class="city"><?= $from['name'] ?> <br />
                    <?= $from['location'] ?></p>
                </div>
                <div>
                  <br>
                  <img src="<?= base_url(); ?>assets/img/pesawat.svg" alt="icon pesawat" class="arrow-plane">
                </div>
                <div class="item-time">
                  <p class="clock mb-1"><?= date('H:i', strtotime($data['arrival_datetime'])) ?></p>
                  <p class="city"><?= $to['name'] ?> <br />
                    <?= $to['location'] ?></p>
                </div>
                <div class="item-time">
                  <p class="clock mb-1"><?= timeDifferent($data['departure_datetime'], $data['arrival_datetime']) ?></p>
                  <p class="city">Langsung</p>
                </div>
              </div>
            </div>
            <div class="action">
              <p class="price mb-2"><span>Rp <?= number_format($data['price'], 0, ',', '.') ?></span>/org</p>
              <?php if ($this->session->userdata('login')) { ?>
                <a href="<?= base_url(); ?>booking/<?= $data['flightId'] ?>?ps=<?= isset($_GET['ps']) ? $_GET['ps'] : null ?>" class="btn btn-thisweb px-5">Pilih</a>
              <?php } else { ?>
                <a href="<?= base_url(); ?>login?redirect=search?<?= $_SERVER['QUERY_STRING']; ?>" class="btn btn-thisweb px-5">Pilih</a>
              <?php } ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php } else { ?>
        <div class="alert alert-warning px-4 py-4">
          <strong class="alert-heading"><i class="bi bi-info-circle-fill"></i> Penerbangan tidak tersedia</strong><br>
          Jadwal dan rute penerbangan yang kamu pilih tidak tersedia. Coba ganti pencarian lain.
        </div>
        <div class="text-center">
          <a href="<?= base_url(); ?>" class="btn btn-thisweb">Ganti Pencarian</a>
        </div>
      <?php } ?>
    </div>
  </div>
</div>