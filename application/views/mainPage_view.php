<?php /*

	This is the main page view

*/ ?>

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
			<p>Logged as <strong>Carlos Baraza</strong> at <strong>Waterford Institute of Technology</strong> ▼</p>

		</div>
		<div id="content">
			<div id="leftContent">
				<div class="bar">
					<div class="button leftButton"><p>Featured Events ▼</p></div>
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