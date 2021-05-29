<?php include __DIR__ . '/../templates/date.php' ?>
<div class="wrapper">
  <div class="menu">
    <?php include 'menu.php' ?>
  </div>
  <div class="content">
    <h3 class="title">Detail Pesanan</h3>
    <hr>
    <?php if ($booked['status'] == 0) { ?>
      Status: <small class="badge badge-info">Belum memilih metode pembayaran</small>
    <?php } else if ($booked['status'] == 1) { ?>
      Status: <small class="badge badge-info">Belum melakukan pembayaran</small>
    <?php } else if ($booked['status'] == 2) { ?>
      Status: <small class="badge badge-info">Selesai</small>
    <?php } ?>
    <div class="row mt-3">
      <div class="col-md-7">
        <table class="table table-sm table-borderless">
          <tr>
            <td>Nama</td>
            <td>: <?= $booked['name']; ?></td>
          </tr>
          <tr>
            <td>No. Telp</td>
            <td>: +62<?= $booked['telp']; ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>: <?= $booked['email']; ?></td>
          </tr>
          <tr>
            <td>Tanggal Pesan</td>
            <td>: <?= indoDate($booked['date_booked'], true); ?></td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>: Rp <?= number_format(($booked['price'] * $booked['passanger'] + $booked['arrival_price'] * $booked['passanger']), 0, ",", "."); ?></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <?php if ($booked['arrival_flight_id']) { ?>
      <p class="mb-1 text-dark">Penerbangan Pergi</p>
    <?php } ?>
    <table class="table table-sm table-borderless">
      <tr>
        <td>No. Pesanan</td>
        <td>: <?= $booked['booking_id']; ?></td>
      </tr>
      <tr>
        <td>Maskapai</td>
        <td>: <?= $airline['name']; ?></td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td>: <?= indoDate($flight['departure_datetime'], true) ?></td>
      </tr>
      <tr>
        <td>Keberangkatan</td>
        <td>: <?= 'Pukul ' .  date('H:i', strtotime($flight['departure_datetime'])) . ' dari ' . $from['location'] . ' (' . $from['name'] . ')' ?></td>
      </tr>
      <tr>
        <td>Tiba</td>
        <td>: <?= 'Pukul ' . date('H:i', strtotime($flight['arrival_datetime'])) . ' di ' . $to['location'] . ' (' . $to['name'] . ')' ?></td>
      </tr>
      <tr>
        <td>Kelas</td>
        <td>: <?= $class; ?></td>
      </tr>
    </table>
    <hr>
    <?php if ($booked['arrival_flight_id']) { ?>
      <p class="mb-1 text-dark">Penerbangan Pulang</p>
      <table class="table table-sm table-borderless">
        <tr>
          <td>No. Pesanan</td>
          <td>: <?= $booked['arrival_booking_id']; ?></td>
        </tr>
        <tr>
          <td>Maskapai</td>
          <td>: <?= $airline2['name']; ?></td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>: <?= indoDate($flight2['departure_datetime'], true) ?></td>
        </tr>
        <tr>
          <td>Keberangkatan</td>
          <td>: <?= 'Pukul ' .  date('H:i', strtotime($flight2['departure_datetime'])) . ' dari ' . $from2['location'] . ' (' . $from2['name'] . ')' ?></td>
        </tr>
        <tr>
          <td>Tiba</td>
          <td>: <?= 'Pukul ' . date('H:i', strtotime($flight2['arrival_datetime'])) . ' di ' . $to2['location'] . ' (' . $to2['name'] . ')' ?></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>: <?= $class2; ?></td>
        </tr>
      </table>
      <hr>
    <?php } ?>
    <p class="mb-2 lead">Daftar Penumpang</p>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Titel</th>
            <th>Nama</th>
            <?php if ($booked['arrival_flight_id']) { ?>
              <th>Nomor Tiket Pergi</th>
              <th>Nomor Tiket Pulang</th>
            <?php } else { ?>
              <th>Nomor Tiket</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($booked_list->result_array() as $data) : ?>
            <tr>
              <td class="text-center"><?= $no; ?></td>
              <td><?= $data['title'] ?></td>
              <td><?= $data['name'] ?></td>
              <td><?= $data['number'] ?></td>
              <?php if ($booked['arrival_flight_id']) { ?>
                <td><?= $data['arrival_number'] ?></td>
              <?php } ?>
            </tr>
          <?php $no++;
          endforeach; ?>
        </tbody>
      </table>
    </div>
    <hr>
    <?php if ($booked['status'] == 0) { ?>
      <a href="<?= base_url(); ?>booking/payment/<?= $booked['id'] ?>" class="btn btn-primary px-3">Pilih Metode Pembayaran</a>
    <?php } else if ($booked['status'] == 1) { ?>
      <a href="<?= $booked['link_pay']; ?>" target="_blank" class="btn btn-primary px-3">Lihat Panduan Pembayaran</a>
    <?php } else if ($booked['status'] == 2) { ?>
      <a href="<?= base_url(); ?>home/ticket/<?= $booked['id'] ?>/<?= $booked['booking_id'] ?>?redirect=mybooking" target="_blank" class="btn btn-primary px-3">Unduh Tiket<?= $booked['arrival_flight_id'] ? " Pergi" : null ?></a>
      <?php if ($booked['arrival_flight_id']) { ?>
        <a href="<?= base_url(); ?>home/ticket/<?= $booked['id'] ?>/<?= $booked['booking_id'] ?>?return=true&redirect=mybooking" target="_blank" class="btn btn-success px-3">Unduh Tiket Pulang</a>
      <?php } ?>
    <?php } ?>
  </div>
</div>