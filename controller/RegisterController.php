<?php


class RegisterController {
	private $m;
	private $v;
	public function __construct(RegisterModel $m, RegisterView $v) {
		$this->m = $m;
		$this->v = $v;
	}

	public function run() {
		if ($this->registerWasPressed() && $this->invalidInput()) {
			$this->m->setMessage($this->m->noInputStatement());
		}
	}
	private function registerWasPressed() {
		return isset($_POST[$this->v->getRequestRegister()]);
	}
	private function invalidInput() {
		if ($_POST[$this->v->getRequestUserName()] == "") {
			return true;
		}
	}

}
