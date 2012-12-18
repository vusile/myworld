<div class="span9">
<div class="content">

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



