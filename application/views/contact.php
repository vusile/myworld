<!--*start of first row for news, video and button/-->
<script src="js/jquery.validate.min.js" type = "text/javascript"></script>
<script type = "text/javascript">
$(document).ready(function(){
 
 $('#contact-form').validate(
 {
  rules: {
    name: {
      minlength: 2,
      required: true
    },    
  
  captcha: {
      
      required: true
    
    },
    email: {
      required: true,
      email: true
    },
 confirm_email: { equalTo:'#email', email:true },

    subject: {
      minlength: 2,
      required: true
    },
    message: {
      minlength: 2,
      required: true
    }
  },
  highlight: function(label) {
    $(label).closest('.control-group').addClass('error');
  },
  success: function(label) {
    label
      .text('OK!').addClass('valid')
      .closest('.control-group').addClass('success');
  }
 });
}); // end document.ready
</script>
<div class="row">
<div class="span12">
<div class="teaser">
<div class="title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>
<p><?php echo $details->text ?></p>
</div>
<div class="contact">
<form class="form-horizontal" id = "contact-form" method = "post" action = "send_message">
  <div class="control-group">
    <label class="control-label" for="inputName">Name:</label>
    <div class="controls">
      <input type="text" id="name" name = "name" placeholder="Enter your Name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPhone">Phone:</label>
    <div class="controls">
      <input type="text" id="phone" name = "phone" placeholder="Enter your Phone Number">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email:</label>
    <div class="controls">
      <input type="text" id="email" name = "email" placeholder="Enter your Email">
    </div>
  </div> 
   <div class="control-group">
    <label class="control-label" for="inputEmail">Confirm Email:</label>
    <div class="controls">
      <input type="text" id="confirm_email" name = "confirm_email" placeholder="Please type your email again.">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputSubject">Subject:</label>
    <div class="controls">
      <input type="text"  id="subject" name = "subject" placeholder="Enter the Subject">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputSubject">Message:</label>
    <div class="controls">
  <textarea class="input-xxlarge" name = "message" id = "message" rows = "10" ></textarea>
  </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputCaptcha">Captcha:</label>
    <div class="controls">
	<small style="font-weight: bold">Enter the text in the box below, only CAPITAL letters and numbers</small>
	<p><?php echo $cap['image'] ?></p>
    <input type="text" placeholder="Enter the words above" class="spam" name = "captcha" id = "captcha"><span class="help-inline"><!--<i>* Must be filled</i>--></span><br>
     </div>
    </div>
	
	  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Send Message</button>
    </div>
    </div>
    </div>
  </div>
  </div>
</form>
</div>


