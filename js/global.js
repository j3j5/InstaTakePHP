// $(document).ready(function(){

// });

var $search = $("#search"),
	$downloadBtn = $("#download"),
	$successAlert = $("#downloadDone");
	$errorAlert = $("#downloadFailed");

$downloadBtn.click(function() {
	if($search.val().length > 0) {
		// Show the spinner
		$downloadBtn.toggleClass('active');

		$.ajax({
			url: '/ajax.php',
			type: 'GET',
			data: { username: $search.val() },
			success: function(msg) {
				// Hide the spinner
				$downloadBtn.toggleClass('active');
				$successAlert.show();
			},
			error: function(msg) {
				$downloadBtn.toggleClass('active');
				$downloadFailed.show();
				console.err('There was an error!!!!');
				console.err(msg);
			}
		});
	} else {
		$("#errorMsg").text("You need to add a username to be able to back up its images.")
		$errorAlert.show();
	}
});

$("#ex7").slider();
$("#ex7-enabled").click(function() {
	if(this.checked) {
		// With JQuery
		$("#ex7").slider("enable");
	}
	else {
		// With JQuery
		$("#ex7").slider("disable");
	}
});
