
$( function() {

	video = document.getElementById("html5video")
	$video = $("#html5video")

	video.progress = function() {
		var wid = $("#bars").width() / video.duration
		$("#progressBar").width(wid * video.currentTime)
	}
	setInterval('video.progress()', 500)

	var pos = $("#navi").offset()
	pos.top = $("#html5video").offset().top + $("#html5video").height() - 40
	$("#navi").offset(pos)


	var playing = false
	$video.click( function(e) {
		if( playing) {
			video.pause()
		} else {
			video.play()
		}
		playing = !playing
	})

	$("#bars").click( function(e) {
		os = e
		$("#progressBar").width(e.offsetX)
		video.currentTime = e.offsetX / $("#bars").width() * video.duration
	})

	$video.mouseout( function() {
		setTimeout(mout, 2000)
	})
	$video.mouseover( function() {
		$("#navi").css("opacity", 1)
	})


	navigator.geolocation.getCurrentPosition( showLocation)
})

function mout() {
	$("#navi").animate({
		opacity : 0
	}, 1000)
}

var VideoPlayer = new function() {
	var that = this

}

function showLocation(pos) {
//	$("body").append('<iframe id="map_canvas" width="550" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/?ie=UTF8&amp;ll=' + pos.coords.latitude + ',' + pos.coords.longitude + '&amp;spn=62.74193,129.814453&amp;t=m&amp;z=16&amp;output=embed"></iframe>')
	var location = new Array()
	location['Xa'] = pos.coords.latitude
	location['Ya'] = pos.coords.longitude

	console.log(pos.coords.latitude)

	var latlng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
    var mapOptions = {
      zoom: 16,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions)

    var marker = new google.maps.Marker({
        map: map,
        position: latlng
    });

    $("body").append("<br>latitude: " + pos.coords.latitude + "<br>longitude: " + pos.coords.longitude)
	
}