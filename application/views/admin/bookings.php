<h1 class="h3 mb-4 text-gray-800">Pesanan</h1>

<div class="card shadow">
  <div class="card-body">
    <?php if ($booking->num_rows() > 0) { ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>No. Pesanan</td>
            <td>Pemesan</td>
            <td>Rute</td>
            <td>Harga</td>
            <td>Status</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($booking->result_array() as $data) :
            $departureAirport = $this->Airport_model->getAirportById($data['departure_airport']);
            $arrivalAirport = $this->Airport_model->getAirportById($data['arrival_airport']);
            if ($data['arrival_flight_id'] == 0) {
              $iconflowplane = ' → ';
            } else {
              $iconflowplane = ' ⇄ ';
            } ?>
            <tr>
              <td><?= $data['booking_id'] ?></td>
              <td><?= $data['name'] ?></td>
              <td><?= $departureAirport['location'] . $iconflowplane . $arrivalAirport['location'] ?></td>
              <td>Rp<?= number_format(($data['bookedPrice'] * $data['passanger']) + ($data['arrival_price'] * $data['passanger']), 0, ",", ".") ?></td>
              <?php if ($data['status'] == 0) { ?>
                <td><small>Belum memilih metode bayar</small></td>
              <?php } else if ($data['status'] == 1) { ?>
                <td>Belum lunas</td>
              <?php } else if ($data['status'] == 2) { ?>
                <td>Selesai</td>
              <?php } ?>
              <td>
                <a href="<?= base_url(); ?>admin/detail_booking/<?= $data['bookedId'] ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php } else { ?>
      <div class="alert alert-warning">
        Belum ada pesanan
      </div>
    <?php } ?>
  </div>
</div>