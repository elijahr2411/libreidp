<?php
	function bad_request($description) {
		header('HTTP/1.1 400 Bad Request');

		header('Content-Type: text/html');
		printf("<!DOCTYPE html>
<html lang=\"en\">
	<head>
		<meta charset=\"utf-8\">
		<meta name=\"language\" content=\"en\">
		<title>Error while processing request</title>

		<link rel=\"stylesheet\" href=\"/css/basic.css\">
	</head>

	<body>
		<div class=\"header\">
			<img src=\"/img/libreidp-logo.png\" alt=\"LibreIdP logo\">
		</div>

		<div class=\"line\"></div>

		<div class=\"content\">
			<h1>Your request is not valid or could not be processed.</h1>
		</div>

		<p>
			Error description: %s
		</p>
	</body>
</html>", htmlspecialchars($description));

		exit;
	}
?>
