<?php

require '../fb/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '197425023685825',
  'secret' => '797a834b8d86546b601316d01c8b9933',
));

// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
    $user = null;
  }
}

?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
	
<body>
	<div id="fb-root"></div>
	<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=197425023685825";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	
	function postFeed() {

        // calling the API ...
        var obj = {
          method: 'feed',
          link: 'https://developers.facebook.com/docs/reference/dialogs/',
          picture: 'http://fbrell.com/f8.jpg',
          name: 'Facebook Dialogs',
          caption: 'Reference Documentation',
          description: 'Using Dialogs to interact with users.',
		  message: 'Using FB is cool'
        };

        function callback(response) {
          document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
        }

        FB.ui(obj, callback);
      }
	</script>
    <?php if ($user) { ?>
      Your user profile is
      <pre>
        <?php echo "Welcome ".$user_profile['name']; ?>
      </pre>
    <?php } else { ?>
      <fb:login-button></fb:login-button>
    <?php } ?>
	
    <!--<fb:comments href="http://www.tweetcoder.com" num_posts="2" width="470"></fb:comments-->
    <input type="button" value="post" onClick="postFeed()" />
	
    <p id='msg'></p>
  </body>
</html>
