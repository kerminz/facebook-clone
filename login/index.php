<? include("run_index.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>
      
        Login &middot; 
      
    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="../assets/css/toolkit.css" rel="stylesheet">
    
    <link href="../assets/css/application.css" rel="stylesheet">
    
    <!-- Custom CSSs --->
    <link href="../assets/css/login.css" rel="stylesheet">
    
    <!-- Loading Angular Script from CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.js"></script>
	

  </head>


<body ng-app="loginApp">
  
  <div class="container-fluid container-fill-height" ng-controller="viewCtrl">
  <div class="container-content-middle">
    <form method="post" action="" role="form" name="loginForm" class="m-x-auto text-center app-login-form" ng-hide="<?php echo $showNameForm; ?>">

      <a href="../index.html" class="app-brand m-b-lg">
        <img src="../assets/img/brand.png" alt="brand">
      </a>
	  
	  <?php 
		  
		  if ($error) {
		            	
		  	echo '<div class="alert alert-danger">'.$error.'</div>';
		            	
	      }
		  
	  ?>


      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="E-Mail" />
      </div>

      <div class="form-group m-b-md">
        <input name="password" type="password" class="form-control" placeholder="Passwort" />
      </div>

      <div class="form-group m-b-lg">
        <input type="submit" name="submit" class="btn btn-primary" value="Anmelden" />
        <input type="submit" name="submit" class="btn btn-default" value="Registrieren" />
        <label id="checkbox">
        <input name="keep" type="checkbox"/> <span class="text-muted">Angemeldet bleiben?</span>
        </label>
      </div>

      <footer class="screen-login">
        <a href="#" class="text-muted">Passwort vergessen?</a>
      </footer>
    </form>
    
    <!-- conditional form for adding users detail information after registration process -->
    
	    
    <form method="post" action="" role="form" name="namenForm" class="m-x-auto text-center app-login-form" ng-show="<?php echo $showNameForm; ?>">

      <a href="../index.html" class="app-brand m-b-lg">
        <img src="../assets/img/brand.png" alt="brand">
      </a>
     
      <?php 
	  
	  echo $regSuccess; 
	  
	  
	  if ($error) {
	            	
	  	echo '<div class="alert alert-danger">'.$error.'</div>';
	            	
      }
	  
	  ?>
      
	
      <div class="form-group">
        <input type="text" name="name" class="form-control" placeholder="Benutzername">
      </div>

      <div class="form-group m-b-lg">
        <input type="submit" name="submit" class="btn btn-primary" value="Speichern" />
      </div>

    </form>


    
  </div>
</div>


    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/chart.js"></script>
    <script src="../assets/js/toolkit.js"></script>
    <script src="../assets/js/application.js"></script>
    <script src="../assets/js/loginApp.js"></script>
    

    <script>
      // execute/clear BS loaders for docs
      $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
          while(BS.loader.length){(BS.loader.pop())()}
        }
      })
    </script>

  </body>
</html>

