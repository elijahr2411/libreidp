<?php
	function not_found($description) {
		header('HTTP/1.1 404 Not Found');

		header('Content-Type: text/html');
		printf("<!DOCTYPE html>
<html lang=\"en\">
	<head>
		<meta charset=\"utf-8\">
		<meta name=\"language\" content=\"en\">
		<title>Resource not found</title>

		<link rel=\"stylesheet\" href=\"/css/basic.css\">
	</head>

	<body>
		<div class=\"header\">
			<img src=\"/img/libreidp-logo.png\" alt=\"LibreIdP logo\">
		</div>

		<div class=\"line\"></div>

		<div class=\"content\">
			<h1>The resource you're looking for couldn't be found.</h1>
			<p>
				Check the spelling of the URL, and try again.<br>
				Error description: %s
			</p>
		</div>
	</body>
</html>", htmlspecialchars($description));

		exit;
	}
?>
