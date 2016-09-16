<?php

require_once("model/LoginModel.php");

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $model;

	public function __construct(LoginModel $model) {
		$this->model = $model;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedIn) {
		$message = '';
		$name = '';
		if (empty($_POST)) {
			$message = '';
			$response = $this->generateLoginFormHTML($message, $name);
		} else if (isset($_POST[self::$login]) && $_POST[self::$name] == "") {
			$message = 'Username is missing';
			$response = $this->generateLoginFormHTML($message, $name);
		} else if (isset($_POST[self::$login]) && $_POST[self::$password] == "") {
			$name = $_POST[self::$name];
			$message = 'Password is missing';
			$response = $this->generateLoginFormHTML($message, $name);
		} else if (isset($_POST[self::$login]) && !($_POST[self::$name] == "Admin" && $_POST[self::$password] == "Password")) {
			$name = $_POST[self::$name];
			$message = "Wrong name or password";
			$response = $this->generateLoginFormHTML($message, $name);
		} else if(isset($_POST[self::$logout])) {
			$message = "Bye bye!";
			$response = $this->generateLoginFormHTML($message, $name);
		} else if ($isLoggedIn) {
			$message = "Welcome";
			$response = $this->generateLogoutButtonHTML($message);
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message, $name) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $name . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function getRequestLogin() {
		return self::$login;
	}

	public function getRequestLogout() {
		return self::$logout;
	}

	public function getRequestUserName() {
		return self::$name;
	}

	public function getRequestPassword() {
		return self::$password;
	}
}
