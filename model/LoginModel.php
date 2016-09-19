<?php

class LoginModel {
	private $loggedIn;

	public function __construct() {
	}

	public function getMessage() {
		$message = '';
		if (empty($_POST)) {
			$message = '';
		} else if (isset($_POST['LoginView::Login']) && $_POST['LoginView::UserName'] == "") {
			$message = 'Username is missing';
		} else if (isset($_POST['LoginView::Login']) && $_POST['LoginView::Password'] == "") {
			$message = 'Password is missing';
		} else if (isset($_POST['LoginView::Login']) && !($_POST['LoginView::UserName'] == "Admin" && $_POST['LoginView::Password'] == "Password")) {
			$message = "Wrong name or password";
		} else if(isset($_POST['LoginView::Logout'])) {
			$message = "Bye bye!";
			$this->loggedIn = false;
		} else if (isset($_POST['LoginView::Login']) && ($_POST['LoginView::UserName'] == "Admin" && $_POST['LoginView::Password'] == "Password")) {
			$message = "Welcome";
			$this->loggedIn = true;
		}
		return $message;
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
}
