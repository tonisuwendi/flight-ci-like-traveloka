<style>
  div.content-container h2 {
    font-size: 22px;
    font-weight: 600;
  }

  div.content-container h3 {
    font-size: 19px;
    font-weight: 600;
  }

  div.content-container h4 {
    font-size: 17px;
    font-weight: 600;
  }

  div.content-container p {
    font-size: 15px;
    margin-bottom: 10px;
  }

  div.content-container img {
    width: 50%;
  }

  .banner {
    background-color: #0870e0;
    height: 170px;
    padding-top: 45px;
    position: relative;
    width: 100%;
  }

  .banner h2 {
    color: white;
    font-weight: 700;
    text-align: center;
  }

  .line {
    background-color: white;
    border-radius: 5px;
    height: 4px;
    margin-top: 20px;
    position: relative;
    left: 50%;
    transform: translate(-50%, 0);
    width: 80px;
  }

  .content-container {
    position: relative;
    margin: auto;
    margin-top: 40px;
    width: 1000px;
  }
</style>

<div class="banner">
  <div class="content">
    <h2><?= $page['title']; ?></h2>
    <div class="line"></div>
  </div>
</div>


<div class="content-container mb-5">
  <?= $page['content']; ?>
</div>