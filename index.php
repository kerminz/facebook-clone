<?php 
	include("run_index.php");
	include("controller/redirect.php"); // redirecter, if user is not logged in, redirect to login.php
	
	
	
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>
      
        Home &middot; 
      
    </title>
	
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <link href="assets/css/toolkit.css" rel="stylesheet">
    
    <link href="assets/css/application.css" rel="stylesheet">
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="ng-file-upload/ng-img-crop.css" rel="stylesheet">
    <link href="assets/css/nga.all.min.css" rel="stylesheet">
    <link href="ng-bs-animated-button/ng-bs-animated-button.css" rel="stylesheet">
    <!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="magnific-popup/magnific-popup.css">
	<link rel="stylesheet" href="liveUrl/liveurl.css">
	
	<!-- Plugin CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css" type="text/css">
	<link rel="stylesheet" href="assets/css/angular-motion.css" type="text/css">
	<link rel="stylesheet" href="assets/css/autocomplete.css" type="text/css">

    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/toolkit.js"></script>
    <script src="assets/js/application.js"></script>
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNIe8dwtPScVkxUdurDShxnLRmDfPfuWU&libraries=places"></script>


   
 
    <!-- Loading Angular Script from CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.js"></script>
	<!-- UI Bootstrap: Components written in AngularJS (Alerts, Buttons, Dropdoen, Datapicker, ...) https://angular-ui.github.io/bootstrap/  -->
	<script src="assets/js/ui-bootstrap-tpls-0.14.3.js"></script>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular-animate.js"></script>
	<script src="//cdn.jsdelivr.net/angularjs/1.4.5/angular-sanitize.min.js" data-semver="1.4.5"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-strap/2.3.7/angular-strap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-strap/2.3.7/angular-strap.tpl.min.js"></script>
	

	
	
	<script src="assets/js/popcorn-complete.js"></script>
	<script src="assets/js/popcorn.capture.js"></script>
	<script src="https://js.pusher.com/3.0/pusher.min.js"></script> <!-- Pusher.com Service -->
	<script src="assets/js/autocomplete.js"></script>
	

	<!-- Transfering Session ID / Cookie ID into js var -->	
	<script> 
	
		<?php
		
			if (isset($cookieId)) {
				
				$id = $cookieId;
				
			} else {
				
				$id = $sessionId;
				
			}
				
		?> 
		
		var js_var_sessionID = <?php echo $id ?>
	
	</script>
	

	
	
  </head>

<!-- TIMELINE CONTROLLER START (Angular)-->	

<body class="with-top-navbar" ng-app="indexApp" ng-controller="timelineCtrl" ng-cloak> 
  


<div class="growl" id="app-growl"></div>

<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img src="assets/img/brand-white.png" alt="brand">
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse-main">

        <ul class="nav navbar-nav hidden-xs">
          <li class="active">
            <a href="index.php">Home</a>
          </li>
      <!--    <li>
            <a href="profile/index.html">Profile</a>
          </li>
          <li>
            <a data-toggle="modal" href="#msgModal">Messages</a>
          </li>
          <li>
            <a href="docs/index.html">Docs</a>
          </li> -->
        </ul>

        <ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
          <li >
    <!--        <a class="app-notifications" href="notifications/index.html">
              <span class="icon icon-bell"></span>
            </a> -->
          </li>
          <li>

    		           
    		<!-- Inlined sibling dropdown - ACHTUNG: UL muss direkt nach "button" = bs-dropdown folgen!!  CUSTOM DROPDOWN:--> 
            <button class="btn btn-default navbar-btn navbar-btn-avitar" data-animation="am-flip-x" bs-dropdown aria-haspopup="true" placement="bottom" aria-expanded="false" data-toggle="popover">
              <img class="img-circle cover" ng-src="images/avatar/{{ userAvatar }}">
            </button>
            <ul class="dropdown-menu" role="menu">
	      <!--    <li><a href="#" data-action="growl">Gruuu</a></li> -->
	          <li><a href="controller/logout.php">Logout</a></li>
			</ul>
          </li>
        </ul>

        <form class="navbar-form navbar-right app-search" role="search">
          <div class="form-group">
            <input type="text" class="form-control" data-action="grow" placeholder="Search">
          </div>
        </form>

        <ul class="nav navbar-nav hidden-sm hidden-md hidden-lg">
          <li><a href="index.html">Home</a></li>
          <li><a href="profile/index.html">Profile</a></li>
          <li><a href="notifications/index.html">Notifications</a></li>
          <li><a data-toggle="modal" href="#msgModal">Messages</a></li>
          <li><a href="docs/index.html">Docs</a></li>
          <li><a href="#" data-action="growl">Growl</a></li>
          <li><a href="controller/logout.php">Logout</a></li>
        </ul>

        <ul class="nav navbar-nav hidden">
          <li><a href="#" data-action="growl">Gruuu</a></li>
          <li><a href="controller/logout.php">Logout</a></li>
        </ul>
      </div>
  </div>
</nav>

<!--
<div class="growl">
  <div class="alert alert-dark alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <strong>Well done!</strong> You successfully read this important alert message.
  </div>
</div>
-->

<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <button type="button" class="btn btn-sm btn-primary pull-right app-new-msg js-newMsg">New message</button>
        <h4 class="modal-title">Messages</h4>
      </div>

      <div class="modal-body p-a-0 js-modalBody">
        <div class="modal-body-scroller">
          <div class="media-list media-list-users list-group js-msgGroup">
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                <img class="img-circle media-object" src="assets/img/avatar-fat.jpg">
                </span>
                <div class="media-body">
                  <strong>Jacob Thornton</strong> and <strong>1 other</strong>
                  <div class="media-body-secondary">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam &hellip;
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-mdo.png">
                </span>
                <div class="media-body">
                  <strong>Mark Otto</strong> and <strong>3 others</strong>
                  <div class="media-body-secondary">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-dhg.png">
                </span>
                <div class="media-body">
                  <strong>Dave Gamache</strong>
                  <div class="media-body-secondary">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-fat.jpg">
                </span>
                <div class="media-body">
                  <strong>Jacob Thornton</strong> and <strong>1 other</strong>
                  <div class="media-body-secondary">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam &hellip;
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-mdo.png">
                </span>
                <div class="media-body">
                  <strong>Mark Otto</strong> and <strong>3 others</strong>
                  <div class="media-body-secondary">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-dhg.png">
                </span>
                <div class="media-body">
                  <strong>Dave Gamache</strong>
                  <div class="media-body-secondary">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-fat.jpg">
                </span>
                <div class="media-body">
                  <strong>Jacob Thornton</strong> and <strong>1 other</strong>
                  <div class="media-body-secondary">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam &hellip;
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-mdo.png">
                </span>
                <div class="media-body">
                  <strong>Mark Otto</strong> and <strong>3 others</strong>
                  <div class="media-body-secondary">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="list-group-item">
              <div class="media">
                <span class="media-left">
                  <img class="img-circle media-object" src="assets/img/avatar-dhg.png">
                </span>
                <div class="media-body">
                  <strong>Dave Gamache</strong>
                  <div class="media-body-secondary">
                    Brunch sustainable placeat vegan bicycle rights yeah…
                  </div>
                </div>
              </div>
            </a>
          </div>

          <div class="hide m-a js-conversation">
            <ul class="media-list media-list-conversation">
              <li class="media media-current-user m-b-md">
                <div class="media-body">
                  <div class="media-body-text">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Sed posuere consectetur est at lobortis.
                  </div>
                  <div class="media-footer">
                    <small class="text-muted">
                      <a href="#">Dave Gamache</a> at 4:20PM
                    </small>
                  </div>
                </div>
                <a class="media-right" href="#">
                  <img class="img-circle media-object" src="assets/img/avatar-dhg.png">
                </a>
              </li>

              <li class="media m-b-md">
                <a class="media-left" href="#">
                  <img class="img-circle media-object" src="assets/img/avatar-fat.jpg">
                </a>
                <div class="media-body">
                  <div class="media-body-text">
                   Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                  </div>
                  <div class="media-body-text">
                   Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                  </div>
                  <div class="media-body-text">
                   Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
                  </div>
                  <div class="media-footer">
                    <small class="text-muted">
                      <a href="#">Fat</a> at 4:28PM
                    </small>
                  </div>
                </div>
              </li>

              <li class="media m-b-md">
                <a class="media-left" href="#">
                  <img class="img-circle media-object" src="assets/img/avatar-mdo.png">
                </a>
                <div class="media-body">
                  <div class="media-body-text">
                   Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Etiam porta sem malesuada magna mollis euismod. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur.
                  </div>
                  <div class="media-body-text">
                   Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                  </div>
                  <div class="media-footer">
                    <small class="text-muted">
                      <a href="#">Mark Otto</a> at 4:20PM
                    </small>
                  </div>
                </div>
              </li>

              <li class="media media-current-user m-b-md">
                <div class="media-body">
                  <div class="media-body-text">
                    Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Sed posuere consectetur est at lobortis.
                  </div>
                  <div class="media-footer">
                    <small class="text-muted">
                      <a href="#">Dave Gamache</a> at 4:20PM
                    </small>
                  </div>
                </div>
                <a class="media-right" href="#">
                  <img class="img-circle media-object" src="assets/img/avatar-dhg.png">
                </a>
              </li>

              <li class="media m-b-md">
                <a class="media-left" href="#">
                  <img class="img-circle media-object" src="assets/img/avatar-fat.jpg">
                </a>
                <div class="media-body">
                  <div class="media-body-text">
                   Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                  </div>
                  <div class="media-body-text">
                   Vestibulum id ligula porta felis euismod semper. Aenean lacinia bibendum nulla sed consectetur. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam quis risus eget urna mollis ornare vel eu leo. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                  </div>
                  <div class="media-body-text">
                   Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget metus.
                  </div>
                  <div class="media-footer">
                    <small class="text-muted">
                      <a href="#">Fat</a> at 4:28PM
                    </small>
                  </div>
                </div>
              </li>

              <li class="media m-b">
                <a class="media-left" href="#">
                  <img class="img-circle media-object" src="assets/img/avatar-mdo.png">
                </a>
                <div class="media-body">
                  <div class="media-body-text">
                   Etiam porta sem malesuada magna mollis euismod. Donec id elit non mi porta gravida at eget metus. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Etiam porta sem malesuada magna mollis euismod. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean lacinia bibendum nulla sed consectetur.
                  </div>
                  <div class="media-body-text">
                   Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                  </div>
                  <div class="media-footer">
                    <small class="text-muted">
                      <a href="#">Mark Otto</a> at 4:20PM
                    </small>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Freundeliste &middot;  ({{ countFriends }})</h4>
      </div>

      <div class="modal-body p-a-0">
        <div class="modal-body-scroller">
          <ul class="media-list media-list-users list-group">
            <li class="list-group-item" ng-repeat="friends in myfriends track by $index">
              <div class="media">
                <a class="media-left" href="#">
                  <img class="img-circle cover" width="60px" height="60px" ngf-fix-orientation="true" ng-src="images/avatar/{{ friends.avatar }}">
                </a>
                <div class="media-body">
                  <button class="btn btn-default btn-sm pull-right">
                    <span class="glyphicon glyphicon-user"></span> Freunde
                  </button>
                  <strong>{{ friends.name }}</strong>
                  <p>{{ friends.bio }}</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container p-t-md ">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default panel-profile m-b-md" style="border-radius: 0px !important; border: none !important">
        <a href=""><div class="panel-heading" style="background-image: url(images/cover/{{ userCover }}); border-radius: 0px !important;" ngf-select="uploadCover(userCover)" ngf-fix-orientation="true" ng-model="userCover" name="cover" accept="image/*"></div></a>
        <div class="panel-body text-xs-center">
          <a href="profile/index.html" >
            <img ngf-select="uploadAvatar(picAvatar)" width="100px" height="100px" ngf-fix-orientation="true" ng-model="picAvatar" name="avatar" accept="image/*" ngf-max-size="10MB" class="panel-profile-img cover" ng-src="images/avatar/{{ userAvatar }}" >
          </a>


		  

          


          <ul class="panel-menu">
            <li class="panel-menu-item">
              <a href="#userModal" class="text-inherit" data-toggle="modal">
                <h5 class="m-y-0"><a class="text-inherit userName" href="profile/index.html"><div class="userName pull-right"><?php echo $userName;  ?></div></a></h5>
              </a>
            </li>

            <li class="panel-menu-item">
              <a href="#userModal" class="text-inherit" data-toggle="modal">
                Freunde
                <h5 class="m-y-0 text-xs-center">{{ countFriends }}</h5>
              </a>
            </li>
          </ul>
		  	<div ng-show="picAvatar.progress >= 0">  
				 <uib-progressbar ng-hide="picAvatar.result" max="100" animate="true" value="picAvatar.progress"><span style="color:white; white-space:nowrap;"></span></uib-progressbar>
			</div>
			<div ng-show="userCover.progress >= 0">  
				 <uib-progressbar ng-hide="userCover.result" max="100" animate="true" value="userCover.progress"><span style="color:white; white-space:nowrap;"></span></uib-progressbar>
			</div>
        </div>
      </div>
 

<!--
      <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
          <h5 class="m-t-0">Über mich <small>· <a href="#">bearbeiten</a></small></h5>
          <div class="pull-right">
	        <textarea  type="text" ng-blur="editBio(userBio); showArea=false" ng-show="showArea" ng-model="userBio">{{ bio }}</textarea>
	        <p class="m-b-md" ng-show="!showArea">{{ bio }} <small > <br /> <a href="" ng-click="showArea=true">bearbeiten</a></small></p>
          </div>
          <ul class="list-unstyled list-spaced">
            <li><span class="text-muted icon icon-calendar m-r"></span>Went to <a href="#">Oh, Canada</a>
            <li><span class="text-muted icon icon-users m-r"></span>Became friends with <a href="#">Obama</a>
            <li><span class="text-muted icon icon-github m-r"></span>Worked at <a href="#">Github</a>
            <li><span class="text-muted icon icon-home m-r"></span>Lives in <a href="#">San Francisco, CA</a>
            <li><span class="text-muted icon icon-location-pin m-r"></span>From <a href="#">Seattle, WA</a>
          </ul>
        </div>
      </div>
-->

       <div class="panel panel-default visible-md-block visible-lg-block" style="border-radius: 0px !important; border: none !important">
        <div class="panel-body thePosts" >
          <h5 class="m-t-0 text-muted"  style="font-weight: 400">Meine Bilder <small><a href="#"> </a></small></h5>
          <div ng-repeat="pic in userPics track by $index">
		  	<div class="col-xs-6 .col-sm-4" ng-if="pic.image && pic.imgWidth != 0">
		       
		         <a href="{{ imagePath }}{{pic.image}}" class="image"> <img class="cover w-full" ng-src="{{ imagePath }}{{pic.image}}" style=" height: 100px; max-width: auto; margin-bottom: 20px"></a>
	
	        </div>
          </div>
        </div>
      </div>
    </div>
	<!--------------------------------------------- TIMELINE -------------------------------------------------------------------------------------- -->
   
    <div class="col-md-6 thePosts">
        
      <ul class="list-group media-list media-list-stream" style="margin-top: 0px !important;">
		 
	  	<li class="media list-group-item p-a-0 shadow-box-controll "  >
	  	<div ng-show="picFile.progress >= 0">  
			 <uib-progressbar ng-hide="picFile.result" max="100" animate="true" value="picFile.progress"><span style="color:white; white-space:nowrap;"></span></uib-progressbar>
		</div>
		  		<button type="file" class="btn btn-media-outline col-xs-6" ngf-select ngf-change="onChange($files)" ngf-fix-orientation="true" ng-model="picFile" name="file" accept="video/*, image/*" ngf-max-size="1000MB"><strong><span class="icon icon-camera" /></span> <small>Medien</small></strong></button>
		  		<button class="btn btn-media-outline col-xs-6" href="#locationModal" data-toggle="modal" ng-click="getLocation()"><strong><span class="icon icon-location-pin"></span> <small>Orte</small></strong></button>
		</li>
		
		
		<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModal" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="btn btn-default-outline" data-dismiss="modal" aria-hidden="true">Abbrechen</button>
		        <button type="button" class="btn btn-post pull-right" data-dismiss="modal" ng-click="clearLocation()" ng-disabled="place < 1" aria-hidden="true">Hinzufügen</button>
		      </div>
		
		      <div class="modal-body p-a-0 m-a-0">
		        <div class="modal-body-scroller">
			        <br>
			        	<table>
				        	<tr>
					        	<td ><span class="icon icon-magnifying-glass text-muted p-l"></span></td>
					        	<td class="w-full"><input class="form-control locInput w-full" placeholder="Wo bist du?" ng-show="locInput == true" type="text" g-places-autocomplete ng-model="place" force-selection="true"  details="details"/></td>
					        	<td class="p-r"><button ng-click="clearPlace()" class="close">&times;</button></td>
				        	</tr>
			        	</table>
			        <br>
<!-- 				<div class="location col-xs-6" ng-if="location.coords.longitude" ><span class="icon icon-location-pin pull-left"></span><reverse-geocode lat="{{location.coords.latitude}}" lng="{{location.coords.longitude}}" id="ort"></reverse-geocode></div> -->
				
					
				
		          <ul class="media-list media-list-users list-group ">
			          	<li class="list-group-item p-t-0"><small>Orte in deiner Nähe: </small></li>
			            <li class="list-group-item p-t-0 p-b-0 locatonList" style="padding-bottom: 7px !important" ng-repeat="myLocation in locationsNearMe track by $index" >
			             	<a id="locLink"  href="" data-dismiss="modal" ng-click="clearPlace(); setLocName(myLocation.name)">
				              <div class="media">
				                <div class="media-left">
				                  <img class="img-circle cover" width="20px" height="20px" ngf-fix-orientation="true" ng-src="{{ myLocation.icon }}">
				                </div>
				                <div class="media-body">
<!--
				                  <div class="btn btn-default btn-sm pull-right">
				                    <span class="glyphicon glyphicon-user"></span> 800m
				                  </div>
-->							
				                  <strong>{{ myLocation.name }}</strong><br>
				                  <small>{{ distanceOfPlace(myLocation.id) }} m</small>
				                  
				                </div>
				              </div>
				             </a>
			            </li>
		            
		          </ul>

		        </div>
		      </div>
		    </div>
		  </div>
		</div>



        <li class="media list-group-item shadow-box" >
          <div class="input-group w-full" style="display: block !important">
            <div class="liveurl-loader pull-right"></div>
            <div class="pull-right" ng-show="isSubmitting"><img src="liveUrl/url-loader.gif" /></div>
            
            <form ng-submit="postIt(userPost)">
	            
            	<textarea id="postArea" onkeyup="textAreaAdjust(this)" style="overflow:hidden; font-weight: 500" id="newpost" ng-style="textStyle" type="text" ng-trim="true" maxlength="220" class="form-control pull-left" 
            	placeholder="Was gibt's Neues?" value="" ng-model="userPost" ng-click="postRow=true" ng-focus="pushStop = true; postSent=false" ng-blur="pushStop = false;"> </textarea>
            
				
            
			 <li class="media list-group-item p-l-0 p-t-0" ng-hide="picFile.result || picFile == null" style="border: none !important;">
		 	 	<div >
	            	<img ngf-thumbnail="picFile" class="thumb" ng-click="picFile = null" ng-hide="picFile.result" >
					<div ng-show="thisIsImage === false"><span class="icon icon-video-camera" style="font-size: large"  </span><span style="font-size: smaller"> &nbsp;Video hinzugefügt.</span></div>
				</div>
			 </li>
            </form>
            
            
           

           
        	<div class="liveurl w-full" style="min-width: auto !important" >
	            <div class="close" ng-click="clearLink()" title="Entfernen"></div>
	            <div class="inner">
	                <div class="image" id="linkImage"></div>
	                <div class="details">
	                    <div class="info">
	                        <div class="title" id="linkTitle"></div>
	                        <div class="description" id="linkDesc"></div> 
	                        <div class="url" id="linkUrl"></div>
	                    </div>
	
	                    <div class="thumbnail" style="background-color: transparent !important; border: none !important;">
	                        <div class="pictures">
	                            <div class="controls">
	                                <div class="prev button inactive"></div>
	                                <div class="next button inactive"></div>
	                                <div class="count">
	                                    <span class="current">0</span><span> von </span><span class="max">0</span>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="video" id="linkVideo"></div>
	                </div>
					
	            </div>
	        </div>
			<div class="row m-b-0 p-b-0">
			 	<div class="pull-left" style="font-size: small; padding-left: 13px !important;" ng-show="place.name || thisLoc "><strong>- hier: </strong><a href="">{{ thisLoc }}</a><a href="{{ place.url }}" target="_blank">{{ place.name }}</a> </div>
<!-- 			 	<div><pre>{{ place | json }}</pre></div> -->

				<div class="col-xs-6 pull-right" ng-show="postRow; postSent == false" >
			
					<div class="pull-right "><div class="text-muted" style="font-size: small">{{220 - userPost.length}}<div></div>

				</div>
			
			</div>
			
          </div>
          <!-- <span class="progress" ng-show="picFile.progress >= 0"><div style="width:{{picFile.progress}}%" ng-bind="picFile.progress + '%'"></div></span> -->
        
		  
        </li>
        
        <li class="media list-group-item p-a-0 shadow-box-post" >
		  		<div class="row">

		  			<div class="col-xs-6 pull-right " style="margin: 6px !important;"><button ng-disabled="isSubmitting" class="btn btn-post btn-sm w-md pull-right postBtn"  ng-click="uploadPic(picFile, userPost); clearLink();">Posten</button></div>
		  		</div>
		</li>
        


        
   
      <!-- <div ng-show="picFile.result">Upload Successful</div> -->
   
	 


        <!-- <button ng-click="getAllPosts(); getAllComments()">Refresh</button> -->
        
        <div class="posts" ng-class="{ 'nga-default' : $first, 'nga-stragger' : $first, 'nga-fade' : $first}" ng-repeat="post in userPosts track by $index" ng-if="post.post || post.image" >
			
			<li class="media list-group-item p-a post-box">
	          <a class="media-left" href="#" >
	            <img 
	              class="media-object img-circle cover" style="height: 50px !important; width: 50px !important;"
	              ng-src="images/avatar/{{ post.avatar }}">
	          </a>
	          <div class="media-body">
	            <div class="media-body-text">
	              <div class="media-heading w-full">
	
				  	<table>
					  	<tr>

						  	<td class="w-full">
							  	<div  class="pull-left"><a href="" style="font-weight: 400">{{ post.name }}&nbsp;</a><small class="text-muted" ng-if="post.ort">war hier: <span class="icon icon-location-pin"></span><a href="" style="font-weight: 400">{{ post.ort }}</a></small></div>
							  	<br>
							  	<div class="text-muted"  ><small class="pull-left">{{ post.timestamp * 1000 | timeago }}  &middot;  </small>  </div>
						  	</td>
						  		
						  		
						  	<td valign="top">
							  	<!-- Inlined sibling dropdown - ACHTUNG: UL muss direkt nach "button" = bs-dropdown folgen!! --> 
				                <div class="pull-right" data-animation="am-flip-x" bs-dropdown aria-haspopup="true" placement="left-bottom" aria-expanded="false"><a href=""><span  class="icon icon-chevron-thin-down"></span></a></div>
				                <ul class="dropdown-menu" role="menu">
								  <li class="editHover"><a href=""  ng-click="deletePost(post.id)" ><i class="icon icon-cross"></i>&nbsp;Löschen</a></li>
								  <li class="editHover"><a href=""  ><i class="icon icon-edit"></i>&nbsp;Bearbeiten</a></li>
								</ul>
								
						  	</td>
					  	</tr>
				  	</table>
		            
					
					
						

	                
	                
	                  
	                  	<!-- UI Bootstrap Angular: Popover Settings -->	
<!--
						<script type="text/ng-template" id="locationpopover.html">
						    <div><img src="http://maps.googleapis.com/maps/api/staticmap?center={{ post.lat }},{{ post.longt }}&zoom=13&size=250x150&sensor=false&markers=color:orange|label:W|{{ post.lat }},{{ post.longt }}">   
						    </div>
						</script>
-->
	                  
<!-- 	                  <div class="text-muted"  ><small class="pull-left">{{ post.timestamp * 1000 | timeago }}  &middot;  </small>  <small ng-if="post.ort"><div><div  uib-popover-template="'locationpopover.html'" popover-trigger="mouseenter" popover-placement="bottom" popover-title="Standort"><span class="icon icon-location-pin pull-left"></span>{{ post.ort }}</div></div></small></div> -->
	                  
	                  
	                
	              </div>
	              

				  
	        	 <div> 
	        		        
	         </div>			
	            
	            	
			</li>
			
			
			<div class="post-footer p-a-0" >
				
				<div class="postText p-l p-r ">
	                <div class="dont-break-out">{{ post.post }}</div> 
	            </div>
				
      
				<div class="w-full" ng-if="post.image && post.imgWidth != 0">
		       
		         <a href="{{ imagePath }}{{post.image}}" class="image"> <img class="cover w-full" ng-src="{{ imagePath }}{{post.image}}" style=" max-height: 350px; max-width: auto"></a>
	
	        	</div>
	        	
	        	<div class="w-full p-b-0" ng-if="post.image && post.imgWidth == 0" >

		          <video class="w-full" style="max-width: 100%" controls poster="{{videoThumbPath+post.videoThumb}}" preload="none">
				  	<source src="{{videoPath+post.image || trustUrl}}" type="video/mp4" style=" max-height: 478px; max-width: auto">
				  	Your browser does not support HTML5 video.
				  </video>
	
	        	</div>
	        	
	        	
	        	<div class="link-box p-a-0 m-a-o" ng-if="post.linkUrl" >
		           	<a href="{{ post.linkUrl }}" target="_blank"><img  class="w-full cover" ng-if="post.linkImage" ng-hide="post.linkVideo" ng-src="{{ post.linkImage }}" style="max-width: auto !important; max-height: 350px !important"></a>
		           	<div class="videoWrapper"  ng-if="post.linkVideo" ng-bind-html="TrustDangerousSnippet(post.linkVideo)"></div>
		           	<div class="p-a ">
			           	<h5>{{ post.linkTitle }}</h5>
			            <p><small>{{ post.linkDesc }}</small></p>
			            <p><a href="{{ post.linkUrl }}" target="_blank" class="dont-break-out"> {{ post.linkUrl }} </a></p>
		           	</div>
		           	
	            </div>
	            


				 
					
			 	<li class="shadow-box-postcontroll " ng-if="getCountLikes(post.id) > 0" style="border-top: none !important; padding-top: 5px !important; padding-bottom: 5px !important">
			 		<div class="row">
			 			<div class="col-xs-6 col-md-4 p-l-md" ><span class=" icon icon-heart"  ng-show="getCountLikes(post.id) > 0" style="color: red;"></span> {{ getCountLikes(post.id) }}</div>
			 			<div class="col-xs-6 col-md-4 pull-right p-r-md" style="font-size: small !important"><p class="pull-right" ng-if="getCountComments(post.id)">{{ getCountComments(post.id) }} Kommentar(e)</p></div>
			 		</div>
			 	</li>
				
				<li class="shadow-box-postcontroll">
			 						 		
			 		<table class="">
				 		<tr>
					 		<td ><button class="btn btn-sm btn-default-outline"><div ng-click="commentBox[$index] = showComments[$index]; likeIt(post.id); liked(post.id)" ><div class="pull-left " ng-class="{ 'likeCheck': getLikeCheck(post.id) == 'success' }" ><span class=" icon icon-heart">
						 		</span> Like</div></div></button</td>
					 		<td><button class="btn btn-sm btn-default-outline"><div ng-click="$parent.$parent.pushStop = true; switcher($index); commentBox[$index] = showComments[$index]; getAllComments(post.id) "><span class="icon icon-chat">
						 		</span><span ng-class="{ 'icon icon-chevron-small-right' : commentBox[$index] == false || commentBox[$index] == null, 'icon icon-chevron-small-down' : commentBox[$index] == true }" ></span> Kommentieren</div></div></button></td>
					<!--	 	<td><button class="btn btn-sm btn-default-outline"><div><span class="icon icon-loop">
						 		</span> Repost</div></div></button></td> -->
				 		</tr>
			 		</table>
			 		
			 	</li>
				 
				 
			</div>

			
			<div class="comment-box" ng-show="commentBox[$index] == true" ng-model="commentBox[$index]">
				<div style="padding: 10px;">
					<ul class="media-list m-b">
			        	<li>
			        	
							<div class="input-group">
								<div class="input-group-btn"><img class="media-object img-circle img-thumbnail cover" ng-src="images/avatar/{{ userAvatar }}" style="height: 35px !important; width: 35px !important;"></div>
				            	<form style="padding-right: 5px;"> <!-- ng-submit="commentIt(userComment[post.id], post.id)" -->
				            		<input id="ucInput" type="text" class="form-control" ng-focus="focused = true; currentPostId(post.id)" ng-blur="focused = false" placeholder="Kommentiere diesen Beitrag..." ng-model="userComment[post.id]" style="height: 30px !important; ">
								</form>
								<div class="input-group-btn " >

									<button ng-disabled="(userComment[post.id].length < 1 || !userComment[post.id])" class="btn btn btn-commentAction-outline pull-right" ng-click="commentIt(userComment[post.id], post.id); focused=true; currentPostId(post.id)">posten</button> 
								</div> 
							</div>
						</li>
			        </ul>
			        
			        <div class="w-full" align="center" ng-show="getCommentLoad(post.id) || getCommentSub(post.id)" ><img src="liveUrl/url-loader.gif" /></div>
					
		        	<ul class="media-list m-b" ng-class="{ 'myComment' : comment.userId == sessionId, 'nga-default' : $first, 'nga-stragger' : $first, 'nga-fade' : $first}" ng-repeat="comment in getPostIdString(post.id) | orderBy:'-timestamp' track by comment.id"  >
		              <li class="media">
		                <a class="media-left" href="#">
		                  <img
		                    class="media-object img-circle img-thumbnail cover" style="height: 35px !important; width: 35px !important;"
		                    ng-src="images/avatar/{{ comment.avatar }}">
		                </a>
		                <div class="media-body">
			              <small class="pull-right text-muted">{{ (comment.timestamp * 1000) | timeago }}</small>
		                  <div class="pull-left" style="margin-right: 5px !important"><strong><a href="" class="commentName">{{ comment.name }}</a></strong></div>
		                  <div style="font-weight: 400; color: black"> {{ comment.comment }}</div>
		                </div>
		              </li>
					</ul>
				</div>
			</div>
					

			
        </div>
        
        
		
<!--
        <li class="media list-group-item p-a">
          <a class="media-left" href="#">
            <img
              class="media-object img-circle"
              src="assets/img/avatar-dhg.png">
          </a>
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted">4 min</small>
              <h5>Dave Gamache</h5>
            </div>

            <p>
              Some Text
            </p>

            <div class="media-body-inline-grid" data-grid="images">
              <div style="display: none">
                <img data-action="zoom" data-width="1050" data-height="700" src="assets/img/unsplash_1.jpg">
              </div>

              <div style="display: none">
                <img data-action="zoom" data-width="640" data-height="640" src="assets/img/instagram_1.jpg">
              </div>

              <div style="display: none">
                <img data-action="zoom" data-width="640" data-height="640" src="assets/img/instagram_13.jpg">
              </div>

              <div style="display: none">
                <img data-action="zoom" data-width="1048" data-height="700" src="assets/img/unsplash_2.jpg">
              </div>
            </div>

            <ul class="media-list m-b">
              <li class="media">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="assets/img/avatar-fat.jpg">
                </a>
                <div class="media-body">
                  <strong>Jacon Thornton: </strong>
                  Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                </div>
              </li>
              <li class="media">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="assets/img/avatar-mdo.png">
                </a>
                <div class="media-body">
                  <strong>Mark Otto: </strong>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                </div>
              </li>
            </ul>
          </div>
        </li>

        <li class="media list-group-item p-a">
          <a class="media-left" href="#">
            <img
              class="media-object img-circle"
              src="assets/img/avatar-fat.jpg">
          </a>
          <div class="media-body">
            <div class="media-body-text">
              <div class="media-heading">
                <small class="pull-right text-muted">12 min</small>
                <h5>Jacob Thornton</h5>
              </div>
              <p>
                Donec id elit non mi porta gravida at eget metus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
              </p>
            </div>
          </div>
        </li>

        <li class="media list-group-item p-a">
          <a class="media-left" href="#">
            <img
              class="media-object img-circle"
              src="assets/img/avatar-mdo.png">
          </a>
          <div class="media-body">
            <div class="media-heading">
              <small class="pull-right text-muted">34 min</small>
              <h5>Mark Otto</h5>
            </div>

            <p>
              Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
            </p>

            <div class="media-body-inline-grid" data-grid="images">
              <img style="display: none" data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_3.jpg">
            </div>

            <ul class="media-list">
              <li class="media">
                <a class="media-left" href="#">
                  <img
                    class="media-object img-circle"
                    src="assets/img/avatar-dhg.png">
                </a>
                <div class="media-body">
                  <strong>Dave Gamache: </strong>
                  Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                </div>
              </li>
            </ul>
          </div>
        </li>
-->
      </ul>
      <div infinite-scroll="showMore(startAt)" infinite-scroll-distance="2" ></div>
    </div >
    
    
    
    <!--------------------------------------------- TIMELINE END -------------------------------------------------------------------------------------- -->
    <div class="col-md-3 " >
<!--      <div class="alert alert-warning alert-dismissible hidden-xs" role="alert" style="border-radius: 0px !important; border: none !important">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <a class="alert-link" href="profile/index.html">Visit your profile!</a> Check your self, you aren't looking too good.
      </div>   -->

      <div class="panel panel-default m-b-md" style="border-radius: 0px !important; border: none !important">
        <div class="panel-body">
	    <p class="m-t-0 text-muted" style="font-weight: 400">Freundschaftsanfragen</p>
           <ul class="media-list media-list-stream">
          <li class="media m-b" ng-repeat="pending in pendings track by $index" ng-if="pending.name">
            <a class="media-left" href="#">
              <img
                class="media-object img-circle cover" style="height: 50px !important; width: 50px !important;"
                ng-src="images/avatar/{{ pending.avatar }}">
            </a>
            <div class="media-body">
              <strong><a href="#" style="color: #5097d1 !important">{{ pending.name }}</a></strong>
              <div class="media-body-actions">
                <button class="btn btn-post btn-xs"  ng-click="acceptReq(pending.actionUserId, 1); acceptButton=null" ng-init="acceptButton=true" ng-show="acceptButton" ng-model="acceptButton"><span class="icon icon-add-user"></span> Akzeptieren</button>
                <button class="btn btn-post disabled btn-xs" ng-show="!acceptButton"><span class="icon icon-check"></span> Befreundet</button>
              </div>
            </div>
          </li>
          
        </ul>

        </div>
      </div>

      <div class="panel panel-default m-b-md " style="border-radius: 0px !important; border: none !important"> <!-- hidden-xs class makes panel hidden in smartphone view -->
        <div class="panel-body">
        <p class="m-t-0 text-muted" style="font-weight: 400">Neue Freunde</p>
        <ul class="media-list media-list-stream">
          <li class="media m-b" ng-repeat="enemie in enemies track by $index" ng-if="enemie.name" >
            <a class="media-left" href="#" ng-init="checkRel(enemie.id)">
              <img
                class="media-object img-circle cover" style="height: 50px !important; width: 50px !important;"
                ng-src="images/avatar/{{ enemie.avatar }}">
            </a>
            <div class="media-body">
	         <!--    {{ friend.status }} -->
              <strong><a href="#" style="color: #5097d1 !important">{{ enemie.name }}</a></strong> 
              <div class="media-body-actions">
                <button class="btn btn-post btn-xs" ng-init="addButton=true" ng-show="addButton" ng-model="addButton" ng-click="friendReq(enemie.id, 0); addButton=null">
                  <span class="icon icon-add-user"></span> Freund hinzufügen</button>
                <button class="btn btn-post disabled btn-xs" ng-show="!addButton">
                  <span class="icon icon-add-user"></span> Angefragt</button>  
              </div>
            </div>
          </li>
          
        </ul>
        </div>
        <div class="panel-footer">
          Finde neue Freunde.
        </div>
      </div>

      <div class="panel panel-default panel-link-list" style="border-radius: 0px !important; border: none !important">
        <div class="panel-body">
          © 2017 FBClone.Beta 0.5
		  <br>
          <a href="#">Über</a>
          <a href="#">Impressum</a>
          <a href="#">Datenschutz</a>
          <a href="#">Kontakt</a>

        </div>
      </div>
    </div>
    
  </div>
</div>



	<script src="ng-file-upload/ng-file-upload-shim.min.js"></script>
	<script src="ng-file-upload/ng-file-upload.min.js"></script>
    <script src="assets/js/indexApp.js"></script>
    <script src="assets/js/ng-infinite-scroll.js"></script>
    <script src="ng-file-upload/ng-img-crop.js"></script>

    <!-- Magnific Popup core JS file -->
	<script src="magnific-popup/jquery.magnific-popup.js"></script>
	<script src="liveUrl/jquery.liveurl.js"></script>
	<script src="assets/js/ngGeolocation.js"></script>
	<script src="assets/js/angular-reverse-geocode.js"></script>

    <script>
      // execute/clear BS loaders for docs
      $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
          while(BS.loader.length){(BS.loader.pop())()}
        }
      })
      
      
      
      $('#bouncy1').click(function () {
          $(this).effect("bounce", { times:5 }, 300);
		});
          
     </script>
    
     
     <script>
	  // ACHTUNG: Zugriff über Angular in indexApp.js !!
	  
	  	$('.image').magnificPopup({
			type: 'image',
		});
		
		
		
		// Textarea Expander
		
		function textAreaAdjust(o) {
		    o.style.height = "1px";
		    o.style.height = (25+o.scrollHeight)+"px";
		}
		
		
		function maxLength(el) {	
			if (!('maxLength' in el)) {
				var max = el.attributes.maxLength.value;
				el.onkeypress = function () {
					if (this.value.length >= max) return false;
				};
			}
		}
		
		maxLength(document.getElementById("postArea"));

		 
	     
	 </script>
    <!-- UI Bootstrap: Components written in AngularJS (Alerts, Buttons, Dropdoen, Datapicker, ...) https://angular-ui.github.io/bootstrap/  -->
	<script src="assets/js/ui-bootstrap-tpls-0.14.3.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/jquery.fittext.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="liveUrl/liveUrlCustom.js"></script>
	<script src="ng-bs-animated-button/ng-bs-animated-button.js"></script>


	
  </body>
  
<!-- TIMELINE CONTROLLER END (Angular)-->	

</html>

