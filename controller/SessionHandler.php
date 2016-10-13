<?php

namespace controller;

class SessionHandler {
	public function __construct() {
		session_start();
	}

	public function clear() {
		session_unset();
	}

	public function authenticate() {
		$_SESSION['is_auth'] = true;
	}

	public function isAuthenticated() {
		return isset($_SESSION['is_auth']);
	}
}
