<?php

namespace controller;

class RegisterController {
	private $m;
	private $v;
	private $loginController;
	public function __construct(\model\RegisterModel $m, \view\RegisterView $v, \controller\LoginController $loginController) {
		$this->m = $m;
		$this->v = $v;
		$this->loginController = $loginController;
	}

	public function run() {
		if ($this->registerWasPressed()) {
			if ($this->emptyUserName() && $this->emptyPassword()) {
				$this->m->setMessage($this->m->noInputStatement());
			} else if ($this->emptyPassword()) {
				$this->m->setName($this->userName());
				$this->m->setMessage($this->m->shortPasswordStatement());
			} else if ($this->invalidCharacters()) {
				$this->m->setName($this->unwrap($this->userName()));
				$this->m->setMessage($this->m->invalidCharactersStatement());
			} else if ($this->shortUserName()) {
				$this->m->setName($this->userName());
				$this->m->setMessage($this->m->shortUserNameStatement());
			} else if ($this->shortPassword()) {
				$this->m->setName($this->userName());
				$this->m->setMessage($this->m->shortPasswordStatement());
			} else if ($this->differentPasswords()) {
				$this->m->setName($this->userName());
				$this->m->setMessage($this->m->differentPasswordsStatement());
			} else if ($this->unavailableUserName()) {
				$this->m->setName($this->userName());
				$this->m->setMessage($this->m->unavailableUserNameStatement());
			} else {
				$name = $this->userName();
				$password = $this->password();
				$this->m->registerUser($this->userName(), $this->password());
				$this->loginController->setUserName($this->userName());
				$this->loginController->setMessage($this->m->registerUserStatement());
			}
		}
	}
	private function registerWasPressed() {
		return isset($_POST[$this->v->getRequestRegister()]);
	}
	private function userName() {
		return $_POST[$this->v->getRequestUserName()];
	}
	private function password() {
		return $_POST[$this->v->getRequestPassword()];
	}
	private function emptyUserName() {
		return $this->userName() == "";
	}
	private function shortUserName() {
		$userName = $_POST[$this->v->getRequestUserName()];
		return strlen($userName) < $this->m->minLengthUserName();
	}
	private function emptyPassword() {
		return $this->password() == "";
	}
	private function shortPassword() {
		$password = $_POST[$this->v->getRequestPassword()];
		return strlen($password) < $this->m->minLengthPassword();
	}
	private function differentPasswords() {
		$password = $_POST[$this->v->getRequestPassword()];
		$passwordRepeat = $_POST[$this->v->getRequestPasswordRepeat()];
		return $password != $passwordRepeat;
	}
	private function unavailableUserName() {
		$candidate = $_POST[$this->v->getRequestUserName()];
		return $this->m->unavailableUserName($candidate);
	}
	private function unwrap($a) {
		preg_match('/<[a-zA-Z0-9]*>(.*?)<\/[a-zA-Z0-9]*>/s', $a, $match);
		return $match[1];
	}
	private function invalidCharacters() {
		$a = $_POST[$this->v->getRequestUserName()];
		preg_match('/<[a-zA-Z0-9]*>(.*?)<\/[a-zA-Z0-9]*>/s', $a, $match);
		return isset($match[1]);
	}

}
