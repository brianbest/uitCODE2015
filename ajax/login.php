<?php

header('content-type: application/json; charset=utf-8');

include("$_SERVER[DOCUMENT_ROOT]/connect.php");
include("$_SERVER[DOCUMENT_ROOT]/includes/accountUtil.inc");

if (isset($_SESSION['username'])) {
    showErrorJson('User already logged in. Please logout first');
    return;
}

if (!isset($_GET['username'])) {
    showErrorJson('missing username');
    return;
}

if (!isset($_GET['password'])) {
    showErrorJson('missing password');
    return;
}

$username = $_GET['username'];
$password = $_GET['password'];

$userInfo = getUserInfo($username);

if ($userInfo == null) {
    echo "{\"status\":\"fail\",\"error\":\"username doesn't exist\"}";
    return;
}

$salt = strtolower($username.$userInfo['email']);
$cryptPassword = cryptPassword($salt, $password);

if ($cryptPassword != $userInfo['crypt_password']) {
    echo "{\"status\":\"fail\",\"error\":\"invalid password for user $username\"}";
    return;
}

if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['username'] = $username;
$_SESSION['email'] = $userInfo['email'];


echo "{\"status\":\"pass\",\"email\":\"$userInfo[email]\"}";

function getUserInfo($user) {
    $sql = "select * from users where username = '".mysql_real_escape_string($user)."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    return $row;
}

function showErrorJson($s) {
    echo "{\"status\":\"fail\",\"error\":\"$s\"}";
}

?>
