<?php
ini_set('display_errors',1);
 error_reporting(E_ALL);
    include("$_SERVER[DOCUMENT_ROOT]/connect.php");
    include("$_SERVER[DOCUMENT_ROOT]/project1/includes/accountUtil.inc");
    include("$_SERVER[DOCUMENT_ROOT]/project1/includes/tags.php");
function tagSelectHtml($tags, $tagId){
    $html = "<select id='$tagId' class='tagDropdown'>
    <option value=\"\"></option>";
    for($i=0; $i < count($tags); $i++){
      $tag= $tags[$i];
      $html.="<option value=\"$tag\">$tag</option>";
    }
    $html.="</select>";
    return $html;
}
?><!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
   <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
      <link rel="stylesheet" href="../styles/main.css">
  <title>haystack</title>
  <style>
    #post-area {
      margin-top: 30px;
    }

    input{
    color:black;
    }


    .input-label {
        width: 90px;
    }
    .content {
      min-height: 80px;
      width: 600px;
    }
    .voteNow {
    position:absolute;
    margin-left:60px;
    margin-bottom:10px;

      cursor: pointer;
    }
    .votes {
      position: absolute;
      width: 187px;
    }
    .tagsdiv {
      position: absolute;
      width: 493px;
      margin-left: 100px;
      font-size: 0.8em;
      font-style: italic;
    }
    .loginInfo{
    width: 600px;
    align: center;
    height: 200px;

    }
    #logindiv, #logoutdiv{
    float:right;
      margin-right: 96px;
    }
    .tags {
      float: right;
    }
    .bottombar {
      height: 20px;
    }
    .content-text {
      font-size: 0.9em;
      color: #991122;
    }
    #loginerror {
      color: #ff0000;
    }
    .email-note {
      font-size: 0.7em;
      font-style: italic;
      margin-left: 59px;
      margin-bottom: 20px;
    }

  </style>
  <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js" type="text/javascript"></script>
  <script type="text/javascript">

    $(document).ready(function() {
      $("#post").click(postContent);
      $("#show").click(showPosts);
      $("#login").click(login);
      $("#logout").click(logout);
      $("#register").click(register);
    });

    function logout() {
      $("#loginerror").html('');

      $("#logout").hide();
      $.ajax({
        type: "GET",
        url: "/project1/ajax/logout.php",
        dataType: "json",
        success: function(json) {
          $("#logindiv").show();
          $("#logoutdiv").hide();
          $("#logged-in-user").html('');
          $(".vote").remove();
        }
      });
    }

    function login() {
      var username = $("#username").val();

      var params = {
        username: username,
        password: $("#password").val()
      };

      $("#loginerror").html('');

      $.ajax({
        type: "GET",
        url: "/project1/ajax/login.php",
        data: params,
        dataType: "json",
        success: function(json) {
          if (json.status == 'pass') {
            $("#logged-in-user").html(username);
            $("#logindiv").hide();
            $("#logoutdiv").show();
          } else {
            $("#loginerror").html(json.error);
          }
        }
      });
    }

    function register() {
      var username = $("#username").val();

      var params = {
        username: username,
        email: $("#email").val(),
        password: $("#password").val()
      };

      $("#loginerror").html('');

      $.ajax({
        type: "GET",
        url: "/project1/ajax/submitRegistration.php",
        data: params,
        dataType: "json",
        success: function(json) {
          if (json.status == 'pass') {
            $("#logged-in-user").html(username);
            $("#logindiv").hide();
            $("#logoutdiv").show();
          } else {
            $("#loginerror").html(json.error);
          }
        }
      });
    }

    function isLoggedIn() {
      return $("#logged-in-user").html() != '';
    }

    function showPosts() {
      var params = { };

      $.ajax({
        type: "GET",
        url: "/project1/ajax/getPosts.php",
        data: params,
        dataType: "json",
        success: function(json) {
          var html = '';
          var loggedIn = isLoggedIn();

          for (var i=0;i<json.length;i++) {
            html += "<div class='singlepost'>";

            html += "<div class='content'>Posted: <span class='content-text'>" + json[i].content.replace(/\n/g, "<br/>") + '</span></div><div class="bottombar">';
            html += "<div class='votes'>Votes: " + json[i].votes+"</div>";
            if (loggedIn) {
              html += " <div class='voteNow' postid='" + json[i].post_id + "'>(Vote!)</div>";
            } else {
              html += " <div>(Login to vote)</div>";
            }

            html += "<div class='tagsdiv'><div class='tags'>Tags: " + json[i].tags+ '</div></div>';
            html += "</div></div>";
          }

          $("#posts").html(html);
          $(".voteNow").click(vote);
        }
      });
    }

    function vote() {
      var params = {
        postid: $(this).attr('postid')
      };

      $(this).remove();
      $('#errorMsg').html('').hide();
      $.ajax({
        type: "GET",
        data: params,
        url: "/project1/ajax/vote.php",
        dataType: "json",
        success: function(json) {
          if(json.status=='fail'){
            $('#errorMsg').html(json.error).show();

          }
        }
      });
    }

    function postContent() {
      var content = $("#content").val();
      var tag1 = $("#tag_id1 option:selected").val();
      var tag2 = $("#tag_id2 option:selected").val();
      var tag3 = $("#tag_id3 option:selected").val();
      var tags = tag1;
      if(tag2 !== ''){
        tags+=',' + tag2;
      }
      if(tag3 !== ''){
        tags+= ',' + tag3;
      }
      var params = { content: content, tags: tags };

      $.ajax({
        type: "POST",
        data: params,
        url: "/project1/ajax/post.php",
        dataType: "json",
        success: function(json) {
        }
      });
    }

  </script>
</head>
<body class="list-group">
 <div class="header">

      <div>
      <img src="../images/haystackdarkbackground.png"/>
      </div>

    </div>
<?php if (isLoggedIn()) { ?>
<div  class="loginInfo" id="logoutdiv">
  <?php } else { ?>
  <div id="logoutdiv" style="display: none;">
    <?php } ?>
    You are logged in as:
    <span id="logged-in-user">
    <?php
        if (isLoggedIn()) {
            echo $_SESSION['username'];
        }
    ?>
    </span><br/>
    <input type="button" class="btn btn-primary" id="logout" value="Logout"/>
  </div>
  <div class="loginInfo">
  <?php if (isLoggedIn()) { ?>
  <div id="logindiv" style="display: none; ">
    <?php } else { ?>
    <div id="logindiv">
      <?php } ?>
      <label class='input-label' for="tags">Username:</label><input type="text" id="username" value=""/><br/>
      <label class='input-label' for="tags">Password:</label><input type="password" id="password" value=""/><br/>
      <label class='input-label' for="tags">E-Mail:</label><input type="text" id="email" value=""/><br/>
      <div class='email-note'>Only needed if registering</div>
      <input type="button" class="btn btn-primary" id="login" value="Login"/>
      <input type="button" class="btn btn-primary" id="register" value="Register"/>
    </div>
    <div id="loginerror">
    </div>
    </div>
    <div class="post-row" id="post-area">
      <textarea id="content" class="subBox" value='' rows="4" cols="50"></textarea><br/>
      <label for="tags">Tag 1:</label><?php echo tagSelectHtml($tags, "tag_id1"); ?>
      <label for="tags">Tag 2:</label><?php echo tagSelectHtml($tags, "tag_id2"); ?>
      <label for="tags">Tag 3:</label><?php echo tagSelectHtml($tags, "tag_id3"); ?>
    </div>
    <div>
      <input type="button" id="post" class="btn btn-primary post-button right" value="Post"/>
    </div>
    <div>
      <input type="button" id="show" class="btn btn-primary rightButton" value="Show Posts"/>
    </div>
    <div id="posts" class="post-row subBox">
    </div>
</body>
</html>
