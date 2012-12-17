<!--*start of first row for news, video and button/-->
<div class="row">    <!--start of the row-->

<?php foreach($news->result() as $article): ?>
<div class="span12">  <!--start of span-->
<div class="resizeb">
<h2><a href="article/<?php  echo $article->url  ?>"><?php echo $article->title ?></a></h2>
<?php
	if($article->thumb_nail != '')	
		echo "<a href='article/" . $article->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $article->thumb_nail ."'  class='img3' ></a>";
?>
<p>


<?php echo substr(strip_tags($article->text),0,600); ?> ... <p>
<a href="article/<?php  echo $article->url  ?>"><p>Read More</p></a>
</div>
</div><!--end of span-->
<div style = 'clear:both; margin-top:7px; margin-left:19px; width: 1024px; border-top:1px #cdcdcd solid;'></div>
<?php endforeach; ?>

</div>  <!--end of the row-->




