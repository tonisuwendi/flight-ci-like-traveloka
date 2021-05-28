<?php include 'templates/date.php' ?>

<div class="banner banner-search">
  <!-- <img src="<?= base_url(); ?>assets/img/pesawat.png" class="pesawat" alt="pesawat"> -->
  <div class="content">
    <h2>Terbang puas, tetap terjangkau</h2>
    <div class="line"></div>
  </div>
</div>

<div class="result-search <?= $rd ? "result-search-twoflight" : null ?> mb-5">
  <?php if ($rd) { ?>
    <div class="card yourflight">
      <div class="card-body p-0">
        <p class="font-weight-bold px-3 pt-3">Penerbanganmu</p>
        <hr>
        <div class="card" style="<?= !$departure ? "border-left: 3px solid dodgerblue" : null ?>">
          <div class="card-body p-2">
            <?php if ($departure) { ?>
              <i class="bi text-primary bi-check-circle-fill"></i>
            <?php } ?>
            <strong class="<?= $departure ? "text-primary" : null ?>">Pergi</strong>
            <p class="mb-0"><?= indoDate(isset($_GET['dd']) ? $_GET['dd'] : null, true) ?></p>
            <small class="font-weight-bold"><?= $from['location'] ?> → <?= $to['location'] ?></small>
            <?php if ($departure) { ?>
              <button onclick="window.history.back()" class="btn btn-sm btn-thisweb mt-1">Ganti Pilihan</button>
            <?php } ?>
          </div>
        </div>
        <div class="card" style="<?= $departure ? "border-left: 3px solid dodgerblue" : null ?>">
          <div class="card-body p-2">
            <strong>Pulang</strong>
            <p class="mb-0"><?= indoDate(isset($_GET['rd']) ? $_GET['rd'] : null, true) ?></p>
            <small class="font-weight-bold"><?= $to['location'] ?> → <?= $from['location'] ?></small>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="list <?= $rd ? "list-search-right" : null ?>">
    <div class="info-search shadow-sm">
      <?php if ($departure) { ?>
        <p class="font-weight-bold mb-1"><?= $to['location'] . ' (' . $to['name'] . ')' ?> → <?= $from['location'] . ' (' . $from['name'] . ')' ?></p>
        <p class="info mb-0"><?= indoDate(isset($_GET['rd']) ? $_GET['rd'] : null, true) ?><span class="mx-2">|</span><?= isset($_GET['ps']) ? $_GET['ps'] : null ?> Penumpang<span class="mx-2">|</span><?= $class ?></p>
      <?php } else { ?>
        <p class="font-weight-bold mb-1"><?= $from['location'] . ' (' . $from['name'] . ')' ?> → <?= $to['location'] . ' (' . $to['name'] . ')' ?></p>
        <p class="info mb-0"><?= indoDate(isset($_GET['dd']) ? $_GET['dd'] : null, true) ?><span class="mx-2">|</span><?= isset($_GET['ps']) ? $_GET['ps'] : null ?> Penumpang<span class="mx-2">|</span><?= $class ?></p>
      <?php } ?>
    </div>
    <div class="list-items">
      <?php if ($flights->num_rows() > 0) { ?>
        <?php foreach ($flights->result_array() as $data) : ?>
          <div class="item shadow-sm">
            <div class="content-no-action">
              <div class="content">
                <div class="icon-airlines">
                  <img src="<?= base_url(); ?>assets/img/maskapai/<?= $data['logo'] ?>" alt="maskapai <?= $data['name'] ?>">
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
                <?php if ($rd) { ?>
                  <?php if ($departure) { ?>
                    <a href="<?= base_url(); ?>booking/<?= $departure ?>?rd=<?= $data['flightId'] ?>&ps=<?= isset($_GET['ps']) ? $_GET['ps'] : null ?>" class="btn btn-thisweb px-5">Pilih</a>
                  <?php } else { ?>
                    <a href="<?= base_url(); ?>search?<?= $_SERVER['QUERY_STRING']; ?>&departure=<?= $data['flightId'] ?>" class="btn btn-thisweb px-5">Pilih</a>
                  <?php } ?>
                <?php } else { ?>
                  <a href="<?= base_url(); ?>booking/<?= $data['flightId'] ?>?ps=<?= isset($_GET['ps']) ? $_GET['ps'] : null ?>" class="btn btn-thisweb px-5">Pilih</a>
                <?php } ?>
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