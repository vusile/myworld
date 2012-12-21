<!--*start of first row for news, video and button/-->
<div class="row">    <!--start of the row-->

<?php foreach($news->result() as $article): ?>
<div class="span9">  <!--start of span-->
<div class="resizeb">
<div class="title_h1 summary_title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>
<h2><a href="<?php echo $url ?>/<?php  echo $article->url  ?>"><?php echo $article->title ?></a></h2>
<?php
	if($article->thumb_nail != '')	
		echo "<a href='" . $url . "/" . $article->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $article->thumb_nail ."'  class='img3' ></a>";
?>
<p>


<?php echo substr(strip_tags($article->text),0,600); ?> ... <p>
<a href="<?php echo $url ?>/<?php  echo $article->url  ?>"><p>Read More</p></a>
</div>
</div><!--end of span-->
<div style = 'clear:both; margin-top:7px; margin-left:19px; width: 1024px; border-top:1px #cdcdcd solid;'></div>
<?php endforeach; ?>

</div>  <!--end of the row-->




