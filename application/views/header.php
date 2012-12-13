<!DOCTYPE html>   
<html lang="en">   
<head>   
<base href = "<?php echo base_url(); ?>" />
<meta charset="utf-8">   
<title><?php echo $title ?></title>   
<meta name="description" content="<?php if(isset($description)) echo $description; ?>">  
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="icon" type="image/ico" href="http://localhost/my_world/img/favicon.ico"/>
</head>
<body>
<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrap">
<div class="container">   <!--start of the container-->
<div class="row">
<div class="span3">
<div id="header">

 <div id="logo">
  <a href="home.html"><img src="img/my-world2.png" align="left" alt="My World" /></a>
  </div>
  </div>
  <div class="span9 resizebanner">
    <div id="banner">      <!--start of banner-->
    <img src="img/Header.jpg" alt="My World" align="right" />
    </div>                   <!--end of banner-->

</div>
</div>   <!--end of header-->
</div>
<div class="row">  <!--start of row for nav-->
    <div class="span12">
      <div id="nav">
      <ul>
        <li><a href="msasani">Msasani Pre School</a></li>
        <li ><a href="upanga">Upanga Pre School</a></li>
        <li ><a href="community-center">Community Center</a></li>
        <li ><a href="blog">Blog</a></li>
        <li ><a href="news">News</a></li>
        <li><a href="about-us">About Us</a></li>
        <li><a href="contact-us">Contact Us</a></li>
    </ul>
      </div>
    </div>

</div> <!-- end of row for nav-->



