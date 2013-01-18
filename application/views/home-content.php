<!--<link rel="stylesheet" href="css/global.css">-->
<style type="text/css" media="screen">
    /*
      Load CSS before JavaScript
    */
    
    /*
      Slides container
      Important:
      Set the width of your slides container
      Set to display none, prevents content flash
    */
    .slides_container {
      width:410px;
      display:none;
    }

    /*
      Each slide
      Important:
      Set the width of your slides
      If height not specified height will be set by the slide content
      Set to display block
    */
    .slides_container div {
      width:410px;
      height:300px;
      display:block;
    }
    
    /*
      Optional:
      Reset list default style
    */
    .pagination {
      display:none;
      list-style:none;
      margin:0;
      padding:0;
    }

    /*
      Optional:
      Show the current slide in the pagination
    */
    .pagination .current a {
      color:red;
    }
  </style>
<script src="js/slides.min.jquery.js"></script>
  <script>
    $(function(){
      $('#slides').slides({
        preload: true,
        generateNextPrev: true
      });
    });
  </script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
          <!--start of news box-->
       <?php foreach($news->result() as $article): ?>
        <div class="news-box">
		<?php
		if($article->thumb_nail != ''):
		?>
		<a href='article/<?php echo  $article->url ?>'><img src = 'ckfinder/userfiles/_thumbs/Images/<?php echo $article->thumb_nail ?>'  class="align-kulia" alt = ""></a>
		<?php endif;  ?>		<!--start of news box-->
		<div class="news-teaser"> 
		<strong><a href = "article/<?php echo $article->url ?>"><?php echo $article->title; ?></a></strong><br>
		<?php echo substr(strip_tags($article->text),0,65); ?> ... <a href = "article/<?php echo $article->url ?>" >Read More</a>
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
  
  <div class="span3" >
     <a href="uploads/My-World-Evaluation-Report.pdf" target = "_blank"><img src="img/read-our-evaluation-report.png" alt="Our Evaluation Report"  style = "margin-left:5px;"/></a>
     <img src="img/progressive-play-based-education.png" alt="Progressive Play Based Education" style = "margin-left:5px;"/>
     <img src="img/imagination-playground.png" alt="Imagination Playground" style = "margin-left:5px;" />
  </div>
  </div>    <!--end of span3-->

</div>  <!--end of row-->
<div class="row">
  <div class="span4" style = "margin-top: -54px;">
      <div id="fb">
     <div class="fb-like-box" data-href="http://www.facebook.com/myworldpreschool?fref=ts" data-width="295" data-height="300" data-show-faces="true" data-stream="false" data-header="true"></div>
      </div>
  </div>
  
  <div class="span5" style = "margin-top: -50px;">
 <!-- end of slideshow-->
      <div id="slides">
        <div class="slides_container">
          <?php foreach($images->result() as $image): ?>
          <div class="slide">
            <p style = "font-weight: bold; font-size: 18px;"><?php echo $image->caption; ?></p>
            <p><img src="img/<?php echo $image->photo ?>"  alt="<?php echo $image->caption; ?>" /></p>
          </div>
          <?php endforeach; ?>
          
        </div>

      </div>
 
  </div> <!-- end of span 5-->
  
  <div class="span3" >
    <!-- AddThis Follow BEGIN -->
<!-- AddThis Follow END -->

    <div id="partiners">
      <br>
    <p style = "text-align:left; color:#031289;margin-bottom: 10px; font-size: 17.5px; font-weight: bold; margin-left: 15px;">Follow Us</p>
    <div style = "margin-left:10px;">
    <div class="addthis_toolbox addthis_32x32_style addthis_default_style">
    <a class="addthis_button_twitter_follow space-between" addthis:userid="ZoomTanzania"></a>
    <a class="addthis_button_youtube_follow space-between" addthis:userid="vusilesilonda/videos"></a>
    <a class="addthis_button_pinterest_follow space-between" addthis:userid="vusile"></a>
    </div>
    </div>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50f7fc3e4132aef9"></script>
      <br> <h4 style = "margin-bottom:5px;">Our Partners</h4>
        <ul>
		<?php foreach($links->result() as $link): ?>
			<li style = "margin-bottom:3px;"><a href="<?php echo $link->partner_website ?>"><?php echo $link->partner_name ?></a></li>
		<?php endforeach; ?>

      </ul>
       
     </div>
  
  
  
  </div>    <!--end of span3-->

</div>  <!--end of row-->

<!--start of footer-->