<?php
	function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	function base64url_decode($data) {
		return base64_decode(strtr('-_', '+/'));
	}
?>
