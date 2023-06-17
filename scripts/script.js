console.log("Checking");

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

	$("#increase-num").click(function() {
		console.log("increasing by 1-ed");
		$("display-num").value += 1;
	});

	$("#decrease-num").click(function() {
		console.log("decreasing by 1-ed");
		$("display-num").value -= 1;
	});
});