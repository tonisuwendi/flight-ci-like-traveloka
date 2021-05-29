<?php $page = $this->db->get('pages'); ?>
<footer class="bd-footer border-top p-3 p-md-5 mt-5 bg-light text-center text-sm-left">
  <div class="container">
    <ul class="bd-footer-links">
      <?php foreach ($page->result_array() as $p) : ?>
        <li><a href="<?= base_url() . $p['slug'] ?>"><?= $p['title'] ?></a></li>
      <?php endforeach; ?>
    </ul>
    <p>Copyright &copy; 2021. <a href="<?= base_url(); ?>">Traveloka.com</a>. All Right Reserved.<br /> Develop by <a href="https://instagram.com/tonisuwen" target="_blank">Toni Suwendi</a></p>
  </div>
</footer>