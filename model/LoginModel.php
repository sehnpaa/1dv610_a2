<?php

class LoginModel {
	private $loggedIn;
	private $message = '';

	public function __construct() {
	}

	public function getMessage() {
		return $this->message;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function getName() {
		$name = '';
		if (empty($_POST)) {

		} else if (isset($_POST['LoginView::Login']) && $_POST['LoginView::UserName'] == "") {
		} else if (isset($_POST['LoginView::Login']) && $_POST['LoginView::Password'] == "") {
			$name = $_POST['LoginView::UserName'];
		} else if (isset($_POST['LoginView::Login']) && !($_POST['LoginView::UserName'] == "Admin" && $_POST['LoginView::Password'] == "Password")) {
			$name = $_POST['LoginView::UserName'];
		} else if(isset($_POST['LoginView::Logout'])) {

		}
		return $name;
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
