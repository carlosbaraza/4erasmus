
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
	        });/*
	        FB.api('/<?=$fbid?>/?fields=friends.limit(5).fields(picture,name)&access_token=AAAHhWdTpA3EBAOlA60rZCpEqvjOCPYM11vemgrqZBUKb3g19Aq6TuLYHGparZBO3jjG8F4gZAjRIss67LIfqVId1qJtbaxzeiKtPawIWZCQZDZD', function(response) { 
	        	console.log(response)
	        	var pics = ''
	        	for( var key in response.friends.data) {
	        		var friend = response.friends.data[key]
	        		pics += '<img src="' + friend.picture.data.url + '">'
	        	}
	        	$('#fb-root').append(pics)
			});*/
        };
	})
</script>
		<?php if( !isset($username)) { ?>
			<fb:login-button></fb:login-button>
		<?php } else { 
				echo $username;
			  }
		?>
		</div>
	</div>
		<div id="content">
			<div id="leftContent">
				<div class="bar">
					<div class="button leftButton">
						<p>Featured Events ▼</p>
						<ul>
							<li><p>Hello</p></li>
							<li><p>Goodbye</p></li>
						</ul>

					</div>
					<div class="button rightButton"><p><img src="extras/img/icons/addEvent.png" class="icon">Add Event</p></div>
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