<!--*start of first row for news, video and button/-->
<div class="row">
<div class="span12">

<h1>Contact My World Preschool</h1>
<div class="teaser">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam interdum ligula et tellus tempor sed condimentum massa mattis. Etiam id hendrerit orci. Nullam vel diam nisl, imperdiet lobortis est. Donec consectetur, mi quis aliquam placerat, lacus massa </p>
</div>
<form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputName">Name:</label>
    <div class="controls">
      <input type="text" id="inputName" placeholder="Enter your Name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPhone">Phone:</label>
    <div class="controls">
      <input type="text" id="inputPhone" placeholder="Enter your Phone Number">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email:</label>
    <div class="controls">
      <input type="text" id="inputEmail" placeholder="Enter your Email">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputSubject">Subject:</label>
    <div class="controls">
      <input type="text" id="inputSubject" placeholder="Enter the Subject">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputSubject">Message:</label>
    <div class="controls">
  <textarea rows="5" ></textarea>
  </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputCaptcha">Capcha:</label>
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


