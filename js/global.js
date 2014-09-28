// $(document).ready(function(){

// });

var $search = $("#search"),
	$downloadBtn = $("#download"),
	$successAlert = $("#downloadDone");
	$errorAlert = $("#downloadFailed");

$downloadBtn.click(function() {
	console.log('yooo');
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

	}
});
