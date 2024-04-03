<?php
// require '/var/www/html/vendor/autoload.php';
session_start();
// $m = new MongoDB\Client("mongodb://localhost:27017");
$m = new MongoClient();
$db = $m->allianz;
$user = $db->user;
// if(isset($_SESSION['Uid'])){
// header('Location:index.php');
// }
// print_r($_POST);
if (isset($_POST['submit'])) {
     $username = $_POST['username'];
     $password = $_POST['password'];
     if ($username == '' || $password == '') {
          $error = "Username and Password should not be blank";
     } else {
          $data = array('Username' => $username, 'Password' => $password);
          $cursor = $user->count($data);
          if ($cursor > 0) {
               $_SESSION['Uid'] = $username;
               $maincursor = $user->find();
               foreach ($maincursor as $main) {
                    if ($username == $main['Username']) {
                         $_SESSION['Name'] = $main['Username'];
                    }
               }
               header("location:index.php");
          } else {
               $error = "Username or Password is wrong";
          }
     }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">
     <meta name="author" content="">
     <!--<link rel="icon" type="image/png" sizes="16x16" href="images/cap360-favicon.jpg">-->
     <title>Cap360 Decommission Analyzer</title>
     <!-- Bootstrap Core CSS -->
     <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

     <link href="css/login1.css" rel="stylesheet">

     <!--argon links-->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
     <meta name="author" content="Creative Tim">
     <title>CAP360 Decommission Analyzer</title>
     <!--old UI-->
     <link href="css/style.css" rel="stylesheet">
     <link href="css/bg.css" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
     <!--old UI close-->
     <!-- Favicon -->
     <link rel="icon" href="images/decomm.png" type="image/png">
     <!-- Fonts -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
     <!-- Icons -->
     <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
     <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
     <!-- Page plugins -->
     <!-- Argon CSS -->
     <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
     <!--argon links end-->
</head>

<body>
     <!-- Preloader -->
     <div class="preloader">
          <div class="cssload-speeding-wheel"></div>
     </div>
     <section id="wrapper" class="login-register">
          <div class="login-box">
               <div class="white-box">
                    <img src="images/cg.png" alt="logo" width="220px" height="100px" style="margin-left:-25px;margin-top:-26px" />

                    <!--<center>
			<img src="decomm4.PNG" alt="logo"/>
		</center>-->
                    <form class="form-horizontal form-material" id="loginform" action="<?php ?>" method="POST">

                         <?php if (isset($error)) {
                              echo "<div class='alert alert-danger'><strong>$error</strong></div>";
                         } ?>
                         <h3 class="box-title m-b-20" style="margin-left:650px">Sign In</h3>
                         <div class="form-group">
                              <div class="col-md-3" style="margin-left:650px">
                                   <input class="form-control" type="text" placeholder="Username" name="username">
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="col-md-3" style="margin-left:650px">
                                   <input class="form-control" type="password" placeholder="Password" name="password">
                              </div>
                         </div>
                         <div class="form-group hide">
                              <div class="col-md-3" style="margin-left:720px">
                                   <div class="checkbox checkbox-primary pull-left p-t-0">
                                        <input id="checkbox-signup" type="checkbox">
                                        <label for="checkbox-signup"> Remember me </label>
                                   </div>
                                   <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="col-xs-3" style="margin-left:750px">
                                   <button class="btn btn-info text-uppercase waves-effect waves-light" type="submit" name="submit">Log In</button>
                              </div>
                         </div>

                         <div class="form-group m-b-0 hide">
                              <div class="col-sm-12 text-center">
                                   <p>Don't have an account? <a href="register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </section>

</body>

</html>