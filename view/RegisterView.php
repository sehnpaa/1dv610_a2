<?php

require_once("model/RegisterModel.php");

class RegisterView {
	private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $messageId = 'RegisterView::Message';
	private static $register = 'RegisterView::Register';

	private $m;

	public function __construct(RegisterModel $m) {
		$this->m = $m;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = $this->m->getMessage();
		/*$name = $this->model->getName();
		if ($this->model->isLoggedIn()) {
			$response = $this->generateLogoutButtonHTML($message);
		} else {
			$response = $this->generateLoginFormHTML($message, $name);
		}*/
		$response = "";
		if ($_SERVER['QUERY_STRING'] == "register" || $_SERVER['QUERY_STRING'] == "register=1") {
			$response = $this->generateRegisterFormHTML($message, "");
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateRegisterFormHTML($message, $name) {
		return '
	<form action="?register" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Register a new user - Write username and password</legend>
			<p id="' . self::$messageId . '">' . $message . '</p>
			<label for="' . self::$name . '">Username :</label>
			<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $name . '" />
			<br/>
			<label for="' . self::$password . '">Password  :</label>
			<input type="password" size="20" name="' . self::$password . '" id="' . self::$password . '" value="" />
			<br/>
			<label for="'. self::$passwordRepeat . '">Repeat password  :</label>
			<input type="password" size="20" name="' . self::$passwordRepeat . '" id="' . self::$passwordRepeat . '" value="" />
			<br/>
			<input id="submit" type="submit" name="' . self::$register . '"  value="Register" />
			<br/>
		</fieldset>
	</form>
		';
	}

	public function getRequestUserName() {
		return self::$name;
	}

	public function getRequestPassword() {
		return self::$password;
	}

	public function getRequestPasswordRepeat() {
		return self::$passwordRepeat;
	}

	public function getRequestRegister() {
		return self::$register;
	}
}
