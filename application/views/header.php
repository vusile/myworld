<!DOCTYPE html>   
<html lang="en">   
<head>   
<base href = "<?php echo base_url(); ?>" />
<meta charset="utf-8">   
<title><?php echo $title ?></title>   
<meta name="description" content="<?php if(isset($description)) echo $description; ?>">  
<link rel="stylesheet" type="text/css" href="css/custom.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="icon" type="image/ico" href="img/favicon.ico"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script src="js/jquery.cycle.all.js" type="text/javascript"></script>

   
  <script>
  $('#banner1').cycle();
  $('#banner2').cycle();
  $('#banner3').cycle();
  $('#banner4').cycle();
  </script>
</head>
<body>

<div id="wrap">
<div class="container">   <!--start of the container-->
<div id="header">

 <div id="logo">  <!-- start of logo-->
  <a href="<?php echo base_url(); ?>"><img src="img/<?php echo $logo ?>" align="left" alt="<?php echo $tag_line ?>" /></a>
  <div id="slogan">
  <p align="center"><?php echo $tag_line ?></p>
  </div>
  </div>   <!--end of  logo-->
    <div id="banner">      <!--start of banner-->
   
    <div class="row">
	<div id="banner1">
		<?php echo $left ?>
    </div>
	<div id="banner2">
          
		<?php echo $centre_top ?>

      
    </div> 
	<div id="banner3">
          
		<?php echo $centre_bottom ?>

      
    </div>    	
	<div id="banner4">
          
		<?php echo $right?>
      
    </div>       
</div>   <!--end of row-->
</div>   <!--end of banner-->
</div>   <!--end of header-->

<div class="row">  <!--start of row for nav-->
    <div class="span12">
      <div id="nav">
      <ul>
         <li><a href="<?php base_url(); ?>">Home</a></li>
         <li ><a href="about-us">About Us</a></li>
        <li><a href="msasani-preschool">Msasani Preschool</a></li>
        <li ><a href="upanga-preschool">Upanga Preschool</a></li>
        <li ><a href="community-center">Community Center</a></li>
        <li ><a href="training-center">Training Center</a></li>
        <li><a href="blog">Blog</a></li>
        <li ><a href="news">News</a></li>
        <li><a href="contact-us">Contact Us</a></li
    ></ul>
      </div>
    </div>

</div> <!-- end of row for nav-->
