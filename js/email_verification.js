class LibreIdPEmailCodeVerification {
	constructor(emailAddress) {
		this.emailAddress = emailAddress;
		this.verificationToken = null;
		this.verified = false;
		this.onSendSuccess = null;
		this.onSendFailure = null;
		this.onVerifySuccess = null;
		this.onVerifyFailure = null;
	}

	setVerificationToken(token) {
		this.verificationToken = token;
	}

	setVerified(verified) {
		this.verified = verified;
	}

	send() {
		var xhr = new XMLHttpRequest();
		var encodedEmailAddress = encodeURI(this.emailAddress);
		var _this = this;

		xhr.onload = function () {
			switch (xhr.status) {
				case 200:
					response = JSON.parse(xhr.responseText);

					_this.setVerificationToken(response.token);
		
					if (_this.onSendSuccess)
						_this.onSendSuccess();

					break;

				case 500:
					if (_this.onSendFailure) {
						_this.onSendFailure('invalid_server_error',
							'An internal error occurred on the server.');
					}

					break;

				default:
					response = JSON.parse(xhr.responseText);

					if (_this.onSendFailure)
						_this.onSendFailure(response.error, response.error_description);
			}
		}

		xhr.open('POST', '/api/v1/auth/email/code?action=send', true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(`email_address=${encodedEmailAddress}`);
	};

	verify(code) {
		var xhr = new XMLHttpRequest();
		var _this = this;

		xhr.onload = function () {
			switch (xhr.status) {
				case 200:
					_this.setVerified(true);

					if (_this.onVerifySuccess)
						_this.onVerifySuccess();

					break;

				case 500:
					if (_this.onVerifyFailure) {
						_this.onVerifyFailure('invalid_server_error',
							'An internal error occurred on the server.');
					}

					break;

				default:
					response = JSON.parse(xhr.responseText);

					if (_this.onVerifyFailure)
						_this.onVerifyFailure(response.error, response.error_description);
			}
		};

		xhr.open('POST', '/api/v1/auth/email/code?action=verify', true);
		xhr.setRequestHeader('Authorization', 'Bearer ' + this.verificationToken);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send(`verification_code=${code}`);
	}
}

function isVerificationCodeValid() {
	var verificationCode = document.getElementById('verificationCode').value;
	return verificationCode.length == 8;
}
