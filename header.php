<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(empty($_SESSION["USER"]))
{
  echo "<script>window.location.assign('./')</script>";
}
 //$con = mysqli_connect("localhost","jodhdoit", "Doit@123", "covid"); 
  $con = mysqli_connect("localhost","root", "", "covid1");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Patient Data Analysis</TITLE>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</HEAD>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 400 15px Lato, sans-serif;
    line-height: 1.8;
    color: #818181;
  }
  h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 600;
    margin-bottom: 30px;
  }
  h4 {
    font-size: 19px;
    line-height: 1.375em;
    color: #fff;
    font-weight: 400;
    margin-bottom: 30px;
  }  
  .jumbotron {
    background-color: #9e174f;
    color: #fff;
    padding: 40px 25px;
    font-family: Montserrat, sans-serif;
  }
  .container-fluid {
    padding: 60px 50px;
  }
  .bg-grey {
    background-color: #f6f6f6;
  }
  .logo-small {
    color: #f4511e;
    font-size: 50px;
  }
  .logo {
    color: #f4511e;
    font-size: 200px;
  }
 .thumbnail {
    padding: 5px 0px 0px 0px;
    border: none;
    border-radius: 0;
  }
  .thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 0px;
    margin-top: : 5px;
  }
  .carousel-control.right, .carousel-control.left {
    background-image: none;
    color: #f4511e;
  }
  .carousel-indicators li {
    border-color: #f4511e;
  }
  .carousel-indicators li.active {
    background-color: #f4511e;
  }
  .item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .panel {
    border: 1px solid #f4511e; 
    border-radius:0 !important;
    transition: box-shadow 0.5s;
  }
  .panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
    border: 1px solid ##9e174f;
    background-color: #fff !important;
    color: ##9e174f;
  }
  .panel-heading {
    color: #fff !important;
    background-color: ##9e174f !important;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .panel-footer {
    background-color: white !important;
  }
  .panel-footer h3 {
    font-size: 32px;
  }
  .panel-footer h4 {
    color: #aaa;
    font-size: 14px;
  }
  .panel-footer .btn {
    margin: 15px 0;
    background-color: #000000;
    color: #fff;
  }
  .navbar {
    margin-bottom: 0;
    background-color: #000000;
    z-index: 9999;
    border: 0;
    font-size: 13px !important;
    line-height: 1.12857143 !important;
    letter-spacing: 2px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
    text-decoration: underline;
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: #f4511e !important;
    background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
  }
  footer .glyphicon {
    font-size: 20px;
    margin-bottom: 20px;
    color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
    animation-name: slide;
    -webkit-animation-name: slide;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
      width: 100%;
      margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
      font-size: 150px;
    }
  }


  .dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 9px;
  font-size: 12px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 8px 10px;
  text-decoration: none;
  display: block;
}
.item{
  width:200px;
  text-align:center;
  display:block;
  background-color: transparent;
  border: 1px solid transparent;
  margin-right: 10px;
  margin-bottom: 1px;
  float:left;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
  </style>
  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
  <!--      <div class="dropdown">
        <p class="dropbtn">Import Data</p>
  <div class="dropdown-content">
    <a href="import.php">Import Data(P)</a>
    <a href="importr.php">Import Data(R)</a>
    
  </div>
</div>-->
        <li><a href="jsg_test1.php">Home</a></li>
         <li><a href="export.php">ID wise</a></li>
        <li><a href="jsgn.php">LAT-LONG ID wise</a></li>
        <li><a href="jsgnew1.php">LAT-LONG Name/No. Wise</a></li>
      <!--   <li><a href="rxjsg.php">Relative Report</a></li>
         <li><a href="pstatus.php">Patient Status</a></li>-->
  <li><a href="logout.php">LOGOUT</a></li>
       
        <?php if($_SESSION["USER"]==1){ ?>
          <div class="dropdown">
        <p class="dropbtn">Import</p>
  <div class="dropdown-content">
    <a href="import.php">Import Data(P)</a>
  
    
  </div>
      <!--  <li><a href="import.php">Import Data(P)</a></li>
        <li><a href="importr.php">Import Data(R)</a></li>v DOIT&C, Jodhpur-->
       

      <?php } ?>
        
      </ul>
    </div>
  </div>
</nav>

  <div class="jumbotron text-center">
    
  <!--<img src="logo.png" class="thumbnail" align="left" height="115" width="180">-->

  <h1>CORONA +ve Tracking System</h1>
    

</div>