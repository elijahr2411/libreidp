<?php
	function get_authorization_token() {
		if (array_key_exists('HTTP_AUTHORIZATION', $_SERVER))
			$authorization = $_SERVER['HTTP_AUTHORIZATION'];
		else
			return false;

		if (!preg_match('/^Bearer /', $authorization))
			return false;

		return preg_replace('/^Bearer /', '', $authorization);
	}
?>
