<?php

namespace controller;


class LoginController {
	private $m;
	private $v;
	public function __construct(\model\LoginModel $m, \view\LoginView $v) {
		$this->m = $m;
		$this->v = $v;
	}

	public function run() {
		session_start();
		if($this->logoutAttempt()) {
			if ($this->alreadyAuthenticated()) {
				$this->m->setMessage($this->m->farewellStatement());
				$this->m->logout();
				session_unset();
			} else {
				$this->m->setMessage($this->m->emptyStatement());
			}
		} else if ($this->alreadyAuthenticated()) {
			$this->m->login();
		} else if ($this->loginAttempt()) {
			if ($this->userName() == "") {
				$this->m->setMessage($this->m->missingUserNameStatement());
			} else if ($this->password() == "") {
				$this->m->setMessage($this->m->missingPasswordStatement());
				$this->m->setName($_POST[$this->v->getRequestUserName()]);
			} else if (!$this->correctCredentials()) {
				$this->m->setMessage($this->m->badCredentialsStatement());
			} else if ($this->correctCredentials()) {
				$_SESSION['is_auth'] = true;
				$this->m->setMessage($this->m->welcomeStatement());
				$this->m->login();
			}
		}
	}
	public function setUserName($name) {
		$this->m->setName($name);
	}
	public function setMessage($message) {
		$this->m->setMessage($message);
	}
	private function loginAttempt() {
		return isset($_POST[$this->v->getRequestLogin()]);
	}
	private function userName() {
		return $_POST[$this->v->getRequestUserName()];
	}
	private function password() {
		return $_POST[$this->v->getRequestPassword()];
	}
	private function correctCredentials() {
		return $this->username() == "Admin" && $this->password() == "Password";
	}
	private function logoutAttempt() {
		return isset($_POST[$this->v->getRequestLogout()]);
	}
	private function alreadyAuthenticated() {
		return isset($_SESSION['is_auth']);
	}
}
