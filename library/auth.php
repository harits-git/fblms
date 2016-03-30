require_once 'fb/facebook.php';



$app_id     = "197425023685825";
$app_secret = "797a834b8d86546b601316d01c8b9933";
$canvas_page = "http://apps.facebook.com/social_lms/";

$auth_url = "http://www.facebook.com/dialog/oauth?client_id=". $app_id . "&redirect_uri=" . urlencode($canvas_page);

 
$signed_request = $_REQUEST["signed_request"];

list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

     if (empty($data["user_id"])) {
            echo("<script> top.location.href='" . $auth_url . "'</script>");
     } else {
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
		}