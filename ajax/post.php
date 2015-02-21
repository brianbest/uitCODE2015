<?php

header('content-type: application/json; charset=utf-8');

include("$_SERVER[DOCUMENT_ROOT]/connect.php");

if (isset($_POST['content'])) {
    $request = $_POST;
} else {
    $request = $_GET;
}

if (isset($request['username'])) {
    $userId = getUserId($request['username']);
} else {
    $userId = 0;
}

if (isset($request['tags'])) {
    $tags = $request['tags'];
} else {
    $tags = '';
}

$content = $request['content'];

$sql = "insert into posts (user_id, votes, content, tags) values ($userId, 0, '".mysql_real_escape_string($content)."', '".mysql_real_escape_string($tags)."')";
$result = mysql_query($sql);

echo "{\"status\":\"pass\"}";

function getUserId($username) {
    $sql = "select id from users where username = '".mysql_real_escape_string($username)."'";
    $result = mysql_query($sql);

    $row = mysql_fetch_assoc($result);

    if ($row == null) {
        return 0;
    }

    return $row['id'];
}
