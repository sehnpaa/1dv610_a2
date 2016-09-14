<?php

session_start();

class Authenticator {
	private $loginView;
	public function __construct(LoginView $v) {
		$this->loginView = $v;
	}
  
	public function isLoggedIn() {
		if (isset($_POST['LoginView::UserName']) && isset($_POST['LoginView::Password'])) {
			if ($_POST['LoginView::UserName'] == "Admin" && $_POST['LoginView::Password'] == "Password") {
				return true;
			}
		}
		return false;
 	}
}
