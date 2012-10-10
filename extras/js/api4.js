
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

	this.action = function(targetid, actiontype) {
		switch(targetid[0]) {
			case 'e':
				var targettype = 'event'
				break
			case 'n':
				var targettype = 'network'
				break
			case 'p':
			 	var targettype = 'place'
			 	break
			default:
				return
		}
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
				//if( resobj.status == 'success') {}
			}
		})
	}

	this.comment = function(targetid, commentmsg) {
		switch(targetid[0]) {
			case 'e':
				var targettype = 'event'
				break
			case 'n':
				var targettype = 'network'
				break
			case 'p':
			 	var targettype = 'place'
			 	break
			default:
				return
		}
		targetid = targetid.substring(1)
		$.ajax({
			url  : "/index.php/api4/newComment?access_token=" + that.token,
			type : "post",
			data : {
				targetid   : targetid,
				targettype : targettype,
				commentmsg : commentmsg
			},
			success : function(response) {
				try {
					console.log(resobj)
					var resobj = $.parseJSON(response)
				} catch(err) {
					console.log(response)
					return
				}
				//if( resobj.status == 'success') {}
			}
		})
	}

	this.loadEventsOfDate = function(date, start) {
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
					var output = ''
					for( var key in eventarr.data) {
						var event = eventarr.data[key]
						output += '' +
						'<div class="event">' +
							'<div class="page1">' +
								'<div class="eventImg"><div class="eventImgBorder"></div><img src="'+ event.imageurl +'"></div>' +
								'<h3 class = "title">'+ event.eventname +'</h3>' +
								'<h3 class = "date">'+ event.eventstart +'</h3>' +
								'<h3 class = "place">'+ event.place.placename +'</h3>' +
							'</div>' +
							'<div class="page2">' +
								'<p class="description">'+ (event.eventdesc == null ? '' : event.eventdesc) +'</p>' +
								'<a href="javascript:void(0)" class="btn btn-primary" onclick="FE.follow(\'e' + event.eventid + '\')">Follow</a>' +
							'</div>' +
						'</div>'
					}
					$('#eventContainer').html(output)
				}

				//Event Animation for show description
				var myTimeout;
				$('.event').hover( function() {
					var that = this;
				    myTimeout = setTimeout(function() {
				        $(that).children('.page1,.page2').animate({top: '-164'}, 250);
				    }, 500);
				}, function() {
				    clearTimeout(myTimeout);
				    $(this).children('.page2,.page1').animate({top: '0'}, 250);
				});
			}
		})
	}

	this.loadCommentsOfObject = function(objid) {
		$.ajax({
			url  : '/index.php/api4/readComments?access_token=' + that.token,
			type : 'get',
			data : {
				id : objid
			}
		})
	}
}

var Fish = new function() {
	var that = this

	this.init = function() {
		that.cache = {}
		that.intervalKey = setInterval(that.update, 1000)
	}

	this.setUpdate = function(key) {
		var item = that.cache[key]
		that.cache[key].intervalId = setInterval(item.func, item.interval)
	}

	this.cache = function(key, interval, func) {
		// Create Object
		var item
		item.interval 	= interval
		item.func 	 	= func
		item.
		item.func(that)

		// Add item to List
		that.cache[key] = item
	}

	this.setData = function(key, data) {
		if( that.cache.hasOwnProperty(key)) {
			that.cache[key].data = data
			that.setUpdate(key)
		}
	}

	this.update = function() {

	}

	this.disable = function(key) {
		
	}
}

Fish.init()