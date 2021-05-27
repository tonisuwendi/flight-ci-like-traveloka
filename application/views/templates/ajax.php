<script>
  function searchTicket() {
    const cityFrom = $("#cityFrom");
    const cityTo = $("#cityTo");
    const departureDate = $("#departureDate");
    const returnDate = $("#returnDate");
    const countPassengers = $("#countPassengers");
    const seatClass = $("#seatClass");
    let validationSuccess = true;
    if (cityFrom.val() === cityTo.val()) {
      cityTo.addClass("is-invalid");
      $("#msgTextDangerCityTo").show();
      validationSuccess = false;
    }
    if (!departureDate.val()) {
      departureDate.addClass("is-invalid");
      $("#msgTextDangerDepartureDate").show();
      validationSuccess = false;
    }
    if (returnDate.val()) {
      if (departureDate.val() > returnDate.val()) {
        returnDate.addClass("is-invalid");
        $("#msgTextDangerReturnDate").show();
        validationSuccess = false;
      }
    }
    if (countPassengers.val() < 1) {
      countPassengers.addClass("is-invalid");
      $("#msgTextDangerCountPassengers").show();
      validationSuccess = false;
    }
    if (validationSuccess) {
      window.location.href = `<?= base_url(); ?>search?from=${cityFrom.val()}&to=${cityTo.val()}&dd=${departureDate.val()}&rd=${returnDate.val()}&ps=${countPassengers.val()}&sc=${seatClass.val()}`;
    }
  }
</script>