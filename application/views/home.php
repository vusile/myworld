<!--start of teaser-->
<div class="row">
<div class="span12">
<div class="teaser">
  <?php echo $home ?>
  </div>
</div>
</div>

<!--*start of first row for news, video and button/-->
<div class="row"> 
  <div class="span4">  <!--start of span 4-->
    <div id="news">
       <h4>News Feed</h4>
      <div id="newsbox">    <!--start of news-->
		<?php foreach($news->result() as $article): ?>
        <div class="news-box">
		<?php
		if($article->thumb_nail != ''):
		?>
		<a href='article/<?php echo  $article->url ?>'><img src = 'ckfinder/userfiles/_thumbs/Images/<?php echo $article->thumb_nail ?>'  class="align-kulia" alt = ""></a>
		<?php endif;  ?>		<!--start of news box-->
		<div class="news-teaser"> 
		<strong><a href = "article/<?php echo $article->url ?>"><?php echo $article->title; ?></a></strong><br>
		<?php echo substr(strip_tags($article->text),0,65); ?> ... <a href = "article/<?php echo $article->url ?>">Read More</a>
		</div>
		</div>
		<div style = 'clear:both; margin:20px 0;   '></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>    <!--end of span 4
  -->
  <div class="span5">
     <div id="youtube">
       <h4>My World Preschool Prezi Video</h4>
       <iframe width="400" height="300" src="<?php echo strip_tags($video); ?>?rel=0" frameborder="0" allowfullscreen></iframe>
     
     </div>
  </div>
  
  <div class="span3">
     <div id="linkbutton">
    <a href="#"> <p>Read our <br> Evolution Report</p></a>
     </div>
  
  <div id="linkbutton2">
    <a href="#"> <p>What is Play <br>Based Learning</p></a>
     </div>
  </div>
  </div>    <!--end of span3-->

 <!--end of row-->
<div class="row">
  <div class="span4">
      <div id="fb">
     <div class="fb-like-box" data-href="http://www.facebook.com/myworldpreschool?fref=ts" data-width="321" data-height="300" data-show-faces="true" data-stream="false" data-header="true"></div>
      </div>
  </div>
  
  <div class="span5">
     <div id="slideshow">
<div id="myCarousel" class="carousel slide"><!-- class of slide for animation -->
  <div class="carousel-inner">
	<?php foreach($images->result() as $image): ?>
    <div class="item"><!-- class of active since it's the first item -->
      <img src="img/<?php echo $image->photo ?>"  alt="<?php echo $image->caption; ?>" />
      <div class="carousel-caption">
	  <?php if($image->url != ''): ?>
        <a href="<?php echo $image->url ?>"><p><?php echo $image->caption; ?></p></a>
	  <?php else: ?>
        <p><?php echo $image->caption; ?></p>
	  <?php endif; ?>
      </div>
    </div>
	<?php endforeach; ?>
    
  </div><!-- /.carousel-inner -->
  <!--  Next and Previous controls below
        href values must reference the id for this carousel -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->
 


  
     
     </div>
  </div>
  
  <div class="span3">
     <div id="linkbutton3">
     <a href="#"><p>For Whatever<br> Rupal Forgot</p></a>
     </div>
  
  </div>
  </div>    <!--end of span3-->

</div>  <!--end of row-->



