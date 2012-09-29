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
		<a class="rightButton button" href="javascript:void(0)" onclick="addEventSendAJAX();"><p>Add Event</p>
			<div class="rightColorStrip colorStripBlue"></div></a>
	</div>
</div>