<?php

header('content-type: application/json; charset=utf-8');

include("$_SERVER[DOCUMENT_ROOT]/connect.php");
include("$_SERVER[DOCUMENT_ROOT]/project1/includes/accountUtil.inc");

if (!isset($_GET['username'])) {
    showErrorJson('missing username');
    return;
}
if (!isset($_GET['email'])) {
    showErrorJson('missing email');
    return;
}
if (!isset($_GET['password'])) {
    showErrorJson('missing password');
    return;
}

$password = $_GET['password'];

if (strlen($password) == 0) {
    showErrorJson('password empty');
    return;
}
if (strlen($password) < 6) {
    showErrorJson('password is too short');
    return;
}
$username = $_GET['username'];
$email = $_GET['email'];
if (doesUsernameExist($username)) {
    showErrorJson('username exists: '.$username);
    return;
}
if (doesEmailExist($email)) {
    showErrorJson('Email exists: '.$email);
    return;
}

$salt = strtolower($username.$email);
$cryptPassword = cryptPassword($salt, $password);

$sql = "insert into users (username, email, crypt_password, salt) values ('".mysql_real_escape_string($username)."', '".mysql_real_escape_string($email)."','".mysql_real_escape_string($cryptPassword)."','".mysql_real_escape_string($salt)."')";
$result = mysql_query($sql);
if ($result) {
    echo "{\"status\":\"pass\"}";
    if (!isset($_SESSION)) {
        session_start();
    } else {
        session_destroy();
        session_start();
    }
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
} else {
    showErrorJson('An error has occurred.  Please try again');
}

function showErrorJson($s) {
    echo "{\"status\":\"fail\",\"error\":\"$s\"}";
}

function doesUsernameExist($user) {
    $sql = "select count(*) as count from users where username = '".mysql_real_escape_string($user)."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    if ($row['count'] == '0') {
        return false;
    }

    return true;
}

function doesEmailExist($email) {
    $sql = "select count(*) as count from users where email = '".mysql_real_escape_string($email)."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    if ($row['count'] == '0') {
        return false;
    }

    return true;
}
