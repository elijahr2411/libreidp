<?php
	function is_scope_valid($scope, $allowed_scope) {
		$scope_array = str_split($scope);
		$allowed_scope_array = str_split($allowed_scope_array);

		foreach ($scope_array as $permission) {
			if (!in_array($permission, $allowed_scope_array))
				return false;
		}

		return true;
	}

	function oauth_error($redirect_uri, $error, $error_description) {
		header(sprintf('Location: %s?error=%s&error_description=%s',
				$redirect_uri,
				urlencode($error),
				urlencode($error_description)));
		exit;
	}
?>
