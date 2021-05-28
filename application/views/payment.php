<script type="text/javascript" src="<?= $this->config->item('midtrans_production') ? "https://app.midtrans.com/snap/snap.js" : "https://app.sandbox.midtrans.com/snap/snap.js" ?>" data-client-key="<?= $this->config->item("client_api_midtrans"); ?>"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<div class="waiting-payment">

  <h5 class="text-center mt-5">
    <div class="spinner-border text-dark mb-3" role="status">
      <span class="sr-only">Loading...</span>
    </div> <br> Sedang menyiapkan metode pembayaran. Tunggu sebentar.
  </h5>
  <p class="text-center text-muted">Tidak ada respon? <a id="pay-button" href="#">Klik disini</a></p>
</div>

<form id="payment-form" method="post" action="<?= base_url() ?>payment/finish/<?= $booking['id']; ?>">
  <input type="hidden" name="result_type" id="result-type" value=""></div>
  <input type="hidden" name="result_data" id="result-data" value=""></div>
</form>

<script type="text/javascript">
  modalMidtrans();
  $("#pay-button").click(function() {
    modalMidtrans();
  })

  function modalMidtrans() {
    $.ajax({
      url: '<?= base_url() ?>payment/token/<?= $booking['id']; ?>',
      cache: false,
      success: function(data) {
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type, data) {
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
        }
        $(".spinner-border").fadeOut();
        snap.pay(data, {
          onSuccess: function(result) {
            changeResult('success', result);
            $("#payment-form").submit();
          },
          onPending: function(result) {
            changeResult('pending', result);
            $("#payment-form").submit();
          },
          onError: function(result) {
            changeResult('error', result);
            $("#payment-form").submit();
          }
        });
      }
    });
  }
</script>