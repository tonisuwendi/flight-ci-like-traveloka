<style>
  .ticket-container {
    position: relative;
    margin: auto;
    margin-top: 30px;
    width: 90%;
  }
</style>
<style type="text/css" media="print">
  @page {
    size: landscape;
    margin: 0;
  }

  @media print {
    .dont-print-this {
      display: none;
    }
  }
</style>
<?php include __DIR__ . '/../templates/date.php' ?>
<div class="ticket-container">
  <div class="d-flex justify-content-between">
    <a href="<?= base_url(); ?>admin/bookings" class="btn dont-print-this btn-sm btn-secondary">Kembali</a>
    <button onclick="downloadTicket()" class="btn btn-sm dont-print-this btn-primary">Download</button>
  </div>
  <div id="ticketContent" class="card mt-3 mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="mb-0">E-tiket</h4>
        <img height="32px" src="<?= base_url(); ?>assets/img/logo/logo.svg" alt="logo">
      </div>
      <div class="card mt-3" style="border-left: 3px solid dodgerblue;">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-4">
              <p class="mb-2"><?= $airline['name'] ?></p>
              <p class="mb-0">Kode Booking</p>
              <strong class="text-dark"><?= isset($_GET['return']) ? $booked['arrival_booking_id'] : $booked['booking_id'] ?></strong>
            </div>
            <div class="col-4">
              <p class="mb-0 font-weight-bold"><?= indoDate($flight['departure_datetime'], true) ?></p>
              <small class="mb-0 d-block"><?= $from['location']; ?></small>
              <small class="mb-0 d-block"><?= $from['name']; ?></small>
              <small>Berangkat <?= date('H:i', strtotime($flight['departure_datetime'])); ?></small>
            </div>
            <div class="col-4">
              <p class="mb-0">&nbsp;</p>
              <small class="mb-0 d-block"><?= $to['location']; ?></small>
              <small class="mb-0 d-block"><?= $to['name']; ?></small>
              <small>Tiba <?= date('H:i', strtotime($flight['arrival_datetime'])); ?></small>
            </div>
          </div>
        </div>
      </div>
      <small class="text-secondary">&bull; Note: Mohon lakukan check-in minimal 1 jam sebelum berangkat.</small>
      <p class="mb-2 mt-4">Detail Penumpang</p>
      <table class="table mb-0 table-sm">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Titel</th>
            <th>Nama</th>
            <th>Nomor Tiket</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($booked_list->result_array() as $data) : ?>
            <tr>
              <td class="text-center"><?= $no; ?></td>
              <td><?= $data['title'] ?></td>
              <td><?= $data['name'] ?></td>
              <td><?= isset($_GET['return']) ? $data['arrival_number'] : $data['number'] ?></td>
            </tr>
          <?php $no++;
          endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  function downloadTicket() {
    window.print();
  }
</script>