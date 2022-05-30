<?php
	function is_email_address_valid($email_address) {
		$at_pos = strpos($email_address, '@');
		return $at_pos && $at_pos !== strlen($email_address) - 1;
	}

	function send_email($from, $to, $message) {
		if (!$smtp_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP))
			bad_request('Cannot create socket to connect to the SMTP server.');
	
		if (!socket_connect($smtp_socket, '127.0.0.1', 25))
			bad_request('Cannot connect to the SMTP server.');
	
		socket_read($smtp_socket, 1024);
		socket_write($smtp_socket, "HELO localhost\r\n");

		socket_read($smtp_socket, 1024);
		socket_write($smtp_socket, sprintf("MAIL FROM:<%s>\r\n", $from));

		socket_read($smtp_socket, 1024);
		socket_write($smtp_socket, sprintf("RCPT TO:<%s>\r\n", $to));
	
		socket_read($smtp_socket, 1024);
		socket_write($smtp_socket, "DATA\r\n");

		socket_write($smtp_socket, sprintf("From: LibreIdP <%s>\r\n%s\r\n",
			$from, $message));

		socket_read($smtp_socket, 1024);
		socket_write($smtp_socket, ".\r\n");
		
		socket_read($smtp_socket, 1024);
		socket_write($smtp_socket, "QUIT\r\n");

		socket_close($smtp_socket);
	}
?>
