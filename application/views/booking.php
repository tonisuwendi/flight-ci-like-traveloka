<?php include 'templates/date.php' ?>
<div class="booking">
  <h3 class="title">Pemesanan Anda</h3>
  <p class="subtitle">Isi data Anda dan review pesanan Anda.</p>
  <div class="content">
    <form action="<?= base_url(); ?>booking/insert/<?= $flight['id'] ?>?ps=<?= isset($_GET['ps']) ? $_GET['ps'] : null ?>" method="post">
      <div class="flex">
        <div class="form">
          <div class="form-item pb-0 shadow-sm">
            <h4 class="content-title">Data Pemesan</h4>
            <hr>
            <div class="form-group">
              <label for="contactDetailName">Nama Lengkap</label>
              <input type="text" id="contactDetailName" name="name" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="contactDetailTelp">No. Telp</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="justprepend1">+62</span>
                  </div>
                  <input type="text" id="contactDetailTelp" name="telp" class="form-control" aria-describedby="justprepend1" required>
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="contactDetailEmail">Email</label>
                <input type="email" id="contactDetailEmail" name="email" class="form-control" autocomplete="off" required>
              </div>
            </div>
          </div>
          <?php $ps = isset($_GET['ps']) ? $_GET['ps'] : 1;
          for ($i = 1; $i <= $ps; $i++) : ?>
            <div class="form-item pb-2 shadow-sm">
              <h4 class="content-title">Traveler <?= $i ?></h4>
              <hr>
              <div class="form-group">
                <label for="contactDetailName">Nama Lengkap</label>
                <input type="text" id="contactDetailName" name="traveler_name[]" class="form-control" autocomplete="off" required>
              </div>
            </div>
          <?php endfor; ?>
        </div>
        <div class="detail shadow-sm">
          <p class="route"><?= $from['location'] . ' → ' . $to['location'] ?></p>
          <hr>
          <p class="date">Pergi: <?= indoDate($flight['departure_datetime'], true) ?></p>
          <div class="airline">
            <p><?= $airline['name'] ?><br><?= $class ?></p>
            <img src="<?= $airline['logo'] ?>" alt="<?= $airline['name'] ?>">
          </div>
          <p class="route"><?= date('H:i', strtotime($flight['departure_datetime'])) . ' → ' . date('H:i', strtotime($flight['arrival_datetime'])) ?><span class="mx-2 text-secondary">&bull;</span><?= timeDifferent($flight['departure_datetime'], $flight['arrival_datetime']) ?>
          </p>
          <hr>
          <button type="submit" class="btn btn-block btn-primary">Lanjutkan</button>
        </div>
      </div>
    </form>
  </div>
</div>