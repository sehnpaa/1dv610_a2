<?php

class LoginModel {
	private $loggedIn;
	private $message = '';
	private $name = '';

	public function __construct() {
	}

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function isLoggedIn() {
		return $this->loggedIn;
	}

	public function login() {
		$this->loggedIn = true;
	}
	public function logout() {
		$this->loggedIn = false;
	}
	public function emptyStatement() {
		return "";
	}
	public function missingUserNameStatement() {
		return "Username is missing";
	}
	public function missingPasswordStatement() {
		return "Password is missing";
	}
	public function badCredentialsStatement() {
		return "Wrong name or password";
	}
	public function farewellStatement() {
		return "Bye bye!";
	}
	public function welcomeStatement() {
		return "Welcome";
	}
}
