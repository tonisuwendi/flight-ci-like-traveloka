<?php include  __DIR__ . '/../templates/date.php'; ?>
<h1 class="h3 mb-4 text-gray-800">Penerbangan</h1>

<div class="card shadow">
  <div class="card-header">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFlightModal">
      Tambah Penerbangan
    </button>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <td>Maskapai</td>
          <td>Keberangkatan</td>
          <td>Tiba</td>
          <td>Kursi</td>
          <td>Dipesan</td>
          <td>Harga</td>
          <td>Aksi</td>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1;
        foreach ($flight->result_array() as $data) :
          $arrivalAirport = $this->Airport_model->getAirportById($data['arrival_airport']); ?>
          <tr>
            <td>
              <img class="mb-2" height="30px" src="<?= $data['logo'] ?>" alt="maskapai logo"><br>
              <?= $data['name'] ?><br>
              <?php foreach ($class as $key => $value) {
                if ($key == $data['class']) {
                  echo "Kelas: " . $value;
                }
              } ?>
            </td>
            <td>
              <?= indoDate($data['departure_datetime'], false, true) ?><br>
              <span><?= $data['airportName'] ?> - <?= $data['airportLocation'] ?></span>
            </td>
            <td>
              <?= indoDate($data['arrival_datetime'], false, true) ?><br>
              <span><?= $arrivalAirport['name'] ?> - <?= $arrivalAirport['location'] ?></span>
            </td>
            <td><?= $data['seat'] ?></td>
            <td><?= $data['booked'] ?></td>
            <td>Rp<?= number_format($data['price'], 0, ",", ".") ?></td>
            <td>
              <button onclick="showFlightById(<?= $data['flightId'] ?>)" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addFlightModal"><i class="fa fa-edit"></i></button>
              <a href="<?= base_url(); ?>admin/delete_flight/<?= $data['flightId'] ?>" onclick="return confirm('Yakin ingin menghapus penerbangan dari maskapai: <?= $data['name'] ?>?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
        <?php $no++;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="addFlightModal" tabindex="-1" aria-labelledby="addFlightModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFlightModalLabel">Tambah Penerbangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modalCoreContent">
        <form action="<?= base_url(); ?>admin/flights" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="airline">Maskapai</label>
                  <select name="airline" required id="airline" class="form-control">
                    <option value="" selected disabled>-- Pilih Salah Satu --</option>
                    <?php foreach ($airline->result_array() as $data) : ?>
                      <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="number">No. Penerbangan</label>
                  <input type="text" required id="number" autocomplete="off" class="form-control" name="number">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="departure_airport">Bandara Keberangkatan</label>
                  <select name="departure_airport" required id="departure_airport" class="form-control">
                    <option value="" selected disabled>-- Pilih Salah Satu --</option>
                    <?php foreach ($airport->result_array() as $data) : ?>
                      <option value="<?= $data['id'] ?>"><?= $data['name'] ?> - <?= $data['location'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="arrival_airport">Bandara Tiba</label>
                  <select name="arrival_airport" required id="arrival_airport" class="form-control">
                    <option value="" selected disabled>-- Pilih Salah Satu --</option>
                    <?php foreach ($airport->result_array() as $data) : ?>
                      <option value="<?= $data['id'] ?>"><?= $data['name'] ?> - <?= $data['location'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="departure_datetime">Waktu Keberangkatan</label>
                  <input type="datetime-local" name="departure_datetime" class="form-control" id="departure_datetime" placeholder="2021-04-13 14:40" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="arrival_datetime">Waktu Tiba</label>
                  <input type="datetime-local" name="arrival_datetime" class="form-control" placeholder="2021-04-13 18:10" id="arrival_datetime" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="seat">Jumlah Kursi</label>
                  <input type="number" required id="seat" autocomplete="off" class="form-control" name="seat">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="price">Harga</label>
                  <input type="number" required id="price" autocomplete="off" class="form-control" name="price" placeholder="1000000">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="class">Kelas</label>
                  <select name="class" required id="class" class="form-control">
                    <?php foreach ($class as $key => $value) : ?>
                      <option value="<?= $key ?>"><?= $value ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>