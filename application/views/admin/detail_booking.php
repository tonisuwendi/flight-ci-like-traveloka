<?php include  __DIR__ . '/../templates/date.php'; ?>
<h1 class="h3 mb-4 text-gray-800">Detail Pesanan</h1>

<div class="card shadow">
  <div class="card-header">
    <a href="<?= base_url(); ?>admin/bookings" class="btn btn-success"><i class="fa fa-chevron-left"></i> Kembali</a>
  </div>
  <div class="card-body">
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
            <td>: Rp <?= number_format(($booked['price'] * $booked['passanger'] + ($booked['price'] * $booked['passanger'])), 0, ",", "."); ?></td>
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
        <td>: <?= ' Pukul ' .  date('H:i', strtotime($flight['departure_datetime'])) . ' dari ' . $from['location'] . ' (' . $from['name'] . ')' ?></td>
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
    <?php if ($booked['status'] == 2) { ?>
      <hr>
      <a href="<?= base_url(); ?>home/ticket/<?= $booked['id'] ?>/<?= $booked['booking_id'] ?>?redirect=bookings" target="_blank" class="btn ml-2 btn-info px-3">Lihat Tiket</a>
    <?php } ?>
  </div>
</div>