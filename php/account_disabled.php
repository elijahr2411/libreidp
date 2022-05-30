<?php
	function account_disabled($description) {
		header('HTTP/1.1 404 Not Found');

		header('Content-Type: text/html');
		printf("<!DOCTYPE html>
<html lang=\"en\">
	<head>
		<meta charset=\"utf-8\">
		<meta name=\"language\" content=\"en\">
		<title>Account disabled</title>

		<link rel=\"stylesheet\" href=\"/css/basic.css\">
	</head>

	<body>
		<div class=\"header\">
			<img src=\"/img/libreidp-logo.png\" alt=\"LibreIdP logo\">
		</div>

		<div class=\"line\"></div>

		<div class=\"content\">
			<h1 align=\"center\">This account has been disabled.</h1>
			<p align=\"center\">Error description: %s</p>
		</div>
	</body>
</html>", htmlspecialchars($description));

		exit;
	}
?>
