<div id="container">
	<div id="leftContainer">
		<div class="mainTitle">
			<h1 class="title1">4</h1>
			<h1 class="title2">ERASMUS</h1>
		</div>

		<script type="text/javascript">
			$(function(){

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);

			});
		</script>
		<div id="datepicker"></div>

		
	</div>
	<div id="rightContainer">
		<div id="loginBar">
			
		<div id="fb-root">
	</div>
		<?php if( !isset($username)) { ?>
			<p><fb:login-button></fb:login-button></p>
		<?php } else { 
				echo '<p><strong>'.$username.'</strong> at <strong>Waterford Institute of Technology</strong> ▼</p>';
			  }
		?>
			<div id="loginForm"></div>

		</div>
		<div id="content">
			<div id="leftContent">
				<div class="bar">
					<div class="button leftButton">
						<p>Top Events ▼</p>
						<ul>
							<li><p>Hello</p></li>
							<li><p>Goodbye</p></li>
						</ul>

					</div>
					<div id="addEventButton" class="button rightButton"><p><img src="extras/img/icons/addEvent.png" class="icon">Add Event</p></div>

					<div id="addEventDialog">
						<form>
							
							<label for="addEventTitle">Title of Event: </label>
								<input TYPE="text" id="addEventTitle"><br>

							<label for="addEventDate">Date (MM/DD/YYYY HH:MM): </label>
								<input TYPE="text" id="addEventDate"><br>
							<script type="text/javascript">
								$(function(){

									// Datepicker
									$('#addEventDate').datetimepicker();

									//hover states on the static widgets
									$('#dialog_link, ul#icons li').hover(
										function() { $(this).addClass('ui-state-hover'); },
										function() { $(this).removeClass('ui-state-hover'); }
									);

								});
							</script>

							<label for="addEventPlace">Place: </label>
								<input TYPE="text" id="addEventPlace"><br>

							<label for="addEventDescription">Description: <em>(Optional)</em></label>
								<textarea id="addEventDescription"></textarea>

							<div id="addEventGalleryContainer">
								<label for="addEventCategory">Category: </label>
									<select id="addEventCategory">
										<option value="party">Party</option>
										<option value="sport">Sport</option>
										<option value="trip">Trip</option>
										<option value="other" selected="selected">Other</option>
									</select>

								<label for="addEventGallery">Select an image for event:</label>
								<div id="addEventGallery">
									<div class="addEventGalleryPic selected"><img src="extras/img/GallerysDefPics/Misc/1.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/3.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/4.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/1.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/4.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/3.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/1.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/3.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/4.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/1.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/3.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/4.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/1.png"></div>
									<div class="addEventGalleryPic"><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
								</div>
							</div>

							<div id="addEventShareWithContainer">
								<label for="addEventShareWith">Share event with: </label>
									<select id="addEventShareWith">
										<option value="public" selected="selected">Public events</option>
										<option value="all">All my groups</option>
									</select>
							</div>

						</form>

						<div id="addEventDialogFooter">
							<a class="rightButton button" href="#" onclick="addEventSendAJAX();"><p>Add Event</p></a>
						</div>
					</div>

				</div>
				<div class="event">
					<div class="page1">
						<div class="eventImg"><div class="eventImgBorder"></div><img src="extras/img/GallerysDefPics/Misc/3.png"></div>
						<h3 class = "title">Claire's birthday party</h3>
						<h3 class = "date">Mon 16, 2012 8:30pm</h3>
						<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
					</div>
					<div class="page2">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
				<div class="event">
					<div class="page1">
						<div class="eventImg"><div class="eventImgBorder"></div><img src="extras/img/GallerysDefPics/Misc/4.png"></div>
						<h3 class = "title">Claire's birthday party</h3>
						<h3 class = "date">Mon 16, 2012 8:30pm</h3>
						<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
					</div>
					<div class="page2">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
				<div class="event">
					<div class="page1">
						<div class="eventImg"><div class="eventImgBorder"></div><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
						<h3 class = "title">Claire's birthday party</h3>
						<h3 class = "date">Mon 16, 2012 8:30pm</h3>
						<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
					</div>
					<div class="page2">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
				<div class="event">
					<div class="page1">
						<div class="eventImg"><div class="eventImgBorder"></div><img src="extras/img/GallerysDefPics/Misc/3.png"></div>
						<h3 class = "title">Claire's birthday party</h3>
						<h3 class = "date">Mon 16, 2012 8:30pm</h3>
						<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
					</div>
					<div class="page2">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
				<div class="event">
					<div class="page1">
						<div class="eventImg"><div class="eventImgBorder"></div><img src="extras/img/GallerysDefPics/Misc/4.png"></div>
						<h3 class = "title">Claire's birthday party</h3>
						<h3 class = "date">Mon 16, 2012 8:30pm</h3>
						<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
					</div>
					<div class="page2">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
				<div class="event">
					<div class="page1">
						<div class="eventImg"><div class="eventImgBorder"></div><img src="extras/img/GallerysDefPics/Misc/2.png"></div>
						<h3 class = "title">Claire's birthday party</h3>
						<h3 class = "date">Mon 16, 2012 8:30pm</h3>
						<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
					</div>
					<div class="page2">
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>




			</div>
			<div id="rightContent">
				<div class="bar">
					<div class="button leftButton"><p>All ▼</p></div>
					
				</div>

				<div class="wallEntry">
					<div class="picture"></div>
					<div class="container">
						<p class="name">Carlos Baraza</p>
						<p class="text">This is the first entry for trying the event description. Loren ipsum et dolor su hamed jusaras.</p>

						<div class="comment">
							<div class="picture"></div>
							<div class="container">
								<p class="name">Carlos Baraza</p>
								<p class="text">This is the first entry for trying the event description. Loren ipsum et dolor su hamed jusaras.</p>
							</div>
						</div>

					</div>
				</div>



			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function() { 
	/*
        window.fbAsyncInit = function() {
	        FB.init({
	          appId: '$facebook->getAppId()',
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
	        FB.api('/$fbid/?fields=picture.width(34).height(34)&access_token=$facebook->getAccessToken()', function(response) { 
	        	console.log(response)
	        	$('#loginBar p').prepend('<img src="'+ response.picture.data.url +'">')
			});
        };*/
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-35018312-1'])
		_gaq.push(['_setDomainName', '4erasmus.com'])
		_gaq.push(['_trackPageview'])
		FE.token = '<?=$access_token?>'
	})
	function send() {
		forErasmus.newEvent({
			'eventname' : $('#addEventTitle').val(), 
			'eventdate'	: $('#addEventDate').val(), 
			'place' 	: $('#addEventPlace').val(), 
			'sharewith' : $('select[name=addEventShareWith] option:selected').val()
		})
	}

</script>
