<?php

session_start();

class Authenticator {
	private $v;
	public function __construct(LoginView $v) {
		$this->v= $v;
	}
  
	public function isLoggedIn() {
		if (isset($_POST[$this->v->getRequestLogout()])) {
			return false;
		}
		if (isset($_SESSION['is_auth'])) {
			return true;
		}
		if (isset($_POST[$this->v->getRequestUserName()]) && isset($_POST[$this->v->getRequestPassword()])) {
			if ($_POST['LoginView::UserName'] == "Admin" && $_POST['LoginView::Password'] == "Password") {
				$_SESSION['is_auth'] = true;
				return true;
			}
		}
		return false;
 	}
}
