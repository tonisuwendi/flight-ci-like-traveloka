$("#checkboxReturnDate").on("click", function () {
	if ($("#checkboxReturnDate:checked").length === 1) {
		$(".booking-box .form-control-tanggal-pulang").show();
	} else {
		$(".booking-box .form-control-tanggal-pulang").hide();
	}
});

function removeErrorInput(id, msg) {
	$(`#${id}`).removeClass("is-invalid");
	$(`#${msg}`).hide();
}
