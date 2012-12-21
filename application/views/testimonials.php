<div class="span9">
<div class="content">
<div class="title_h1 summary_title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>
<?php foreach ($testimonials->result() as $testimonial): ?>
<p class = 'testimonial'><?php echo strip_tags($testimonial->message); ?><p> 
<p class = "signature"> <?php echo $testimonial->name ?>, <?php echo $testimonial->title; ?></p>
<hr>
<?php endforeach; ?>


 
  </div> 
  <!--end of content
-->
</div>  <!--end of span9-->






</div>



