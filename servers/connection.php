<?php
	define("DB_HOST", "localhost");
	define("DB_USER", "marco");
	define("DB_PASS", "marcopass");
	define("DB_NAME", "wallet_manager");
	define("DB_PORT", "2412");

	$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

	// Check connection
	if ($connection -> connect_error) {
		die("[Connection failed]: " . $connection->connect_error);
	} else {
		// echo "Connection established";
	}

?>