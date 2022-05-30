function isEmailAddressValid(emailAddress) {
	return emailAddress.includes('@') && !emailAddress.startsWith('@') &&
		!emailAddress.endsWith('@');
}
