<?php include 'templates/date.php' ?>
<div class="banner">
  <div class="content">
    <h2>Hai, Mau Terbang Kemana Hari Ini?</h2>
    <div class="line"></div>
  </div>
</div>

<div class="booking-box shadow">
  <div class="row">
    <div class="col-md-8">
      <div class="form-row">
        <div class="form-group col-sm-6">
          <label for="cityFrom">Kota Asal</label>
          <select id="cityFrom" class="form-control">
            <?php foreach ($airport->result_array() as $data) : ?>
              <option value="<?= $data['id']; ?>"><?= $data['name']; ?> - <?= $data['location'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col-sm-6">
          <label for="cityTo">Kota Tujuan</label>
          <select id="cityTo" onchange="removeErrorInput('cityTo', 'msgTextDangerCityTo')" class="form-control">
            <?php foreach ($airport2->result_array() as $data) : ?>
              <option value="<?= $data['id']; ?>"><?= $data['name']; ?> - <?= $data['location'] ?></option>
            <?php endforeach; ?>
          </select>
          <small style="display: none;" id="msgTextDangerCityTo" class="text-danger">Kota asal dan kota tujuan tidak boleh sama</small>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-sm-6">
          <label for="departureDate">Tanggal Pergi</label>
          <input type="date" onchange="removeErrorInput('departureDate', 'msgTextDangerDepartureDate')" id="departureDate" min="<?= date("Y-m-d") ?>" class="form-control">
          <small style="display: none;" id="msgTextDangerDepartureDate" class="text-danger">Tanggal pergi harus diisi</small>
        </div>
        <div class="form-group col-sm-6">
          <div class="custom-control custom-checkbox mb-2">
            <input type="checkbox" class="custom-control-input" id="checkboxReturnDate">
            <label class="custom-control-label" for="checkboxReturnDate">Tanggal Pulang</label>
          </div>
          <input type="date" onchange="removeErrorInput('returnDate', 'msgTextDangerReturnDate')" id="returnDate" min="<?= date("Y-m-d") ?>" class="form-control form-control-tanggal-pulang">
          <small style="display: none;" id="msgTextDangerReturnDate" class="text-danger">Tanggal pulang harus lebih dari tanggal pergi</small>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="countPassengers">Jumlah Penumpang</label>
        <input type="number" onchange="removeErrorInput('countPassengers', 'msgTextDangerCountPassengers')" id="countPassengers" value="1" class="form-control">
        <small style="display: none;" id="msgTextDangerCountPassengers" class="text-danger">Jumlah penumpang minimal 1</small>
      </div>
      <div class="form-group">
        <label for="seatClass">Kelas Penerbangan</label>
        <select id="seatClass" class="form-control">
          <?php foreach ($class as $key => $value) : ?>
            <option value="<?= $key ?>"><?= $value ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>
  <button onclick="searchTicket()" class="btn btn-thisweb mt-2 float-right px-4"><i class="bi bi-search"></i> Cari Tiket</button>
  <div class="clearfix"></div>
</div>

<div class="promo">
  <h3 class="title"><i class="bi text-danger bi-lightning-charge-fill"></i> Lagi diskon nih..</h3>
  <div class="body-promo">
    <?php if ($promo->num_rows() > 0) { ?>
      <div class="row">
        <?php foreach ($promo->result_array() as $data) :
          $arrivalAirport = $this->Airport_model->getAirportById($data['arrival_airport']); ?>
          <div class="col-md-4 mb-4">
            <div class="item shadow-sm">
              <div class="img">
                <img src="<?= base_url(); ?>assets/img/maskapai/<?= $data['logo'] ?>" alt="maskapai <?= $data['name'] ?>">
                <p class="mt-3 text-center"><?= $data['name'] ?></p>
                <p class="mb-1"><i class="bi bi-cursor-fill"></i> <?= $data['airportLocation'] . ' → ' . $arrivalAirport['location'] ?></p>
                <p class="text-secondary mb-1"><del>Rp <?= number_format($data['price'], 0, ",", ".") ?></del></p>
                <h5 class="mb-0 text-primary">Rp <?= number_format(($data['price']) - ($data['price'] * $data['discount'] / 100), 0, ",", ".") ?></h5>
                <small class="text-secondary"><i class="bi bi-clock"></i> <?= indoDate($data['departure_datetime'], false, true) ?></small>
                <?php if ($this->session->userdata('login')) { ?>
                  <a href="<?= base_url(); ?>booking/<?= $data['flightId'] ?>?ps=1" class="btn btn-block btn-primary mt-2">Pilih</a>
                <?php } else { ?>
                  <a href="<?= base_url(); ?>login?redirect=booking/<?= $data['flightId'] ?>?ps=1" class="btn btn-block btn-primary mt-2">Pilih</a>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php } else { ?>
      <div class="alert alert-warning">
        <strong class="alert-heading"><i class="bi bi-info-circle-fill"></i> Belum ada promo</strong><br>
        Sayang sekali, saat ini belum ada promo nih. Lihat lagi nanti yaa..
      </div>
    <?php } ?>
  </div>
</div>