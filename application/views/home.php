

	<script type="text/javascript"

    src="https://maps.google.com/maps/api/js?sensor=true">

	</script>

	<script type="text/javascript">

	  function initialize() {

	    navigator.geolocation.getCurrentPosition(foundLocation);

	  }



	  function foundLocation(position) {

	    var latitud = position.coords.latitude;

	    var longitud = position.coords.longitude;

	    var latlng = new google.maps.LatLng(latitud, longitud);

	    var myOptions = {

	      zoom: 13,

	      center: latlng,

	      mapTypeId: google.maps.MapTypeId.ROADMAP

	    };

	    var map = new google.maps.Map(document.getElementById("fe-map"),

	        myOptions);



	    var tb = document.getElementById("fe-head-whereiam");

	    tb.innerHTML = "<p>You are at <strong>Lat: " + latitud + "  Long: " + longitud + "</strong></p>";

	  }

	</script>




<body onload="initialize()">

	

	<header id = "fe-header">

		<a href="#" id="fe-logo">

			<img src="<?=$img_base?>Logo1_web.png" alt="4Erasmus, share events">

		</a>

		<div id="fe-headlogin" class = "in-construction">

			Login

		</div>

		<div id="fe-head-whereiam" class = "in-construction">

			<p>Where I am?</p>

		</div>

	</header>



	<nav id = "fe-navbar">

		<ul>

			<a href="#"><li><p>Calendar / Schedule</p></li></a>

			<a href="#"><li id="AddEventButton"><p>Add New Erasmus Event</p></li></a>

		</ul>

	</nav>	

	<div id = "fe-content">

		<form id = "fe-rightform">

			<div class="rightform-field">

				<label for=form-tittle>Event Tittle</label>

				<input name=form-tittle id="form-tittle" type=text required>

			</div>

			<div class="rightform-field">

				<label for=form-address>Address</label>

				<input name=form-address id="form-address" type=text required>

			</div>

			<div class="rightform-field">

				<label for=form-date>Date</label>

				<input name=form-date id="form-date" type=text required>

			</div>

			<div class="rightform-field">

				<label for=form-url>Event URL</label>

				<input name=form-url id="form-url" type=url>

			</div>

			<div class="rightform-field">

				<label for=form-comment>Comment</label>

				<textarea name=form-comment id="form-comment" required>

				</textarea>

			</div>

			<input type=submit>

		</form>

		<div id = "fe-map">



		</div>

		<p id = "longLat" style ="position: absolute; z-index:4;"></p>

		<div id = "fe-leftcontainer">

			<div id = "fe-lc-calendar" class = "in-construction">

				Calendar

			</div>

			<div id = "fe-lc-schedule" class = "in-construction">

				Schedule

			</div>

		</div>



		<!-- <img id = "fe-map" src="./images/captura3.jpg"/> -->

	</div>

	<div id="fe-content2">





	</div>

	<div id = "fe-footer">

		<p>© 2012 4erasmus.com</p>

	</div>
</body>