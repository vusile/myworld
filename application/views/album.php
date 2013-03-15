<link rel="stylesheet" type="text/css" href="css/shadowbox.css">
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>

<div class="row">
<!--*start of sidebar-->
  <!--end of span3-->
<div class="span9">
<div class="content">
<div class="title_h1 summary_title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>
<?php foreach($images->result() as $image): ?>
<a href="img/<?php echo $image->image ?>" rel="shadowbox[<?php echo $title ?>]"><img width = "150px" alt = "<?php echo $image->title ?>" src = 'img/thumb__<?php echo $image->image ?>' /></a>
<?php endforeach; ?>
  </div>

</div>  <!--end of span9-->
</div>



