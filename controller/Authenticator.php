<?php

session_start();

class Authenticator {
	private $m;
	private $v;
	public function __construct(LoginModel $m, LoginView $v) {
		$this->m = $m;
		$this->v = $v;
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
	public function authenticate() {
		if (empty($_POST)) {
			$this->m->setMessage($this->m->emptyStatement());
		} else if (isset($_POST['LoginView::Login']) && $_POST['LoginView::UserName'] == "") {
			$this->m->setMessage($this->m->missingUserNameStatement());
		} else if (isset($_POST['LoginView::Login']) && $_POST['LoginView::Password'] == "") {
			$this->m->setMessage($this->m->missingPasswordStatement());
		} else if (isset($_POST['LoginView::Login']) && !($_POST['LoginView::UserName'] == "Admin" && $_POST['LoginView::Password'] == "Password")) {
			$this->m->setMessage($this->m->badCredentialsStatement());
		} else if(isset($_POST['LoginView::Logout'])) {
			$this->m->setMessage($this->m->farewellStatement());
			$this->m->login();
		} else if (isset($_POST['LoginView::Login']) && ($_POST['LoginView::UserName'] == "Admin" && $_POST['LoginView::Password'] == "Password")) {
			$this->m->setMessage($this->m->welcomeStatement());
			$this->m->logout();
		}
	}
}
