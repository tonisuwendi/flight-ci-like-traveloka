<div class="wrapper">
  <div class="menu">
    <?php include 'menu.php' ?>
  </div>
  <div class="content">
    <h3 class="title">Pesanan Saya</h3>
    <hr>
    <?php if ($booked->num_rows() > 0) { ?>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No. Pesanan</th>
              <th>Rute</th>
              <th>Harga</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($booked->result_array() as $data) :
              $departureAirport = $this->Airport_model->getAirportById($data['departure_airport']);
              $arrivalAirport = $this->Airport_model->getAirportById($data['arrival_airport']); ?>
              <tr>
                <td><?= $data['booking_id'] ?></td>
                <td><?= $departureAirport['location'] . ' → ' . $arrivalAirport['location'] ?></td>
                <td>Rp<?= number_format(($data['bookedPrice'] * $data['passanger']) + ($data['arrival_price'] * $data['passanger']), 0, ",", ".") ?></td>
                <?php if ($data['status'] == 0) { ?>
                  <td><small>Belum memilih metode bayar</small></td>
                <?php } else if ($data['status'] == 1) { ?>
                  <td>Belum lunas</td>
                <?php } else if ($data['status'] == 2) { ?>
                  <td>Selesai</td>
                <?php } ?>
                <td>
                  <a href="<?= base_url(); ?>user/detail_booking/<?= $data['bookedId'] ?>" class="btn btn-sm btn-info"><i class="bi bi-eye-fill"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      <div class="alert alert-warning">
        <strong class="alert-heading"><i class="bi bi-info-circle-fill"></i> Belum Ada Pemesanan</strong><br>
        Kamu belum pernah melakukan pemesanan tiket pesawat sehingga daftar pesanan saya kosong.
      </div>
    <?php } ?>
  </div>
</div>