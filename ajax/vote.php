<?php

header('content-type: application/json; charset=utf-8');

include("$_SERVER[DOCUMENT_ROOT]/connect.php");
include("$_SERVER[DOCUMENT_ROOT]/includes/accountUtil.inc");

if (!isLoggedIn()) {
    showErrorJson("you must be logged in to vote");
    return;
}
if (!isset($_GET['postid'])) {
    showErrorJson("no post to vote");
    return;
}

$username = $_SESSION['username'];

$userId = getUserId($username);
$postId = $_GET['postid'];
if (alreadyVoted($userId, $postId)) {
    showErrorJson("you have already voted for this post");
    return;
}

$sql = "insert into votes (user_id, post_id) values ($userId, '".mysql_real_escape_string($postId)."')";
$result = mysql_query($sql);

$sql = "update posts set votes = votes + 1 where id = $postId";
$result = mysql_query($sql);

echo "{\"status\":\"pass\"}";

function alreadyVoted($userId, $postId) {
    $sql = "select count(*) as count from votes where user_id = $userId and post_id = $postId ";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);

    return $row['count'] != '0';
}

function showErrorJson($s) {
    echo "{\"status\":\"fail\",\"error\":\"$s\"}";
}

function getUserId($username) {
    $sql = "select id from users where username = '".mysql_real_escape_string($username)."'";
    $result = mysql_query($sql);

    $row = mysql_fetch_assoc($result);

    if ($row == null) {
        return 0;
    }

    return $row['id'];
}
