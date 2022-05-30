<?php
	function is_password_valid($password) {
		return strlen($password) >= 10 &&
			preg_match('/[^0-9A-Za-z]/', $password) &&
			preg_match('/[0-9]/', $password) &&
			preg_match('/[A-Z]/', $password) &&
			preg_match('/[a-z]/', $password);
	}

	function is_password_email_address($email_address, $password) {
		if (strpos($email_address, '@') === false)
			return false;

		$lowercase_password = strtolower($password);
		$lowercase_email_address = strtolower($email_address);

		$email_address_split = str_split($email_address, '@');

		return $lowercase_password == $lowercase_email_address &&
			$lowercase_password == $email_address_split[0] &&
			$lowercase_password == $email_address_split[1];
	}
?>
