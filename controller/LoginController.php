<?php

namespace controller;

require_once('Settings.php');
require_once('CookieHandler.php');
require_once('SessionHandler.php');

class LoginController {
	private $m;
	private $v;
	private $postHandler;
	private $cookieHandler;
	private $sessionHandler;

	public function __construct(\model\LoginModel $m, \view\LoginView $v, \controller\PostHandler $postHandler) {
		$this->m = $m;
		$this->v = $v;
		$this->postHandler = $postHandler;
		$this->cookieHandler = new \controller\CookieHandler();
		$this->sessionHandler = new \controller\SessionHandler();
	}

	public function run() {
		if($this->logoutAttempt()) {
			if ($this->alreadyAuthenticated()) {
				$this->m->setMessage($this->m->farewellStatement());
				$this->m->logout();
				$this->sessionHandler->clear();
			} else {
				$this->m->setMessage($this->m->emptyStatement());
			}
		} else if ($this->alreadyAuthenticated()) {
			$this->m->login();
		} else if ($this->loginAttempt()) {
			$this->verifyLogin();
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
		return $this->username() == \Settings::$ADMIN_USERNAME && $this->password() == \Settings::$ADMIN_PASSWORD;
	}
	private function logoutAttempt() {
		return $this->postHandler->hasField($this->v->getRequestLogout());
	}
	private function alreadyAuthenticated() {
		return $this->sessionHandler->isAuthenticated();
	}
	private function verifyLogin() {
		if ($this->emptyUserName()) {
			$this->m->setMessage($this->m->missingUserNameStatement());
		} else if ($this->emptyPassword()) {
			$this->m->setMessage($this->m->missingPasswordStatement());
			$this->m->setName($this->userName());
		} else if (!$this->correctCredentials()) {
			$this->m->setMessage($this->m->badCredentialsStatement());
		} else if ($this->correctCredentials()) {
			$this->sessionHandler->authenticate();
			$this->m->setMessage($this->m->welcomeStatement());
			$this->m->login();
			$this->setCookie();
		}
	}
	private function emptyUserName() {
		return $this->userName() == "";
	}
	private function emptyPassword() {
		return $this->password() == "";
	}
	private function setCookie() {
		$name = $this->v->getRequestCookieName();
		$password = $this->v->getRequestCookiePassword();
		$this->cookieHandler->setNew($name, $password);
	}
}
