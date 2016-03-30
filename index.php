<?php

require_once 'config.php';
require 'library/fb/facebook.php';


$app_id     = "100248683431454";
$app_secret = "49d1f65a43c88ab46117b2140b0c1dd7";
$canvas_page = "http://apps.facebook.com/social_lms/";

$auth_url = "http://www.facebook.com/dialog/oauth?client_id=". $app_id . "&redirect_uri=" . urlencode($canvas_page);

             $facebook = new Facebook(array(
		  'appId'  => $app_id,
		  'secret' => $app_secret,
		));
		
		// See if there is a user from a cookie
		$user = $facebook->getUser();
		
		if ($user) {
		  try {
		    // Proceed knowing you have a logged in user who's authenticated.
		    $user_profile = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
		    echo("<script> top.location.href='" . $auth_url . "'</script>");
		    $user = null;
		  }
		}else{
			echo("<script> top.location.href='" . $auth_url . "'</script>");
		}
//echo "alias ".$_SESSION["alias"];
if($_GET["back"] == '1'){
	unset($_SESSION["alias"]);
}
if($_GET["alias"] != ""){ 
	$_SESSION["alias"] = $_GET["alias"];
}
if($_SESSION["alias"] != ""){
	$dummyFBID = $_SESSION["alias"];
	echo "<a href='index.php?back=1'>back to login</a>";
}else{
	$dummyFBID = $user_profile['id']; //'123';//this FB ID will be taken from FB Oser Profile 123->student,3333333->lecturer
}

$rs = $db->Execute("select * from user where fbid='".$dummyFBID."'"); 
if (!$rs) 
{
    echo 'error SQL';//db->ErrorMsg();
}
else
{
	$dummyUserExist = true;
	$userType = $rs->fields['user_type'];
	$userStatus = $rs->fields['status'];
	//if($userType == "headmaster"){
	  // if($_GET['ut'] != ''){ 
	    //  $userType = $_GET['ut'];
	   //}
	//}
	//echo "type ".$userType;
	//echo "<br>status ".$userStatus;
}
//$rs = $db->Execute("insert into user_last_login(user_id) values(user_id=".$dummyFBID.")");
//$db->Close();
?>
<!doctype html>
<html xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    <title>LMS test</title>
    <link type="text/css" rel="stylesheet" href="style.css" />
  </head>
  <body>
  <div id="fb-root"></div>
	<script>
	window.fbAsyncInit = function() {
	        FB.init({
	          appId  : '100248683431454',
	          status : true, // check login status
	          cookie : true, // enable cookies to allow the server to access the session
	          xfbml  : true  // parse XFBML
        });
      };

      (function() {
	        var e = document.createElement('script');
	        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
	        e.async = true;
	        document.getElementById('fb-root').appendChild(e);
      }());
	
function postToFeed(nm,cap,des,tar) {

        // calling the API ...
        var obj = {
          method: 'feed',
          link: 'http://apps.facebook.com/social_lms/',
          name: nm,
          caption: cap,
          description: des,
	  to: tar
        };

        function callback(response) {
          if (!response || response.error) {
            alert('User cannot accept your Post!');
          }
          
        }

        FB.ui(obj, callback);
}
function sendRequest() {
	var msg='I want to be a Student.';
	if(type=='t') msg='I want to be a Lecturer.';
  FB.ui({
  	method: 'apprequests',
    	message: msg,
    	to: '1'
  }, requestCallback);
}

function requestCallback(response) {
        // Handle callback here
      }
	</script>
  <div class="main">  
	<div class="header">
    <div class="header_resize">
	<div class="logo"><h1>Social Network Learning Management System</h1> </div>
	<h3>Welcome <?php echo $user_profile['name']; ?></h3>
      <div class="clr"></div>
      <div class="menu_nav">  
		
		<?php if($userStatus=='1'){
		//echo "name : ".$dummyFBID.", ".$userStatus.", ".$userType;
		if ($userType == "lecturer" ){ 
			//$_GET["menu"]='application/lecturer/index';
		?>
			
			<ul>
			  <li><a href="index.php?menu=application/lecturer/index.php">Home</a></li>
			  <li><a href="index.php?menu=application/interactive/index.php">Interactive</a></li>
			  <li><a href="index.php?menu=application/lecturer/course.php">Course</a></li>
			  <li><a href="index.php?menu=application/lecturer/grade.php">Grade</a></li>
			  <li><a href="index.php?menu=application/lecturer/student.php">Students</a></li>
			  <li><a href="index.php?menu=application/lecturer/schedule.php">Schedules</a></li>
			</ul>
		<?php } else if ($userType == "student"){ 
			//$_GET["menu"]='application/student/index';
		?>
			<ul>
			  <li ><a href="index.php?menu=application/student_me/index.php">Basic Info</a></li>
			  <li><a href="index.php?menu=application/interactive/index.php">Interactive/Collaborative Learning</a></li>
			  <li><a href="index.php?menu=application/student/admin/index.php">Administrative and Procedural Info</a></li>
			</ul>
		<?php } 
		?>
        
        <div class="clr"></div>
      </div>
	  </div>
	  </div>
    <div class="content">
		<div class="content_resize">
			<?php
			}	
				if(isset($_GET["menu"])){
					include_once $_GET["menu"];
				}else {
					//unset($_SESSION[varname]);
 
					if ($userType=='lecturer')
						include_once "application/".$userType."/index.php";
					else if ($userType=='student')
						include_once "application/".$userType."_me/index.php";
	                
			                else{					
			    		     include_once "application/login/index.php";
			    		     }
			    	}	     
						
			?>
		</div>
	</div>
  </div>	
    
  </body>
</html>
