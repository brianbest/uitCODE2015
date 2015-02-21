<?php

if (!isset($_SESSION)) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['username']);
}

function cryptPassword($salt, $pw) {
	return sha1("--$salt--$pw--");
}

?>
