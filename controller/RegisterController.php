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
		if ($this->registerWasPressed() && $this->emptyUserName() && $this->emptyPassword()) {
			$this->m->setMessage($this->m->noInputStatement());
		} else if ($this->registerWasPressed() && $this->emptyPassword()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->shortPasswordStatement());
		} else if ($this->registerWasPressed() && $this->invalidCharacters()) {
			$this->m->setName($this->unwrap($_POST[$this->v->getRequestUserName()]));
			$this->m->setMessage($this->m->invalidCharactersStatement());
		} else if ($this->registerWasPressed() && $this->shortUserName()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->shortUserNameStatement());
		} else if ($this->registerWasPressed() && $this->shortPassword()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->shortPasswordStatement());
		} else if ($this->registerWasPressed() && $this->differentPasswords()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->differentPasswordsStatement());
		} else if ($this->registerWasPressed() && $this->unavailableUserName()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->unavailableUserNameStatement());
		} else if ($this->registerWasPressed()) {
			$name = $_POST[$this->v->getRequestUserName()];
			$password = $_POST[$this->v->getRequestPassword()];
			$this->m->registerUser($name, $password);
			$this->loginController->setUserName($_POST[$this->v->getRequestUserName()]);
			$this->loginController->setMessage($this->m->registerUserStatement());
		}
	}
	private function registerWasPressed() {
		return isset($_POST[$this->v->getRequestRegister()]);
	}
	private function emptyUserName() {
		return $_POST[$this->v->getRequestUserName()] == "";
	}
	private function shortUserName() {
		$username = $_POST[$this->v->getRequestUserName()];
		return strlen($username) < $this->m->minLengthUserName();
	}
	private function emptyPassword() {
		return $_POST[$this->v->getRequestPassword()] == "";
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
