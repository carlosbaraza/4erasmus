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
		<script type="text/javascript">
			$( function() {
		        (function() {
		          	var e = document.createElement('script'); e.async = true;
		          	e.src = document.location.protocol +
		          	'//connect.facebook.net/en_US/all.js';
		          	document.getElementById('fb-root').appendChild(e);
		        }());
		        window.fbAsyncInit = function() {
			        FB.init({
			          appId: '<?=$facebook->getAppID()?>',
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
			        FB.api('/<?=$fbid?>/?fields=picture.width(34).height(34)&access_token=AAAHhWdTpA3EBAOSbW67NjsAGh92UXnk0ZBpAnWCslFmFScGRaKn1a5fZBhYxRn9rMDjcsXLiaTKsfTFLq70kFdUt7T3MX6B41jiLtK1AZDZD', function(response) { 
			        	console.log(response)
			        	$('#loginBar p').prepend('<img src="'+ response.picture.data.url +'">')
					});
		        };
			})
		</script>
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
							<p>
							<label for="title">Title of Event: </label>
								<input TYPE="text" id="title"><br>
							<label for="date">Date (DD/MM/YYYY HH:MM): </label>
								<input TYPE="text" id="date"><br>
							<script type="text/javascript">
								$(function(){

									// Datepicker
									$('#date').datetimepicker({inline:true});

									//hover states on the static widgets
									$('#dialog_link, ul#icons li').hover(
										function() { $(this).addClass('ui-state-hover'); },
										function() { $(this).removeClass('ui-state-hover'); }
									);

								});
							</script>
							<label for="place">Place: </label>
								<input TYPE="text" id="place"><br>
							<label for="sharewith">Share event with: </label>
								<select name="sharewith">
									<option value="public" selected="selected">Public events</option>
									<option value="all">All my groups</option>
									<option value="custom">Custom</option>
								</select>
							</p>
						</form>
					</div>

				</div>
				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Claire's birthday party</h3>
					<h3 class = "date">Mon 16, 2012 8:30pm</h3>
					<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
				</div>
				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Loren ipsum et dolor</h3>
					<h3 class = "date">Mon 16, 2012 8:30pm</h3>
					<h3 class = "place">chasud coais dleiro</h3>
				</div>
				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Claire's birthday party</h3>
					<h3 class = "date">Mon 16, 2012 8:30pm</h3>
					<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
				</div>
				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Loren ipsum et dolor</h3>
					<h3 class = "date">Mon 16, 2012 8:30pm</h3>
					<h3 class = "place">chasud coais dleiro</h3>
				</div>
				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Claire's birthday party</h3>
					<h3 class = "date">Mon 16, 2012 8:30pm</h3>
					<h3 class = "place">Riverwalk, block 9, apartment 18.</h3>
				</div>
				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Loren ipsum et dolor</h3>
					<h3 class = "date">Mon 16, 2012 8:30pm</h3>
					<h3 class = "place">chasud coais dleiro</h3>
				</div>

				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Loren ipsum et dolor</h3>
					<h3 class = "date">Mon 16, 2012 8:30pm</h3>
					<h3 class = "place">chasud coais dleiro</h3>
				</div>

				<div class="event">
					<div class="eventImg"></div>
					<h3 class = "title">Kirsty and Annie Dublin</h3>
					<h3 class = "date">Tue 19, 2012 6:30pm</h3>
					<h3 class = "place">Dublin</h3>
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
	})
</script>
