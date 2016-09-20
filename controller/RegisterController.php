<?php


class RegisterController {
	private $m;
	private $v;
	public function __construct(RegisterModel $m, RegisterView $v) {
		$this->m = $m;
		$this->v = $v;
	}

	public function run() {
		if ($this->registerWasPressed() && $this->emptyUserName()) {
			$this->m->setMessage($this->m->noInputStatement());
		} else if ($this->registerWasPressed() && $this->emptyPassword()) {
			$this->m->setName($_POST[$this->v->getRequestUserName()]);
			$this->m->setMessage($this->m->emptyPasswordStatement());
		}
	}
	private function registerWasPressed() {
		return isset($_POST[$this->v->getRequestRegister()]);
	}
	private function emptyUserName() {
		return $_POST[$this->v->getRequestUserName()] == "";
	}
	private function emptyPassword() {
		return $_POST[$this->v->getRequestPassword()] == "";
	}

}
