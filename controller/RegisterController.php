<?php


class RegisterController {
	private $m;
	private $v;
	public function __construct(RegisterModel $m, RegisterView $v) {
		$this->m = $m;
		$this->v = $v;
	}

	public function run() {
		if ($this->registerWasPressed() && $this->emptyUserName() && $this->emptyPassword()) {
			$this->m->setMessage($this->m->noInputStatement());
		} else if ($this->registerWasPressed() && $this->emptyPassword()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->shortPasswordStatement());
		} else if ($this->registerWasPressed() && $this->shortUserName()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->shortUserNameStatement());
		} else if ($this->registerWasPressed() && $this->shortPassword()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->shortPasswordStatement());
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

}
