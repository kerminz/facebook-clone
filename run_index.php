<?php 
	
	include 'user.php';
	include 'posting.php';
	include 'controller/connection.php';
	include 'relations.php';

	
	$data = json_decode(file_get_contents("php://input")); // waiting for Json Data
	$userPost = $data->userPost;
	
	$linkTitle = $data->linkTitle;
	$linkDesc = $data->linkDesc;
	$linkUrl = $data->linkUrl;
	$linkImage = $data->linkImage;
	$linkVideo = $data->linkVideo;
	$longt = $data->longt;
	$lat = $data->lat;
	$ort = $data->ort;
	$like = $data->like;
	
	$userComment = $data->userComment;
	$commentImage = $data->image;
	$postId = $data->postId;
	$deletePostId = $data->deletePostId;
	$userTwoId = $data->userTwoId;
	$status0 = $data->status0;
	$status1 = $data->status1;
	$userBio = $data->bio;

	
	if (!$userPost = $data->userPost) {
		$userPost = $_POST['userPost'];	
		$linkTitle = $_POST['linkTitle'];
		$linkDesc = $_POST['linkDesc'];
		$linkUrl = $_POST['linkUrl'];
		$linkImage = $_POST['linkImage'];
		$longt =  $_POST['longt'];
		$lat =  $_POST['lat'];
		$ort = $_POST['ort'];
		$linkVideo = $_POST['linkVideo'];
	}
	
	
	
	//var_dump($_FILES['file']);

	
	$imageName = $_FILES['file']['name'];
	$tmpImage = $_FILES['file']['tmp_name'];
	$imageSize = $_FILES['file']['size'];
	$thisImageType = $_FILES['file']['type'];
	if (($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/GIF") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/PNG")) {
		$videoFile = false;
	} else {
		$videoFile = true;
	}



	session_start();
		
	$cookieId = $_COOKIE['id'];
	$sessionId = $_SESSION['id'];
	
	
	
	//------ RUN --------
	
	//** getting User Information **
	$user = new User();
	$userName = $user->getUserName($sessionId, $cookieId, $link);
	
	
	//** Post handling **
	$post = new Posting();
	
	if(isset($_POST['avatar'])) {
		$post->saveAvatar($imageName, $tmpImage, $cookieId, $sessionId, $link);
	} else if(isset($_POST['cover'])) {
		$post->saveCover($imageName, $tmpImage, $cookieId, $sessionId, $link);
	} else {
		$post->savePost($userPost, $linkTitle, $linkDesc, $linkUrl, $linkImage, $imageName, $tmpImage, $videoFile, $cookieId, $sessionId, $link, $longt, $lat, $ort, $linkVideo);
		$hasPosted = true;
	}
	
	if (isset($deletePostId)) {
		$post->deletePost ($deletePostId, $link);
	}
	
	
	
	
	$post->postPusher($userPost, $imageName, $hasPosted);
	$post->saveComment($userComment, $commentImage, $cookieId, $sessionId, $postId, $link);
	$post->commentPusher($userComment);
	$post->saveUserBio($userBio, $sessionId, $cookieId, $link);
	$post->likeIt ($like, $sessionId, $cookieId, $link);
	
	//** Relationship handling **
	$relation = new Relation();
	$relation->sendFriendRequest($sessionId, $cookieId, $userTwoId, $status0, $link);
	$relation->acceptFriendRequest($sessionId, $cookieId, $userTwoId, $status1, $link);
	echo $relation->checkFriendship ($sessionId, $cookieId, $userTwoId, $link);
	








// ------------  display php errors ------------ 

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
// ------------ display php errors END ---------



	
?>