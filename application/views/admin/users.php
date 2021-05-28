<?php include __DIR__ . '/../templates/date.php' ?>
<h1 class="h3 mb-4 text-gray-800">Pengguna</h1>

<div class="card shadow">
  <div class="card-body">
    <?php if ($users->num_rows() > 0) { ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>Nama</td>
            <td>Username</td>
            <td>Email</td>
            <td>Tanggal Daftar</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users->result_array() as $data) : ?>
            <tr>
              <td><?= $data['name'] ?></td>
              <td><?= $data['username'] ?></td>
              <td><?= $data['email'] ?></td>
              <td><?= indoDate($data['date_register'], true, true) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php } else { ?>
      <div class="alert alert-warning">
        Belum ada pengguna
      </div>
    <?php } ?>
  </div>
</div>