<!--*start of first row for news, video and button/-->
<div class="container_news">
<div class="row">    <!--start of the row-->
<div class="span12"> 
<div class="title_h1">
<h1><?php if(isset($title)) echo $title ?></h1>
</div>
<?php
$feedUrl = "http://www.myworldpreschooltz.com/apps/blog/entries/feed/rss";
$feedContent = "";
 
// Fetch feed from URL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $feedUrl);
curl_setopt($curl, CURLOPT_TIMEOUT, 3);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
 
// FeedBurner requires a proper USER-AGENT...
curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");
 
$feedContent = curl_exec($curl);
curl_close($curl);
 
// Did we get feed content?
if($feedContent && !empty($feedContent)):
	$feedXml = @simplexml_load_string($feedContent);
	if($feedXml):
?>

<?php foreach($feedXml->channel->item as $item): ?>
 <!--start of span-->
<div class="resizec">
<h2><a href="<?php  echo $item->link;  ?>"><?php echo $item->title; ?></a></h2>

	<?php
		$doc = new DOMDocument();
		@$doc->loadHTML($item->description);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
			if($count > 0)
				break;
			else
				if(!strpos ($tag->getAttribute('src'),'tracker'))
					echo "<a href='" . $item->link . "'><img src = '" . $tag->getAttribute('src') ."' / class='img3'></a>";
			$count++;
			}
		}
?>
<p>


<?php echo substr(strip_tags($item->description),0,600); ?> ... <p>
<a href="<?php  echo $item->link;  ?>"><p>Read More</p></a>
</div>
<div style = 'clear:both; margin-top:7px; margin-left:19px; width: 1024px; border-top:1px #cdcdcd solid;'></div>
<?php endforeach; ?>
	<?php endif; ?>
<?php endif; ?>
</div><!--end of span-->
</div>  <!--end of the row-->
</div>  <!--end of the container_news"-->

