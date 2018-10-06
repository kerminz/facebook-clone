<?php

include 'controller/imageResizer.php';

class Posting {
	
	

	
// --------------------------------- saves post to database -----------------------

	function savePost($userPost, $linkTitle, $linkDesc, $linkUrl, $linkImage, $imageName, $tmpImage, $videoFile, $cookieId, $sessionId, $link, $longt, $lat, $ort, $linkVideo) {

		if (isset($imageName)) {
	
			$imageExt = explode(".", $imageName);
			
			if ($videoFile == true) {
// 				$imageExtension = 'm4v';
				$imageExtension = $imageExt[1];
			} else {
				$imageExtension = $imageExt[1];
			}
			
			$random = rand(0, 100000).rand(0, 100000).rand(0, 100000).time().".";
			
			
			if ($videoFile == true) {
				
				$image = $random."mp4";
				$targetImage = "images/video/".$image;
				
				
				
			} else {
				
				$image = $random.$imageExtension;
				
				$targetImage = "images/timeline/".$image;
				
				//move tmp image to destination folder
				move_uploaded_file($tmpImage, $targetImage);

				
			}	
			
			
			
			// resize image
			
			if (!$videoFile == true) {
				
				$sourceImage = $targetImage;
				
				$resizer = new ImageResizer();
				$resizer->resizeImage($sourceImage, $targetImage, 1200, 800, 80);
				
				list($width, $height) = getimagesize($targetImage);
			
			}
			// createing poster for video
			if ($videoFile == true) {
				
				$ffmpeg = "/usr/bin/ffmpeg";
				$videoFile = $tmpImage;
				$imageFile = "images/video/thumbs/".$random."jpg";
				$size = "478x270";
				$getFromSecond = 5;
				$cmd = "$ffmpeg -i $videoFile -an -ss $getFromSecond -s $size $imageFile";
				shell_exec($cmd);

				$videoThumb = $random."jpg";
				
				
				

			}
		}
			
	
		
	
		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}
	
	
		if(strlen(trim($userPost)) > 0 || isset($image)) {
			
			$time = time();

		
			$query = "INSERT INTO `postings` (`post`, `userId`, `timestamp`, `image`, `imgWidth`, `imgHeight`, `videoThumb`, `linkTitle`, `linkDesc`, `linkUrl`, `linkImage`, `longt`, `lat`, `ort`, `linkVideo`) VALUES ('".$userPost."', '".$id."', '".$time."', '".$image."', '".$width."', '".$height."', '".$videoThumb."', '".$linkTitle."', '".$linkDesc."', '".$linkUrl."', '".$linkImage."', '".$longt."', '".$lat."', '".$ort."', '".$linkVideo."') ";
			$result = mysqli_query($link, $query);
		
			
			if ($videoFile == true) {
				
				$ffmpeg = "/usr/bin/ffmpeg";
				$cmd2 = "$ffmpeg -i $tmpImage -c:a copy -c:v libx264 -preset superfast -profile:v baseline $targetImage";
				shell_exec($cmd2);
				
			}
			
		}
		
		

	}

	// --------------------------------- saves post to database END -----------------------
	
	
	
	
	// --------------------------------- saves avatar to database -----------------------

	function saveAvatar($imageName, $tmpImage, $cookieId, $sessionId, $link) {

		if (isset($imageName)) {
	
			$imageExt = explode(".", $imageName);
			$imageExtension = $imageExt[1];
			$image = rand(0, 100000).rand(0, 100000).rand(0, 100000).time().".".$imageExtension;
			
			$targetImage = "images/avatar/".$image;
			
			move_uploaded_file($tmpImage, $targetImage);
			
			$sourceImage = $targetImage;
			
			$resizer = new ImageResizer();
			$resizer->resizeImage($sourceImage, $targetImage, 400, 400, 80);
			
			list($width, $height) = getimagesize($targetImage);
			
		}
			
	
		
	
		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}
	
	
		if(isset($image)) {
			
			$time = time();
			
			$queryCheck = "SELECT * FROM `avatar` WHERE userId = '".$id."' ";	
			$resultCheck = mysqli_query($link, $queryCheck);
			$row = mysqli_num_rows($resultCheck);
			
			if ($row) {
				
				$query = "UPDATE `avatar` SET `userId` = '".$id."', `timestamp` = '".$time."', `image` = '".$image."', `imgWidth` = '".$width."', `imgHeight` = '".$height."' WHERE userId = '".$id."' ";
				mysqli_query($link, $query);
			
				
				
			} else {
				
				$query = "INSERT INTO `avatar` (`userId`, `timestamp`, `image`, `imgWidth`, `imgHeight`) VALUES ('".$id."', '".$time."', '".$image."', '".$width."', '".$height."') ";
				mysqli_query($link, $query);
				
				
			}
		
			
			
			
		}
		
		

	}

	// --------------------------------- saves avatar to database END -----------------------
	
	
	
	// --------------------------------- saves avatar to database -----------------------

	function saveCover($imageName, $tmpImage, $cookieId, $sessionId, $link) {

		if (isset($imageName)) {
	
			$imageExt = explode(".", $imageName);
			$imageExtension = $imageExt[1];
			$image = rand(0, 100000).rand(0, 100000).rand(0, 100000).time().".".$imageExtension;
			
			$targetImage = "images/cover/".$image;
			
			move_uploaded_file($tmpImage, $targetImage);
			
			$sourceImage = $targetImage;
			
			$resizer = new ImageResizer();
			$resizer->resizeImage($sourceImage, $targetImage, 1200, 800, 80);
			
			list($width, $height) = getimagesize($targetImage);
			
		}
			
	
		
	
		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}
	
	
		if(isset($image)) {
			
			$time = time();
			
			$queryCheck = "SELECT * FROM `cover` WHERE userId = '".$id."' ";	
			$resultCheck = mysqli_query($link, $queryCheck);
			$row = mysqli_num_rows($resultCheck);
			
			if ($row) {
				
				$query = "UPDATE `cover` SET `userId` = '".$id."', `timestamp` = '".$time."', `image` = '".$image."', `imgWidth` = '".$width."', `imgHeight` = '".$height."' WHERE userId = '".$id."' ";
				mysqli_query($link, $query);
			
				
				
			} else {
				
				$query = "INSERT INTO `cover` (`userId`, `timestamp`, `image`, `imgWidth`, `imgHeight`) VALUES ('".$id."', '".$time."', '".$image."', '".$width."', '".$height."') ";
				mysqli_query($link, $query);
				
				
			}
		
			
			
			
		}
		
		

	}

	// --------------------------------- saves avatar to database END -----------------------

	
	

	
	// --------------------------------- saves comment to database -----------------------

	function saveComment($userComment, $commentImage, $cookieId, $sessionId, $postId, $link) {
		
		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}

	
		if(strlen($userComment) > 0) {
			
			$time = time();
		
			$query = "INSERT INTO `comments` (`comment`, `userId`, `postId`, `timestamp`, `image`) VALUES ('".$userComment."', '".$id."', '".$postId."', '".$time."', '".$commentImage."') ";
			mysqli_query($link, $query);
		
		}
	
	
	}

	// --------------------------------- saves comment to database END -----------------------



	// --------------------------------- gets all Posts from database an puhsh them to pusher.com -----------------------
	function postPusher ($userPost, $imageName, $hasPosted) {
		
		if ((isset($userPost) || isset($imageName)) && $hasPosted == true) { // Pushing flag 
			
			$flag = 1;
			
		} else {
			
			$flag = 0;
			
		}
		
/*
		if (isset($cookieId)) {
			
			$id = $cookieId;
			
		} else {
			
			$id = $sessionId;
			
		}

		
		
		$query = "SELECT users.name, users.id as userId, postings.post, postings.id, postings.timestamp, postings.image, postings.imgWidth, postings.imgHeight FROM `users` JOIN `postings` ON users.id = postings.userId WHERE EXISTS (SELECT * FROM `relations` WHERE ( (userOneId = '".$id."' OR userTwoId = '".$id."') AND (userOneId = postings.userId OR userTwoId = postings.userId )) AND relations.status=1 ) ORDER BY postings.timestamp DESC";
			
		$result = mysqli_query($link, $query);
			
		if (mysqli_num_rows($result) > 0) {
				              
			while($row = mysqli_fetch_assoc($result) ) {
					              
				$arr[] = $row;
				        
			}	              
		}

	
		$arr[-1] = array("id" => $id);
*/
				
		$data = $flag;
		
		require('lib/Pusher.php');
	
		// get your account on pusher.com for free 
		$pusher = new Pusher('XXXXXXXXX', 'XXXXXXXXX', 'XXXXXXXXXXXX');
	
		$pusher->trigger('userPosts', 'new_userPost', $data);
		
		
	}
	// --------------------------------- gets all Posts from database an puhsh them to pusher.com END -----------------------
	
	
	
	// --------------------------------- gets all comments from database an puhsh them to pusher.com -----------------------
	function commentPusher ($userComment) {
		
		if (isset($userComment)) { // Pushing flag 
			
			$flag = 1;
			
		} else {
			
			$flag = 0;
			
		}

		
		$data = $flag;
		
		$pusher = new Pusher('3c798fcb82652ae5d969', 'a427a3d92a361615dcad', '152996');
	
		$pusher->trigger('userComments', 'new_userComment', $data);
		
		
	}
	// --------------------------------- gets all comments from database an puhsh them to pusher.com END -----------------------
	
	
	function saveUserBio($userBio, $sessionId, $cookieId, $link) {
		
		if (isset($userBio)) {
			
			if (isset($cookieId)) {
				
				$id = $cookieId;
				
			} else {
				
				$id = $sessionId;
				
			}
	
			
			$query = "UPDATE `users` SET `bio` = '".$userBio."' WHERE id = '".$id."' ";
		
			$result = mysqli_query($link, $query);
			
			
			$queryReturn = "SELECT bio FROM `users` WHERE id = '".$id."' ";
	
			$resultReturn = mysqli_query($link, $queryReturn);
			
			$row = mysqli_fetch_array($resultReturn);
			echo $row['bio'];

		}
				

		
	}



	function deletePost ($postId, $link) {
		

		$query = "DELETE FROM postings WHERE id = '".$postId."' ";
		mysqli_query($link, $query);
		

		
	}

	
	function likeIt ($like, $sessionId, $cookieId, $link) {
		
		if ($like) {
			
			if (isset($cookieId)) {
			
				$id = $cookieId;
			
			} else {
			
				$id = $sessionId;
			
			}

			$query1 = "SELECT postId, userId FROM `likes` WHERE postId = $like AND userId = $id ";	
			$result1 = mysqli_query($link, $query1);
			
			if (mysqli_num_rows($result1) > 0) {
				$query3 = "DELETE FROM `likes` WHERE postId = $like AND userId = $id";
				mysqli_query($link, $query3);
			} else {
				$query = "INSERT INTO `likes` (`userId`, `postId`) VALUES ('".$id."', '".$like."')";
				mysqli_query($link, $query);
			}
		
		
		
			

		}
		
				
	}
	

	

}





?>