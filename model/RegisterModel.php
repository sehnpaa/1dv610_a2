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
		return "Username has too few characters, at least 3 characters.<br/>Password has too few characters, at least 6 characters.";
	}
	public function emptyPasswordStatement() {
		return "Password has too few characters, at least 6 characters.";
	}
}
