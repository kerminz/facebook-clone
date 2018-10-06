var indexApp = angular.module('indexApp', ['ngFileUpload', 'ngAnimate', 'ui.bootstrap', 'infinite-scroll', 'jp.ng-bs-animated-button', 'ngGeolocation', 'angularReverseGeocode', 'myDirectives', 'mgcrea.ngStrap', 'ngSanitize', 'google.places']);


// Workaround for using angular with HTML5 Video
indexApp.filter("trustUrl", ['$sce', function ($sce) {
        return function (recordingUrl) {
            return $sce.trustAsResourceUrl(recordingUrl);
        };
}]);


    
   
    
indexApp.filter('timeago', function() {
    return function(input, p_allowFuture) {
        var substitute = function (stringOrFunction, number, strings) {
                var string = $.isFunction(stringOrFunction) ? stringOrFunction(number, dateDifference) : stringOrFunction;
                var value = (strings.numbers && strings.numbers[number]) || number;
                return string.replace(/%d/i, value);
            },
            
            nowTime = (new Date()).getTime(),
            date = (new Date(input)).getTime(),
            //refreshMillis= 6e4, //A minute
            allowFuture = p_allowFuture || false,
            strings= {
                prefixAgo: null,
                prefixFromNow: null,
                suffixAgo: "",
                suffixFromNow: "",
                seconds: "gerade eben",
                minute: "vor einer Minute",
                minutes: "%d Min.",
                hour: "vor einer Stunde",
                hours: "vor %d Stunden",
                day: "Gestern",
                days: "vor %d Tagen",
                month: "vor einem Monat",
                months: "vor %d Monaten",
                year: "vor über einem Jahr",
                years: "vor %d Jahren"
            },
            dateDifference = nowTime - date,
            words,
            seconds = Math.abs(dateDifference) / 1000,
            minutes = seconds / 60,
            hours = minutes / 60,
            days = hours / 24,
            years = days / 365,
            separator = strings.wordSeparator === undefined ?  " " : strings.wordSeparator,
        
            // var strings = this.settings.strings;
            prefix = strings.prefixAgo,
            suffix = strings.suffixAgo;
            
        if (allowFuture) {
            if (dateDifference < 0) {
                prefix = strings.prefixFromNow;
                suffix = strings.suffixFromNow;
            }
        }

        words = seconds < 45 && substitute(strings.seconds, Math.round(seconds), strings) ||
        seconds < 90 && substitute(strings.minute, 1, strings) ||
        minutes < 45 && substitute(strings.minutes, Math.round(minutes), strings) ||
        minutes < 90 && substitute(strings.hour, 1, strings) ||
        hours < 24 && substitute(strings.hours, Math.round(hours), strings) ||
        hours < 42 && substitute(strings.day, 1, strings) ||
        days < 30 && substitute(strings.days, Math.round(days), strings) ||
        days < 45 && substitute(strings.month, 1, strings) ||
        days < 365 && substitute(strings.months, Math.round(days / 30), strings) ||
        years < 1.5 && substitute(strings.year, 1, strings) ||
        substitute(strings.years, Math.round(years), strings);

        return $.trim([prefix, words, suffix].join(separator));
        // conditional based on optional argument
        // if (somethingElse) {
        //     out = out.toUpperCase();
        // }
        // return out;
    
    
    }
});

indexApp.controller('timelineCtrl', ['$scope', '$http', 'Upload', '$timeout', '$geolocation', '$sce', function($scope, $http, Upload, $timeout, $geolocation, $sce) {
	
		
	
	$scope.thisIsImage = "";
	$scope.onChange = function (files) {
        
        if (files) {
          if(files[0] == undefined) return;
          
	         $scope.fileExt = files[0].name.split(".").pop();
			 $scope.thisIsImage = $scope.isImage($scope.fileExt);
          
          
        }
     }
        
        $scope.isImage = function(ext) {

          if(ext == "jpg" || ext == "jpeg"|| ext == "gif" || ext=="png" || ext=="JPG" || ext == "JPEG"|| ext == "GIF" || ext=="PNG") {
            return true;
          } else {
	          return false;
          }
        }
        
        
    
    $scope.$watch("post", function (newValue, oldValue) {
	  $timeout(function() {
	    $('.thePosts').each(function() {
	      $(this).magnificPopup({
	        delegate: '.image',
	        type:'image',
	        gallery: {
	         enabled: false
	        },
	        closeOnContentClick: true,
			closeBtnInside: false,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			image: {
				verticalFit: true
			},
			zoom: {
				enabled: false,
				duration: 300 // don't foget to change the duration also in CSS
			}
	        
	     });
	    });
	  });
	});    
	
	
		
	$scope.now = new Date();
	$scope.sessionId = js_var_sessionID;
	
	$scope.imagePath = 'images/timeline/';
	$scope.videoPath = 'images/video/';
	$scope.videoThumbPath = 'images/video/thumbs/';
	
	
/*
	
	$scope.options = {
    buttonDefaultText: 'Posten',
//     buttonSubmittingIcon: 'fa fa-spinner',
    buttonInitialIcon: 'icon icon-cycle',
//     buttonSuccessIcon: 'icon icon-check',
    buttonSubmittingText: 'Senden...',
    buttonSuccessText: 'Gesendet',
    buttonInitialIcon: 'icon icon-new-message',
    onlyIcons: false,
    iconsPosition: 'center',
    animationCompleteTime: '2000',
  	};
*/

  	$scope.showComments = [];

  	$scope.switcher = function(swIndex) {
	  	
	  	if ($scope.showComments[swIndex] == true) {
		  	$scope.showComments[swIndex] = false;
	  	} else {
		  	$scope.showComments[swIndex] = true;
	  	}
	  	
  	}
  	



$scope.getloc = false;

$scope.getLocation = function() {
	
	$scope.$geolocation = $geolocation
	$scope.locInput = true;

    // basic usage
    $geolocation.getCurrentPosition().then(function(location) {
      $scope.location = location
    });

    // regular updates
    $geolocation.watchPosition({
      timeout: 60000,
      maximumAge: 2,
      enableHighAccuracy: true
    });
   
    $scope.coords = $geolocation.position.coords; // this is regularly updated
	$scope.error = $geolocation.position.error; // this becomes truthy, and has 'code' and 'message' if an error occurs
	
	$scope.getloc = true;
	
}



$scope.distanceOfLoc = {};

$scope.distancesOfLocations = function() {

        var myLoc;
        if ($scope.getloc == true) {
        	var currentLng = $scope.location.coords.longitude;
			var currentLat = $scope.location.coords.latitude;
        }
        var locationLng;
        var locationLat;
        var dx;
        var dy;
        

        var distance;
        var distances = new Array();

       
        for (var i = 0; i < $scope.locationsNearMe.length; i++){

            myLoc = $scope.locationsNearMe[i];

            locationLng = myLoc['geometry']['location']['lng'];
            locationLat = myLoc['geometry']['location']['lat'];

            dx = 71.5 * (currentLng - locationLng);
            dy = 111.3 * (currentLat - locationLat);

            distance = Math.sqrt(dx * dx + dy * dy);
			distances[i] = distance;
            $scope[myLoc['id']] = Math.round(distance * 1000);
            nearestLoc = i;
            

            console.log('Distance ' + i + ': ' + distance);
        }

}

$scope.distanceOfPlace = function(id) {
	return $scope[id];
}



$scope.$watch('location', function() {
        $scope.getLocationsNearMe();
    });

$scope.place = null;

$scope.getLocationsNearMe = function() {
	
		if ($scope.getloc == true) {
			$scope.longt = $scope.location.coords.longitude;
			$scope.lat = $scope.location.coords.latitude;
		} else {
			$scope.longt = "";
			$scope.lat = "";
		}
		
		var url = "../../controller/getLocationsNearby.php";
	
		$http.post(url, {'longt': $scope.longt, 'lat': $scope.lat })
			.success(function(response) {
				$scope.locationsNearMe = response['results'];
				console.log("success");
				$scope.distancesOfLocations();
			})
			.error(function(e) {
				console.log("error");
			});
		
	
}

  
  $scope.clearPlace = function() {
	  $scope.place = {};
  }
  
  $scope.clearLocation = function() {
	  $scope.thisLoc = null;
  }
  
  $scope.setLocName = function(locName) {
	  $scope.thisLoc = locName;
  }
  
/*
	$scope.add = function() {
	 	var item = {"name":"Kermin","userId":"60","post":"TEST!!!","id":"1180","timestamp":"1448201452","image":"","imgWidth":"0","imgHeight":"0","avatar":"811135571932221448041213.jpeg"};
	 	$scope.userPosts.splice(0, 0, item);
     
   	}
*/
	
	$scope.ort = function() {
		console.log("Start function ORT")
/*
		if ($scope.getloc == true) {
			return document.getElementById("ort").innerHTML;
		}

*/
		if (($scope.place != undefined || $scope.place > 0) && $scope.thisLoc == undefined) {
			
			console.log("place if entered");
			return $scope.place['name'];
		}
	
		if ($scope.thisLoc != undefined) {
			console.log("thisLoc if entered");
			return $scope.thisLoc;
		}
		
		
	}

	
	
	$scope.linkTitle = function() {
		
		return document.getElementById("linkTitle").innerHTML;
		
	}
	
	
	$scope.linkDesc = function() {
		
		return document.getElementById("linkDesc").innerHTML;
		
	}
	
	
	$scope.linkUrl = function() {
		
		return document.getElementById("linkUrl").innerHTML;
		
	}
	
	$scope.linkVideo = function() {
		
		return document.getElementById("linkVideo").innerHTML;
		
	}
	
	
	$scope.linkImage = function() {
		
		if ( document.getElementById("linkImage").getElementsByClassName("active")[0] != null) {
			return document.getElementById("linkImage").getElementsByClassName("active")[0].getAttribute("src");
		}
		
	}
	
	$scope.clearLink = function() {
		
/*
		document.getElementById("linkTitle").innerHTML = "";
		document.getElementById("linkDesc").innerHTML = "";
		document.getElementById("linkUrl").innerHTML = "";
*/
		
	}

		
	// ---------------------- new Posting will be pushed to database via php File ---------- //
	
	
	
	$scope.postIt = function(userPost, postId) {
	
		$scope.posting = userPost;
		
		
		if ($scope.getloc == true) {
			$scope.longt = $scope.location.coords.longitude;
			$scope.lat = $scope.location.coords.latitude;
		} else {
			$scope.longt = 0;
			$scope.lat = 0;
		}
				
		if ($scope.posting) {
			$scope.isSubmitting = true;
			$http.post("../../run_index.php", { 'userPost': $scope.posting, 'linkTitle': $scope.linkTitle(), 'linkDesc': $scope.linkDesc(), 'linkUrl': $scope.linkUrl(), 'linkImage': $scope.linkImage(), 'longt': $scope.longt, 'lat': $scope.lat, 'ort': $scope.ort(), 'linkVideo': $scope.linkVideo() })
				.success(function(result) {
					$scope.postSent = true;
					$scope.result = 'success'; // post button event handler, if success -> button stops "submitting"
					$scope.isSubmitting = null;
					$scope.place = {};
					$scope.thisLoc = "";
					$scope.locInput = false;
					
				})
		}
		
		$scope.userPost = "";
	
	}
	// ---------------------- new Posting END ---------- //
	
	
	
	
	$scope.deletePost = function(postId) {
		
		$http.post("../../run_index.php", { 'deletePostId': postId })
			.success(function(result) {
						
				for (var i=0; i < $scope.userPosts.length; i++) {
					
					if($scope.userPosts[i]['id'] == postId) {
						$scope.userPosts[i] = {};
					}
						
				}
						
			})
		
	}
	
	
	
	
	
	$scope.startAt = 10;
	
	// ---------------------- increasing limit of Get-Posts-Query ---------- //
	$scope.showMore = function(startAt) {
		
		$scope.startAt = startAt;
		$scope.limitation = 1;
		
		
		if ($scope.limitation) {
			$http.post("../../controller/morePosts.php", { 'limit': $scope.limitation, 'start': $scope.startAt })
				.success(function (result) {
				 

					$scope.userPosts.push(result[0]);
					if(result[0]['userLike'] == 1) {
						$scope[result[0]['id']+"checkLike"] = "success";
						$scope[result[0]['id']+"countLikes"] = result[0]['counter'];
					}
		
				})
		}
		
	
		
		$scope.startAt = $scope.startAt + 1;
		
	
	};
	// ---------------------- increasing limit of Get-Posts-Query END ---------- //
	
	
	
	// ---------------------- new Posting will be pushed to database via php File ---------- //
	$scope.userComment = {};
	
	$scope.commentIt = function(userComment, postId, image) {
		
		if(userComment) {
			$scope[postId+'commentSub'] = true;
		}
		
		postId;
		$scope.comment = userComment;
		if ($scope.comment) {
			$http.post("../../run_index.php", { 'userComment': $scope.comment, 'postId': postId, 'image': image })
				.success(function (result) {
					
				$scope[postId+'commentSub'] = false;
					
				});
		}
		
		$scope.userComment = {};
		
	
	}
	// ---------------------- new Posting END ---------- //
	
	
	
	// ----------------------like it ---------- //
	
	$scope.likeIt = function(postId) {
		
		if ($scope[postId+"checkLike"] == "success") {
			$scope[postId+"checkLike"] = "";
			$scope[postId['id']+"countLikes"]--;
		} else {
			$scope[postId+"checkLike"] = "success";
			$scope[postId['id']+"countLikes"]++;
		}
		
		
		$http.post("../../run_index.php", { 'like': postId })
			.success(function (response) {
			
				$scope.countLikes(postId);
				
			});
			
	}
	
	// ---------------------- like it---------- //

	
	
	
	
	$scope.getMyPics = function () {
		
		$http.get("../../controller/initMyPics.php")
			.success(function (response) {
				
		
				$scope.userPics = response;
			
				
			});
		
	}

	$scope.getMyPics();	

	
	
	// ---------------------- inizializing all likes ---------- //
	

	$scope.getLikeCheck = function(postId) {
   		if($scope[postId+"checkLike"] != undefined) {
	   		return $scope[postId+"checkLike"];
   		}
	}
	
	
	// ---------------------- inizializing likes END ---------- //


	$scope.countLikes = function(postId) {
		
		$http.post("../../controller/countLikes.php", { 'postId': postId })
			.success( function(response) {
		
				$scope[postId+"countLikes"] = response;
		
		});
		
	}
	
	$scope.getCountLikes = function(postId) {
		
		if($scope[postId+"countLikes"] != undefined) {
	   		return $scope[postId+"countLikes"];
   		}
		
	}
	
	
	
	
	// ---------------------- inizializing all posts to timeline ---------- //
	$scope.getAllPosts = function () {
		$scope.userPosts = [];
		$http.get("../../controller/initPosts.php")
			.success(function (response) {
				
				for (var i=0; i < response.length; i++) {
					
					if(response[i]['userLike'] == 1) {
						$scope[response[i]['id']+"checkLike"] = "success";
					}
					if (response[i]['counter'] > 0) {
						$scope[response[i]['id']+"countLikes"] = response[i]['counter'];
					}
					
					$scope.userPosts[i] = response[i];
					
					
				}
				
				
			});
			
			
	}

	$scope.getAllPosts();	
	
	
	$scope.TrustDangerousSnippet = function(snippet) {
		return $sce.trustAsHtml(snippet);
	}; 
	
	// ---------------------- inizializing all posts to timeline END ---------- //
	
	
	
	$scope.currentPostId = function (postId) {
		
		$scope.newCommentsInPost = postId;
		
	}
	
	
	
	// ---------------------- inizializing all comments to timeline ---------- //
	
	$scope.userComments = []; // verhindert doppelte einträge 

	$scope.pidArray2 = []; // verhindert doppelte einträge 

	$scope.getAllComments = function (postId) {

		
		if ($scope.pidArray2.indexOf(postId) < 0) {
			
			$scope.newCommentsInPost = postId;
			$scope[postId+'commentLoad'] = true;
			
			$http.post("../../controller/initComments.php", { 'postId': postId })
				.success(function (response) {
				
				
					if (response[0]['postId'] == postId) {
						
						$scope[postId] = [];
						
						for (var i = 0; i < response.length; i++) {
							
												
							if ($scope.cidArray.indexOf(response[i]['id']) < 0) {
								$scope[postId].splice(0,0, response[i]);
								$scope.cidArray.push(response[i]['id']);
								$scope.pidArray2.push(postId);
								$scope[postId+"countComments"] = response.length;
							}
						}
						
						
					}
	
					$scope[postId+'commentLoad'] = false;
		
				});
		}
	}
	
	// dynamische variable als postid ... z.B: $scope.2019 -> im view ist 2019 array und kann mit comments in getPostIdString iteriert werden
	$scope.getPostIdString = function(postId) {
   		return $scope[postId];
	}
	
	$scope.getCountComments = function(postId) {
   		return $scope[postId+"countComments"];
	}
	
	$scope.getCommentLoad = function(postId) {
		return $scope[postId+'commentLoad'];
	}
	
	$scope.getCommentSub = function(postId) {
		return $scope[postId+'commentSub'];
	}
	
	
	
/*
	$scope.getAllComments = function () {
		
		$http.get("../../controller/initComments.php")
			.success(function (response) {
		   
		   $scope.userComments = response;
		   
	
			});
		
	}
*/

		
	// $scope.getAllComments();
	
	// ---------------------- inizializing all comments to timeline END ---------- //
	
	
	$scope.getFriends = function () {
		
		$http.get("../../controller/initFriends.php")
			.success(function (response) {
		   
		   $scope.myfriends = response;
		   $scope.countFriends = response.length;
		   
	
			});
		
	}

	$scope.getFriends();
	
	// ---------------------- gets POSTS via Pusher.com Service and will update the scope in real time! ---------- //
	
	$scope.pushStop = false;
	$scope.pidArray = [];
	$scope.cidArray = [];
	
	var pusherUD = new Pusher('cdb410ae2bafe3272728');
		
		
	//subscribe to our notifications channel
	var userPosts = pusherUD.subscribe('userPosts');
	
	//do something with our new information
	userPosts.bind('new_userPost', function(posts){
	    // assign the notification's message to a <div></div>
		$scope.$apply(function() { // !!!!WICHTIG!!!!! Stellt sicher das Angular auch nach dem Laden die Variable weiterhin auf Veränderungen prüft!
			
			if ($scope.pushStop == false && posts == 1) { // handles case: when user start typing, pusher stops pushing // if flag = 1 loading data
				
				
				$http.post("../../controller/getNewPost.php", { 'timestamp': $scope.userPosts[0]['timestamp'] })
					.success(function (response) {
						
						
						
						for (var i=0; i < response.length; i++) {
							
							if ($scope.pidArray.indexOf(response[i]['id']) < 0) { // checks for duplicates - only possible if user send post simultaneously
								$scope.userPosts.splice(0,0, response[i]);
								$scope.pidArray.push(response[i]['id']);
							}
							
								
						}

						
				});

				
				
				
			}
			
		});
	});
	
	// ---------------------- gets POSTS via Pusher.com Service and will update the scope in real time! END ---------- //
	
	
	
	// ---------------------- gets COMMENTS via Pusher.com Service and will update the scope in real time! ---------- //
	
	
	
	var pusherUD = new Pusher('3c798fcb82652ae5d969');
		
		
	//subscribe to our notifications channel
	var userComment = pusherUD.subscribe('userComments');
	
	//do something with our new information
	userComment.bind('new_userComment', function(comments){
	    // assign the notification's message to a <div></div>
		$scope.$apply(function() { // !!!!WICHTIG!!!!! Stellt sicher das Angular auch nach dem Laden die Variable weiterhin auf Veränderungen prüft!
			
			if (comments == 1) { // handles case: when user start typing, pusher stops pushing // if flag = 1 loading data
				
				if($scope[$scope.newCommentsInPost] === undefined || $scope[$scope.newCommentsInPost] === null) {
					$scope.timestampComment = 0;
					
				} else {
					$scope.timestampComment = $scope[$scope.newCommentsInPost][0]['timestamp'];
				}
				
				$http.post("../../controller/getNewComment.php", { 'postId': $scope.newCommentsInPost, 'timestamp': $scope.timestampComment })
					.success(function (response) {
					
						for (var i=0; i < response.length; i++) {
		
							if ($scope[response[i]['postId']] === undefined) {
								$scope[response[i]['postId']] = [];
							}
							
							
							if ($scope.cidArray.indexOf(response[i]['id']) < 0) {
								$scope[response[i]['postId']].splice(0,0, response[i]);
								$scope.cidArray.push(response[i]['id']);
							}
							
							
						
						}
				});


			}
		});
	});
	
	// ---------------------- gets COMMENTS via Pusher.com Service and will update the scope in real time! END ---------- //
	
	
	
	// ------------------------------------------ FILE UPLOADER -------------------------------------
	
	
	$scope.uploadPic = function(file, userPost) {
		
		
		
		if ($scope.getloc == true) {
			$scope.longt = $scope.location.coords.longitude;
			$scope.lat = $scope.location.coords.latitude;
		} else {
			$scope.longt = 0;
			$scope.lat = 0;
		}
  	  
		if (file) {
	  	  	$scope.isSubmitting = true;
	  	  	$scope.userPost = "";
	
		  	  file.upload = Upload.upload({
		      url: '../../run_index.php',
		      method: 'POST',
		      file: file,
		      sendFieldsAs: 'form',
			  fields: {
		        	userPost: userPost,
		        	linkTitle: $scope.linkTitle(),
		        	linkDesc: $scope.linkDesc(),
		        	linkUrl: $scope.linkUrl(),
		        	linkImage: $scope.linkImage(),
		        	longt: $scope.longt, 
		        	lat: $scope.lat,
		        	ort: $scope.ort(),
		        	linkVideo: $scope.linkVideo(),
		    	}
		    	});
		
		    file.upload.then(function (response) {
		      $timeout(function () {
		        file.result = response.data;
		      });
		    }, function (response) {
		      if (response.status > 0)
		        $scope.errorMsg = response.status + ': ' + response.data;
		    }, function (evt) {
		      // Math.min is to fix IE which reports 200% sometimes
		      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
		      
		      setTimeout($scope.toTimeout, 3000);
		      
		      $scope.toTimeout = function() {
			    
			     if (file.progress == 100) {
			      
			      $scope.picFile = null;
			      $scope.result = 'success';
			      $scope.postSent = true;
			      $scope.isSubmitting = null;
			      $scope.place = {};
				  $scope.locInput = false;
				  $scope.thisLoc = "";

			 
		      	} 
		      
		      }

		    });
		   
			
		} else {
			
			
			$scope.postIt(userPost);
			
		}	
	
		
		
      }
    
    
 	
 	
 		$scope.friendReq = function(userTwoId, status) {
		
		if(userTwoId) {
			$http.post("../../run_index.php", { 'userTwoId': userTwoId, 'status0': status } );
	
		}
		
	
	}

	$scope.acceptReq = function(userTwoId, status) {
		
		if(userTwoId) {
			$http.post("../../run_index.php", { 'userTwoId': userTwoId, 'status1': status } );
 
		}
		
	
	}

	
	$scope.checkRel = function(userTwoId) {
		
		if(userTwoId) {
			$http.post("../../run_index.php", { 'userTwoId': userTwoId } )
				.success (function (result) {
					
					$scope.friend = result[0];
					
				})
		}
		
	
	}

	$scope.getEnemies = function () {
			
			$http.get("../../controller/initEnemies.php")
				.success(function (response) {
			   
					
					$scope.enemies = response;
			   
		
				});
			
		}
	
	$scope.getEnemies();
	
	
		$scope.getPending = function () {
			
			$http.get("../../controller/initPending.php")
				.success(function (response) {
			   
			   $scope.pendings = response;
			   
		
				});
			
		}
	
	$scope.getPending();
	
	
	
	
		// ---------------------- get Users Bio ---------- //
	$scope.getUserBio = function() {
	
			$http.get("../../controller/getUserBio.php")
				.success( function (response) {
					
					$scope.bio = response;
					
				});
		
		
	
	}
	
	$scope.getUserBio();
	
	// ---------------------- get Users Bio END ---------- //
	
	
	// ---------------------- get Users Bio ---------- //
	$scope.editBio = function() {
		
		if ($scope.userBio) {
			$http.post("../../run_index.php", { 'bio': $scope.userBio })
				.success( function(response) {
					
					$scope.bio = response;
					
				});
		}
		
	
	}
	// ---------------------- get Users Bio END ---------- //
	
	
	
	
	
	$scope.getAvatar = function () {
	
	$http.get("../../controller/getAvatar.php")
		.success(function (response) {
	   
			 $scope.userAvatar = response[0]['image'];
			 

		});
	
	}

		
	$scope.getAvatar();
	
	
	$scope.uploadAvatar = function(file) {
  	  
		if (file) {
	  	  	

	
		  	  file.upload = Upload.upload({
		      url: '../../run_index.php',
		      method: 'POST',
		      file: file,
		      sendFieldsAs: 'form',
			  fields: {
		        	avatar: 'avatar',
		    	}
		    	});
		
		    file.upload.then(function (response) {
		      $timeout(function () {
		        file.result = response.data;
		      });
		    }, function (response) {
		      if (response.status > 0)
		        $scope.errorMsg = response.status + ': ' + response.data;
		    }, function (evt) {
		      // Math.min is to fix IE which reports 200% sometimes
		      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
		      
		      setTimeout($scope.toTimeout, 3000);
		      
		      $scope.toTimeout = function() {
			    
			     if (file.progress == 100) {
			      
			      $scope.getAvatar();
		      	} 
		      
		      }

		    });
		   
			
			
				
		}
	
		
      }
      
      
      
      	
      	
      	$scope.getCover = function () {
	
		$http.get("../../controller/getCover.php")
			.success(function (response) {
		   
				 $scope.userCover = response[0]['image'];
				 
	
			});
		
		}
	
			
		$scope.getCover();

      
      
      
      	$scope.uploadCover = function(file) {
  	  
		if (file) {
	  	  	

	
		  	  file.upload = Upload.upload({
		      url: '../../run_index.php',
		      method: 'POST',
		      file: file,
		      sendFieldsAs: 'form',
			  fields: {
		        	cover: 'cover',
		    	}
		    	});
		
		    file.upload.then(function (response) {
		      $timeout(function () {
		        file.result = response.data;
		      });
		    }, function (response) {
		      if (response.status > 0)
		        $scope.errorMsg = response.status + ': ' + response.data;
		    }, function (evt) {
		      // Math.min is to fix IE which reports 200% sometimes
		      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
		      
		      setTimeout($scope.toTimeout, 3000);
		      
		      $scope.toTimeout = function() {
			    
			     if (file.progress == 100) {
			      
			      $scope.getCover();
			      
		      	} 
		      
		      }

		    });
		   
			
			
				
		}
	
		
      }
    

	

	
	

}]);



angular.module('myDirectives', []).
  directive('contenteditable', function () {
      return {
          restrict: 'A', // only activate on element attribute
          require: '?ngModel', // get a hold of NgModelController
          link: function (scope, element, attrs, ngModel) {
              if (!ngModel) return; // do nothing if no ng-model

              // Specify how UI should be updated
              ngModel.$render = function () {
                  element.html(ngModel.$viewValue || '');
              };

              // Listen for change events to enable binding
              element.on('blur keyup change', function () {
                  scope.$apply(readViewText);
              });

              // No need to initialize, AngularJS will initialize the text based on ng-model attribute

              // Write data to the model
              function readViewText() {
                  var html = element.html();
                  // When we clear the content editable the browser leaves a <br> behind
                  // If strip-br attribute is provided then we strip this out
                  if (attrs.stripBr && html == '<br>') {
                      html = '';
                  }
                  ngModel.$setViewValue(html);
              }
          }
      };
  });

