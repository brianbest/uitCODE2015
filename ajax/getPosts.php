<?php

header('content-type: application/json; charset=utf-8');

include("$_SERVER[DOCUMENT_ROOT]/connect.php");

if (isset($_GET['index'])) {
    $index = intval($_GET['index']);
} else {
    $index = 0;
}

if (isset($_GET['amount'])) {
    $amount = intval($_GET['amount']);
} else {
    $amount = 10;
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    $username = null;
}

if (isset($_GET['tag'])) {
    $tags = array($_GET['tag']);
} else {
    $tags = null;
}

if (isset($_GET['tags'])) {
    $tags = explode(',', $_GET['tags']);
} else {
    $tags = null;
}

if (isset($_GET['votes'])) {
    $votes = intval($_GET['votes']);
} else {
    $votes = 0;
}

$where = false;
$sql = "select posts.id as post_id, votes, user_id, username, content, tags from posts left join users on users.id = user_id where votes >= $votes";
for ($i=0;$i<count($tags);$i++) {
    $sql .= " and tags like '%".mysql_real_escape_string($tags[$i])."%'";
}
if ($username != null) {
    $sql .= " and username = '".mysql_real_escape_string($username)."'";
}
$sql .= " order by votes desc";

$sql .= " limit $index, $amount";
$result = mysql_query($sql);
$posts = array();
while ($row = mysql_fetch_assoc($result)) {
    if ($row['user_id'] == '0') {
        $row['username'] = '';
    }
    $row['tags'] = explode(',', $row['tags']);
    $posts[] = $row;
}

echo json_encode($posts);

