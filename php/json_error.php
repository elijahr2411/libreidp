<?php
	function json_error($error, $error_description) {
		header('HTTP/1.1 400 Bad Request');
		printf('{ "error": "%s", "error_description": "%s" }',
			str_replace('"', '\"', $error),
			str_replace('"', '\"', $error_description));
		exit;
	}
?>
