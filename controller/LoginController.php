<?php

namespace controller;

require_once('CookieHandler.php');

class LoginController {
	private $m;
	private $v;
	private $cookieHandler;
	private $postHandler;

	public function __construct(\model\LoginModel $m, \view\LoginView $v, \controller\PostHandler $postHandler) {
		$this->m = $m;
		$this->v = $v;
		$this->postHandler = $postHandler;
		$this->cookieHandler = new \controller\CookieHandler();
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
				$this->m->setName($this->userName());
			} else if (!$this->correctCredentials()) {
				$this->m->setMessage($this->m->badCredentialsStatement());
			} else if ($this->correctCredentials()) {
				$_SESSION['is_auth'] = true;
				$this->m->setMessage($this->m->welcomeStatement());
				$this->m->login();
				$this->setCookie();
			}
		} else if ($this->cookieHandler->loginAttempt($this->v->getRequestCookieName())) {
			if ($this->cookieHandler->manipulatedCookie($this->v->getRequestCookiePassword())) {
				$this->m->setMessage("Wrong information in cookies");
			} else {
				$this->m->setMessage("Welcome back with cookie");
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
		return $this->postHandler->hasField($this->v->getRequestLogin());
	}
	private function userName() {
		return $this->postHandler->getField($this->v->getRequestUserName());
	}
	private function password() {
		return $this->postHandler->getField($this->v->getRequestPassword());
	}
	private function correctCredentials() {
		return $this->username() == "Admin" && $this->password() == "Password";
	}
	private function logoutAttempt() {
		return $this->postHandler->hasField($this->v->getRequestLogout());
	}
	private function alreadyAuthenticated() {
		return isset($_SESSION['is_auth']);
	}
	private function setCookie() {
		$cookieName = $this->v->getRequestCookieName();
		$cookiePassword = $this->v->getRequestCookiePassword();
		setcookie($cookieName, "Admin", time()+10);
		setcookie($cookiePassword, session_id(), time()+10);
	}
}
