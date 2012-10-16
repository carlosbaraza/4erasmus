<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
   <meta charset="utf-8">
   <title><?= $title ?></title>
   <?= $_scripts ?>
   <?= $_styles ?>

   <?= $_less ?>
   <script src="/extras/js/less-1.3.0.min.js" type="text/javascript"></script>

</head>
<body>
	<div id="container">
		<?= $leftcontainer ?>

		<div id="rightContainer">
			<?= $loginbar ?>

		 	<div id="content">
				<?= $events ?>
				<?= $schoolProfile ?>
				<?= $wall ?>
				<div class="clear"></div>
				<div class="rightColorStrip colorStripYellow"></div>
			</div>
		</div>
	</div>

	<?= $addEventDialog ?>


	<script type="text/javascript">
		$(document).ready( function() {
			<?php if( isset($facebook)) { ?>
		       (function(d){
	           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	           if (d.getElementById(id)) {return;}
	           js = d.createElement('script'); js.id = id; js.async = true;
	           js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=529250917090161";
	           ref.parentNode.insertBefore(js, ref);
	           }(document)); 
		        window.fbAsyncInit = function() {
			        FB.init({
			          appId: '<?=$facebook->getAppId()?>',
			          cookie: true,
			          xfbml: true,
			          oauth: true
			        });
			        FB.Event.subscribe('auth.login', function(response) {
			          window.location.reload();
			        });
			        FB.Event.subscribe('auth.logout', function(response) {
			          window.location.reload();
			        });
			        FB.api('/<?=$fbid?>/?fields=picture.width(34).height(34)&access_token=<?=$facebook->getAccessToken()?>', function(response) { 
			        	console.log(response)
			        	$('#loginBar p').prepend('<img src="'+ response.picture.data.url +'">')
					});
		        };
		        <?php } ?>
	        /*
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-35018312-1'])
			_gaq.push(['_setDomainName', '4erasmus.com'])
			_gaq.push(['_trackPageview'])
			*/
			FE.token = '<?php if(isset($access_token)) 
							echo $access_token;
						else 
							echo ""?>'
			FE.resourcepath = <?=RESOURCEPATH?>
		})
	</script>


</body>
</html>