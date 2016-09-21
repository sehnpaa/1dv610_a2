<?php

class RegisterModel {
	private $loggedIn;
	private $message = '';
	private $name = '';

	public function __construct() {
	}

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($newMessage) {
		$this->message = $newMessage;
	}
	public function getName() {
		return $this->name;
	}

	public function setName($newName) {
		$this->name= $newName;
	}
	public function noInputStatement() {
		return $this->shortUserNameStatement() . "\r\n" . $this->shortPasswordStatement();
	}
	private function shortStatement($a, $min) {
		return $a . " has too few characters, at least " . $min . " characters.";
	}
	public function shortUserNameStatement() {
		return $this->shortStatement("Username", $this->minLengthUserName());
	}
	public function shortPasswordStatement() {
		return $this->shortStatement("Password", $this->minLengthPassword());
	}
	public function minLengthUserName() {
		return 3;
	}
	public function minLengthPassword() {
		return 6;
	}
	public function differentPasswordsStatement() {
		return "Passwords do not match.";
	}
	public function unavailableUserNameStatement() {
		return "User exists, pick another username.";
	}
	public function unavailableUserName($name) {
		return $name == "Admin";
	}
	public function registerUserStatement() {
		return "Registered new user.";
	}
	public function registerUser() {

	}
}
