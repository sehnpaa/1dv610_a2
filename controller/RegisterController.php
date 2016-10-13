<?php

namespace controller;

class RegisterController {
	private $m;
	private $v;
	private $loginController;
	private $postHandler;
	private $validateRegex = '/<[a-zA-Z0-9]*>(.*?)<\/[a-zA-Z0-9]*>/s';

	public function __construct(\model\RegisterModel $m, \view\RegisterView $v, \controller\LoginController $loginController, \controller\PostHandler $postHandler) {
		$this->m = $m;
		$this->v = $v;
		$this->loginController = $loginController;
		$this->postHandler = $postHandler;
	}

	public function run() {
		if ($this->registerWasPressed()) {
			if ($this->emptyUserName() && $this->emptyPassword()) {
				$this->m->setMessage($this->m->noInputStatement());
			} else if ($this->emptyPassword()) {
				$this->m->setName($this->userName());
				$this->m->setMessage($this->m->shortPasswordStatement());
			} else if ($this->invalidCharacters()) {
				$this->m->setName($this->removeInvalidCharacters($this->userName()));
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
				$this->m->registerUser($this->userName(), $this->password());
				$this->loginController->setUserName($this->userName());
				$this->loginController->setMessage($this->m->registerUserStatement());
			}
		}
	}
	private function registerWasPressed() {
		return $this->postHandler->hasField($this->v->getRequestRegister());
	}
	private function userName() {
		return $this->postHandler->getField($this->v->getRequestUserName());
	}
	private function password() {
		return $this->postHandler->getField($this->v->getRequestPassword());
	}
	private function emptyUserName() {
		return $this->userName() == "";
	}
	private function shortUserName() {
		$userName = $this->postHandler->getField($this->v->getRequestUserName());
		return strlen($userName) < $this->m->minLengthUserName();
	}
	private function emptyPassword() {
		return $this->password() == "";
	}
	private function shortPassword() {
		$password = $this->postHandler->getField($this->v->getRequestPassword());
		return strlen($password) < $this->m->minLengthPassword();
	}
	private function differentPasswords() {
		$password = $this->postHandler->getField($this->v->getRequestPassword());
		$passwordRepeat = $this->postHandler->getField($this->v->getRequestPasswordRepeat());
		return $password != $passwordRepeat;
	}
	private function unavailableUserName() {
		$candidate = $this->postHandler->getField($this->v->getRequestUserName());
		return $this->m->unavailableUserName($candidate);
	}
	private function removeInvalidCharacters($a) {
		preg_match($this->validateRegex, $a, $match);
		return $match[1];
	}
	private function invalidCharacters() {
		$a = $this->postHandler->getField($this->v->getRequestUserName());
		preg_match($this->validateRegex, $a, $match);
		return isset($match[1]);
	}
}
