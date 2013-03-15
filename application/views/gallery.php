<div class="row">
<!--*start of sidebar-->
  <!--end of span3-->
<div class="span9">
<div class="content">
<div class="title_h1 summary_title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>
<?php foreach($galleries->result() as $gallery): ?>
	<div id='albumcol'>
		<h2><a href = "<?php echo $school_url ?>/album/<?php echo $gallery->url ?>"><?php echo $gallery->title; ?></a></h2>
		<a href = "<?php echo $school_url ?>/album/<?php echo $gallery->url ?>"><?php echo $gallery->thumb_nail; ?></a>
	</div>
<?php endforeach; ?>
  </div>

</div>  <!--end of span9-->
</div>



