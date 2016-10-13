<?php

namespace controller;

class PostHandler {
	public function __construct() {
	}

	public function hasField($field) {
		return isset($_POST[$field]);
	}

	public function getField($field) {
		return $_POST[$field];
	}
}
