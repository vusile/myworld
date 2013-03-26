<!--*start of first row for news, video and button/-->
<div class="container_news">
<div class="row">    <!--start of the row-->
<div class="span12">  <!--start of span-->
<div class="title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>
<Br>
<?php foreach($news->result() as $article): ?>
<div class="resizec">
<h2><a href="article/<?php  echo $article->url  ?>"><?php echo $article->title ?></a></h2>
<?php
	if($article->thumb_nail != '')	
		echo "<a href='article/" . $article->url . "'><img src = 'ckfinder/userfiles/_thumbs/Images/" . $article->thumb_nail ."'  class='img3' ></a>";
?>
<p>


<?php echo substr(strip_tags($article->text),0,600); ?> ... <p>
<a href="article/<?php  echo $article->url  ?>"><p>Read More</p></a>
</div>
<div style = 'clear:both; margin-top:7px;  width: 1024px; border-top:1px #cdcdcd solid;'></div><BR>
<?php endforeach; ?>
</div><!--end of span-->

</div>  <!--end of the row-->
</div>  <!--end of the container_news"-->



