<?php

namespace controller;

class CookieHandler {
	public function __construct() {
	}

	public function manipulatedCookie($passwordField) {
		return $_COOKIE[$passwordField] == "0123456789";
	}
	public function loginAttempt($nameField) {
		return isset($_COOKIE[$nameField]);
	}
}
