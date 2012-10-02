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

				<?php
					$folder = 'extras/img/GallerysDefPics/Users/ozan/';
					$images = glob( $folder . '*.{jpg,jpeg,gif,png}', GLOB_BRACE);

					foreach ($images as $image) {
						echo '<div class="addEventGalleryPic"><img src="' . $image . '"></div>';
					}
				?>

			</div>
		</div>

		<div id="addEventShareWithContainer">
			<label for="addEventShareWith">Share event with: </label>
				<select id="addEventShareWith">
					<option value="public" selected="selected">Public events</option>
					<option value="all">All my groups</option>
				</select>
		</div>

		<div id="addEventImgUploader"></div>
		<script type="text/javascript" src="extras/js/fileuploader.js"></script>
		<script>        
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('addEventImgUploader'),
                action: 'index.php/api4/addEventDialogUploadPicture',
                debug: true,
                multiple: false
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    	</script>
    	<link rel="stylesheet" type="text/css" href="extras/css/fileuploader.css">

	</form>

	<div id="addEventDialogFooter">
		<a class="rightButton btn btn-primary" href="javascript:void(0)" onclick="addEventSendAJAX();"><p>Add Event</p></a>
	</div>
</div>