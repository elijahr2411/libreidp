function getSignupToken() {
	signupToken = window.sessionStorage.getItem('signupToken');
	if (signupToken)
		return signupToken;
	else
		window.location.replace('/signup');
}

function sendSignupForm(signupToken, form, redirectUri, onFinished) {
	xhr = new XMLHttpRequest();

	xhr.onload = function () {

		switch (xhr.status) {
			case 200:
				if (onFinished)
					onFinished('success', 'The operation completed successfully.');

				window.location.assign(redirectUri);
				break;
				
			case 500:
				document.getElementById('error').innerHTML = 'An internal error occurred on the server.';

				if (onFinished) {
					onFinished('internal_server_error',
						'An internal error occurred on the server.');
				}

				break;

			default:
				response = JSON.parse(xhr.responseText);

				document.getElementById('error').innerHTML = response.error_description;

				if (onFinished)
					onFinished(response.error, response.error_description);

				break;
		}
	};

	xhr.open('POST', window.location.pathname, true);
	xhr.setRequestHeader('Authorization', 'Bearer ' + signupToken);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send(form);
}

function getEmailAddressFromSignupToken(signupToken, onSuccess, onFailure) {
	var xhr = new XMLHttpRequest();

	xhr.onload = function () {
		response = JSON.parse(xhr.responseText);

		if (xhr.status == 200) {
			response = JSON.parse(xhr.responseText);
			onSuccess(response.email_address);
		} else if (xhr.status == 500) {
			document.getElementById('error').innerHTML = 'An internal error occurred on the server.';

			if (onFinished) {
				onFinished('internal_server_error',
					'An internal error occurred on the server.');
			}
		} else {
			response = JSON.parse(xhr.responseText);

			document.getElementById('error').innerHTML = response.error_description;
			onFailure(response.error, response.error_description);
		}
	};

	xhr.open('GET', '/api/v1/signup/email', true);
	xhr.setRequestHeader('Authorization', 'Bearer ' + signupToken);
	xhr.send();
}
