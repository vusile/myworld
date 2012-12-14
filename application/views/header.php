<!DOCTYPE html>   
<html lang="en">   
<head>   
<base href = "<?php echo base_url(); ?>" />
<meta charset="utf-8">   
<title><?php echo $title ?></title>   
<meta name="description" content="<?php if(isset($description)) echo $description; ?>">  
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="icon" type="image/ico" href="img/favicon.ico"/>
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
<div id="header">

 <div id="logo">  <!-- start of logo-->
  <a href="home.html"><img src="img/my-world.png" align="left" alt="My World" /></a>
  <div id="slogan">
  <p align="center">Creating Leaders <br> Since 1994</p>
  </div>
  </div>   <!--end of  logo-->
    <div id="banner">      <!--start of banner-->
    <!--<img src="img/Header.jpg" alt="My World" align="right" />-->
    <div class="row">
          <div id="banner1">
          <div id="myCarousel01" class="carousel slide"><!-- class of slide for animation -->
  <div class="carousel-inner">  <!--start of c- inner-->
  
 <!-- pic no 1 goes here-->
    <div class="item active"><!-- class of active since it's the first item -->
      <img src="http://placehold.it/141x278"  alt="" />
      
    </div>        <!--   end of item-->
   <!-- end of pic1-->
   
   <!-- pic no 2 goes here-->
    <div class="item">
      <img src="http://placehold.it/141x278" alt="" />
      
    </div>
    <!-- end pic no 2 goes here-->
    
     <!-- pic no 3 goes here-->
    <div class="item">
      <img src="http://placehold.it/141x278" alt="" />
      
    </div>
      <!-- end pic no 3 goes here-->
     
      <!-- pic no 4 goes here--> 
    <div class="item">
      <img src="http://placehold.it/141x278"  alt="" />
    </div>
     <!-- end pic no 4 goes here-->
    
  </div><!-- /.carousel-inner -->
</div><!-- /.carousel -->
 
         <!-- end of slideshow banner1-->
          </div>
             <div id="banner2">
          <div id="myCarousel02" class="carousel slide"><!-- class of slide for animation -->
  <div class="carousel-inner">  <!--start of c- inner-->
  
 <!-- pic no 1 goes here-->
    <div class="item active"><!-- class of active since it's the first item -->
      <img src="http://placehold.it/237x128"  alt="" />
      
    </div>        <!--   end of item-->
   <!-- end of pic1-->
   
   <!-- pic no 2 goes here-->
    <div class="item">
      <img src="http://placehold.it/237x128" alt="" />
      
    </div>
    <!-- end pic no 2 goes here-->
    
     <!-- pic no 3 goes here-->
    <div class="item">
      <img src="http://placehold.it/237x128" alt="" />
      
    </div>
      <!-- end pic no 3 goes here-->
     
      <!-- pic no 4 goes here--> 
    <div class="item">
      <img src="http://placehold.it/237x128"  alt="" />
    </div>
     <!-- end pic no 4 goes here-->
    
  </div><!-- /.carousel-inner -->
</div><!-- /.carousel -->
 
         <!-- end of slideshow banner2-->
          </div>
              <div id="banner3">
          <div id="myCarousel03" class="carousel slide"><!-- class of slide for animation -->
  <div class="carousel-inner">  <!--start of c- inner-->
  
 <!-- pic no 1 goes here-->
    <div class="item active"><!-- class of active since it's the first item -->
      <img src="http://placehold.it/237x131"  alt="" />
      
    </div>        <!--   end of item-->
   <!-- end of pic1-->
   
   <!-- pic no 2 goes here-->
    <div class="item">
      <img src="http://placehold.it/237x131" alt="" />
      
    </div>
    <!-- end pic no 2 goes here-->
    
     <!-- pic no 3 goes here-->
    <div class="item">
      <img src="http://placehold.it/237x131" alt="" />
      
    </div>
      <!-- end pic no 3 goes here-->
     
      <!-- pic no 4 goes here--> 
    <div class="item">
      <img src="http://placehold.it/237x131"  alt="" />
    </div>
     <!-- end pic no 4 goes here-->
    
  </div><!-- /.carousel-inner -->
</div><!-- /.carousel -->
 
         <!-- end of slideshow banner3-->
          </div>
           <div id="banner4">
 <div id="myCarousel04" class="carousel slide"><!-- class of slide for animation -->
  <div class="carousel-inner">  <!--start of c- inner-->
  
 <!-- pic no 1 goes here-->
    <div class="item active"><!-- class of active since it's the first item -->
      <img src="http://placehold.it/302x278"  alt="" />
      
    </div>        <!--   end of item-->
   <!-- end of pic1-->
   
   <!-- pic no 2 goes here-->
    <div class="item">
      <img src="http://placehold.it/302x278" alt="" />
      
    </div>
    <!-- end pic no 2 goes here-->
    
     <!-- pic no 3 goes here-->
    <div class="item">
      <img src="http://placehold.it/302x278" alt="" />
      
    </div>
      <!-- end pic no 3 goes here-->
     
      <!-- pic no 4 goes here--> 
    <div class="item">
      <img src="http://placehold.it/302x278"  alt="" />
    </div>
     <!-- end pic no 4 goes here-->
    
  </div><!-- /.carousel-inner -->
</div><!-- /.carousel -->
          </div>
    </div> <!-- end of row-->
    
    </div>                   <!--end of banner-->
</div>   <!--end of header-->

<div class="row">  <!--start of row for nav-->
    <div class="span12">
      <div id="nav">
      <ul>
         <li><a href="<?php base_url(); ?>">Home</a></li>
        <li><a href="msasani">Msasani PreSchool</a></li>
        <li ><a href="upanga">Upanga PreSchool</a></li>
        <li ><a href="training-center">Training Center</a></li>
        <li ><a href="community-center">Community Center</a></li>
        <li><a href="blog">Blog</a></li>
        <li ><a href="news">News</a></li>
         <li ><a href="about-us">About Us</a></li>
        <li><a href="contact-us">Contact Us</a></li
    ></ul>
      </div>
    </div>

</div> <!-- end of row for nav-->