<nav class="navbar shadow-sm navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/img/logo/logo.svg" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active mx-1">
          <a class="nav-link" href="<?= base_url(); ?>">Beranda</a>
        </li>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="<?= base_url(); ?>maskapai">Maskapai</a>
        </li>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="<?= base_url(); ?>bandara">Bandara</a>
        </li>
        <li class="nav-item active mx-1">
          <?php if ($this->session->userdata('login')) { ?>
            <a class="nav-link" href="<?= base_url(); ?>user/mybooking">Pesanan Saya</a>
          <?php } else { ?>
            <a class="nav-link" href="<?= base_url(); ?>login?redirect=user/mybooking">Pesanan Saya</a>
          <?php } ?>
        </li>
        <li class="nav-item active ml-5">
          <?php if ($this->session->userdata('login')) { ?>
            <a class="nav-link" href="<?= base_url(); ?>user"><i class="bi bi-person"></i> Profilku</a>
          <?php } else { ?>
            <a class="btn btn-primary px-3" href="<?= base_url(); ?>user">Login</a>
          <?php } ?>
        </li>
      </ul>
    </div>
  </div>
</nav>