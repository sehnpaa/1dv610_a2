<?php

class RegisterModel {
	private $loggedIn;
	private $message = '';

	public function __construct() {
	}

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($newMessage) {
		$this->message = $newMessage;
	}
	public function noInputStatement() {
		return "Username has too few characters, at least 3 characters.<br/>Password has too few characters, at least 6 characters.";
	}
}
