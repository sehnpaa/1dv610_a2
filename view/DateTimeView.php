<?php

class DateTimeView {


	public function show() {

		$timeString = date("l") . ", the " . date("j") . "th of " . date("F") . " " . date("Y") . ", The time is " . date("H") . ":" . date("i") . ":" . date("s");

		return '<p>' . $timeString . '</p>';
	}
}
