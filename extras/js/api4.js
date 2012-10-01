
var FE = new function() {

	// GOOGLE ANALYTICS

	// VARIABLES
	var that = this
	var cache = {}

	this.init = function() {
		that.logtext = ''
		that.arrdata = {}
	}

	this.newEvent = function(textArray) {
		var dataArr = {}
		for( var key in textArray) {
			var text = textArray[key]
			if( text != '') {
				dataArr[key] = text
			}
		}

		dataArr['access_token'] = that.token
		$.post("/index.php/api4/newEvent?access_token=" + that.token, dataArr,
			function(response) {
				if( response.status == 'success') 
					alert('Event Created!');
				console.log(response)
			}
		)
	}

	this.autocompletePlace = function(needle, autocomp) {
		$.ajax({
			url	 : "/index.php/api4/autocompletePlace",
			type : "get",
			data : {
				needle		 : needle,
				access_token : that.token
			},
			success : function(response) {
				var places = $.parseJSON(response);

				var dataArr = []
				for(var key in places) {
					var value = places[key]
					dataArr[key] = value.placename
				}
				autocomp.process(dataArr)
			}
		})
	}

	this.log = function(title, msg) {
		that.logtext += title + ':  ' + msg + "\n"
	}

	this.follow = function(targetid) {
		var targettype = targetid[0]
		targetid = targetid.substring(1)
		$.ajax({
			url  : "/index.php/api4/newAction?access_token=" + that.token,
			type : "post",
			data : {
				targetid   : targetid,
				targettype : targettype,
				actiontype : 'follow'
			},
			success : function(response) {
				try {
					var resobj = $.parseJSON(response)	
				} catch(err) {
					console.log(response)
					return
				}
				if( resobj.status == 'success') {

				}
			}
		})
	}

	this.loadEventsOfDate = function(date, start) {
		var outdiv = document.createElement('div')
		$(outdiv).addClass('event').append(
			$(document.createElement('div')).addClass('page1').append(
				$(document.createElement('div')).addClass('eventImg').append(
					$(document.createElement('div')).addClass('eventImgBorder') ).append(
					document.createElement('img').src = 'extras/img/GallerysDefPics/Misc/3.png')).append(
				$(document.createElement('h3')).addClass('title').text('Claire\'s birthday party')).append(
				$(document.createElement('h3')).addClass('date').text('Mon 16, 2012 8:30pm')).append(
				$(document.createElement('h3')).addClass('place').text('Riverwalk, block 9, apartment 18'))).append(
			$(document.createElement('div')).addClass('page2').append(
				$(document.createElement('p')).text('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.')
		))
		//$("#events").append(outdiv);
		console.log($(outdiv))
		return
		$.ajax({
			url  : '/index.php/api4/eventsOfDate?access_token=' + that.token,
			type : 'get',
			data : {
				date  : date,
				start : start,
				limit : 10
			},
			success : function(response) {
				try {
					var eventarr = $.parseJSON(response)
				} catch(err) {
					console.log(response)
					return
				}
				if( eventarr.status == 'success') {
					var outdiv = document.createElement('div')
				}
			}
		})
	}
}