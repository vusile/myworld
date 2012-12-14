<!--*start of first row for news, video and button/-->
<h1><?php echo $title ?></h1>
<div class="row">    <!--start of the row-->

<?php foreach($news->result() as $article): ?>
<div class="span12">  <!--start of span-->
<div class="resizeb">
<h2><?php echo $article->title ?></h2>
<?php
	if($article->thumb_nail != '')	
		echo "<a href='article/" . $article->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $article->thumb_nail ."'  class='img3' ></a>";
?>
<p>


<?php echo substr(strip_tags($article->text),0,600); ?> ... <p>
<a href="article/<?php  $article->url  ?>"><p>Read More</p></a>
</div>
<hr>
</div><!--end of span-->
<?php endforeach; ?>

</div>  <!--end of the row-->




