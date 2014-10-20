<?php

if (!function_exists('sec2hms')) {
	function sec2hms($s) {
		$h = (int) ($s / 3600);
		$m = (int) (($s % 3600) / 60);
		$s = $s % 60;

		$h = $h < 10 ? '0'.$h : $h;
		$m = $m < 10 ? '0'.$m : $m;
		$s = $s < 10 ? '0'.$s : $s;

		return $h.':'.$m.':'.$s;
	}
}

if (!function_exists('encodePassword')) {
	function encodePassword($pw) {
		return sha1($pw);
	}
}

?>
