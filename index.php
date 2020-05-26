<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if(isset($_POST['submit']))
  {
    $uname = $_POST['username'];
    $upass = $_POST['password'];      
     if($uname == 'admin' && $upass == 'nikhar'){
        $_SESSION["USER"]=1;
        echo "<script>window.location.assign('./jsg_test1.php')</script>";   
     }
     elseif ($uname == 'doitc' && $upass == 'doitc@123') {
        $_SESSION["USER"]=2;
        echo "<script>window.location.assign('./jsg_test1.php')</script>";   
   }
   else {
        echo "<script>alert('Please enter correct username & password')</script>";
   }
}
     ?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
       <title>Nikhar - Admin Panel</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        
        <div class="login-container lightmode">
        
            <div class="login-box animated fadeInDown">
                <div>
                    <center>
                        <!--<img src="./doitc.jpeg" width=30% height=30%>-->
                        <img src="./doitc.jpg"> 
                    </center>
                </div>
                <div class="login-body">
                    <center>
                        <div class="login-title"><strong>Log In</strong> to your account</div>
                    </center>
                    <form action="" class="form-horizontal" method="post">
                    <div class="form-group" >
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="username" placeholder="Username" autofocus/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <!-- <a href="#" class="btn btn-link btn-block">Forgot your password?</a> -->
                        </div>
                        
                        <div class="col-md-7">
                            <button class="btn btn-info btn-block" name="submit">Log In</button>
                        </div>
                    </div>
                    </div><br>
                    <div class="login-subtitle">
                        <center>
                            <a href="https://www.linkedin.com/in/nikhar444">About</a> |
                            <a href="https://nikhar.codes/">Contact Us</a>
                        </center>
                    </div>
                    </form>
                <!-- </div> -->
                
            </div>
            
        </div>
        
    </body>
</html>






