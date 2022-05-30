<?php
	function access_denied($description) {
		header('HTTP/1.1 403 Forbidden');

		header('Content-Type: text/html');
		printf("<!DOCTYPE html>
<html lang=\"en\">
	<head>
		<meta charset=\"utf-8\">
		<meta name=\"language\" content=\"en\">
		<title>Access is denied.</title>

		<link rel=\"stylesheet\" href=\"/css/basic.css\">
	</head>
	
	<body>
		<div class=\"header\">
			<img src=\"/img/libreidp-logo.png\" alt=\"LibreIdP logo\">
		</div>

		<div class=\"line\"></div>

		<div class=\"content\">
			<h1>You're not allowed to access this resource.</h1>

			<p>
				Error description: %s
			</p>
		</div>
	</body>
</html>", htmlspecialchars($description));
	}
?>
