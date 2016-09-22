<?php

session_start();

class LoginController {
	private $m;
	private $v;
	public function __construct(\model\LoginModel $m, LoginView $v) {
		$this->m = $m;
		$this->v = $v;
	}
  
	public function authenticate() {
		if (isset($_SESSION['is_auth'])) {
			$this->m->login();
		}
		if (empty($_POST)) {
			$this->m->setMessage($this->m->emptyStatement());
		} else if (isset($_POST[$this->v->getRequestLogin()]) && $_POST[$this->v->getRequestUserName()] == "") {
			$this->m->setMessage($this->m->missingUserNameStatement());
		} else if (isset($_POST[$this->v->getRequestLogin()]) && $_POST[$this->v->getRequestPassword()] == "") {
			$this->m->setMessage($this->m->missingPasswordStatement());
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
		} else if (isset($_POST[$this->v->getRequestLogin()]) && !($_POST[$this->v->getRequestUserName()] == "Admin" && $_POST[$this->v->getRequestPassword()] == "Password")) {
			$this->m->setMessage($this->m->badCredentialsStatement());
		} else if(isset($_POST[$this->v->getRequestLogout()])) {
			$this->m->setMessage($this->m->farewellStatement());
			$this->m->logout();
			session_unset();
		} else if (isset($_POST[$this->v->getRequestLogin()]) && ($_POST[$this->v->getRequestUserName()] == "Admin" && $_POST[$this->v->getRequestPassword()] == "Password")) {
			$_SESSION['is_auth'] = true;
			$this->m->setMessage($this->m->welcomeStatement());
			$this->m->login();
		}
	}
	public function setUserName($name) {
		$this->m->setName($name);
	}
	public function setMessage($message) {
		$this->m->setMessage($message);
	}
}
