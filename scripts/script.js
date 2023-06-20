console.log("Currently working");

let jsDate = document.getElementById("transaction-date");

$(document).ready(function() {
	let dis = $("#display-num");

	$("#show-display-num").click(function(){
		console.log("btn clicked");
		dis.load("../scripts/data.txt", "POST");
	});

	$(".mouse-out").click(function() {
		$(".hover-me").toggle(1000);
		dis.fadeTo(1000, 0.5);
	});

	// Date.prototype.toDateInputValue =
});
