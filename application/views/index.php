<div class="banner">
  <!-- <img src="<?= base_url(); ?>assets/img/pesawat.png" class="pesawat" alt="pesawat"> -->
  <div class="content">
    <h2>Hai, Mau Terbang Kemana Hari Ini?</h2>
    <div class="line"></div>
  </div>
</div>

<div class="booking-box shadow">
  <div class="row">
    <div class="col-md-8">
      <div class="form-row">
        <div class="form-group col-6">
          <label for="cityFrom">Kota Asal</label>
          <select id="cityFrom" class="form-control">
            <?php foreach ($airport->result_array() as $data) : ?>
              <option value="<?= $data['id']; ?>"><?= $data['name']; ?> - <?= $data['location'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group col-6">
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
        <div class="form-group col-6">
          <label for="departureDate">Tanggal Pergi</label>
          <input type="date" onchange="removeErrorInput('departureDate', 'msgTextDangerDepartureDate')" id="departureDate" min="<?= date("Y-m-d") ?>" class="form-control">
          <small style="display: none;" id="msgTextDangerDepartureDate" class="text-danger">Tanggal pergi harus diisi</small>
        </div>
        <div class="form-group col-6">
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