
var FE = new function() {

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
				response = $.parseJSON(response)
				if( response.status == 'success') 
					alert('Event Created!')
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
			//	date  : new Date(date).getTime() / 1000,
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
						'<div class="event" id="'+ event.eventid +'">' +
							'<div class="page1">' +
								'<div class="eventImg"><div class="eventImgBorder"></div><img src="'+ event.imageurl +'"></div>' +
								'<h3 class = "title">'+ event.eventname +'</h3>' +
								'<h3 class = "date">'+ event.eventstart +'</h3>' +
								'<h3 class = "place">'+ event.place.placename +'</h3>' +
							'</div>' +
							'<div class="page2">' +
								'<p class="description">'+ (event.eventdesc == null ? '' : event.eventdesc) +'</p>' +
								'<a href="javascript:void(0)" class="btn btn-primary" onclick="FE.action(\'e\' + $(this).attr(\'id\', \'follow\'))">Follow</a>' +
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
				})
				// Clickevent for Events
				// Change URL and load comments
				.click( function() {
					console.log($(this).attr('id'))
					window.history.pushState('add event', 'add event', '/event/' + $(this).attr('id'))
					$('.wallEntry').html('<div class="fb-comments" data-href="http://www.4erasmus.com/event/'+ $(this).attr('id') +'" data-num-posts="2" data-width="370"></div>')
				})

				var requestDate = new Date(date)
				window.history.pushState('date', 'date', '/date/' + (requestDate.getMonth()+1) + '-' + requestDate.getDate() + '-' + requestDate.getFullYear())
			}
		})
	}

	this.loadCommentsOfObject = function(targetid, start) {
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

		$.ajax({
			url  : '/index.php/api4/readComments?access_token=' + that.token,
			type : 'get',
			data : {
				targetid   	: targetid,
				targettype 	: targettype,
				start 	   	: start,
				limit		: 10
			},
			success : function(response) {
				try {
					var commentarr = $.parseJSON(response)
				} catch(err) {
					console.log(response)
					return
				}
				var output = ''
				if( commentarr.status == 'success') {
					for( var key in commentarr.data) {
						var comment = commentarr[key]
						output += '' + 
						'<p class="name">'+ comment.user.fbname +'</p>' + 
						'<p class="text">'+ comment.commentmsg +'</p>'
					}
				}
			}
		})
	}

	this.loadSpecificPage = function() {
		var querystring = window.location.pathname.split('/')
		switch(querystring[1]) {
			case 'date':
				if( querystring.hasOwnProperty(2)) {
					var requestDate = new Date(querystring[2])
					var formattedDate = (requestDate.getMonth()+1)+'/'+requestDate.getDate()+'/'+requestDate.getFullYear()
					that.loadEventsOfDate(formattedDate, 0)
					$('#datepicker').datepicker('setDate', new Date(formattedDate))
				}
				break;
			default:
				var requestDate = new Date()
				var formattedDate = (requestDate.getMonth()+1)+'/'+requestDate.getDate()+'/'+requestDate.getFullYear()
				that.loadEventsOfDate(formattedDate, 0)
				break;
		}
	}
}

var Fish = new function() {
	var that = this

	/* item Object Description
	 * item.data
	 * item.func
	 * item.interval
	 * item.lastupdate
	 * item.nextupdate
	*/

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
		item.nextUpdate = new Date().getTime() + interval
		item.func(that)

		// Add item to List
		that.cache[key] = item
	}

	this.setData = function(key, data) {
		if( that.cache.hasOwnProperty(key)) {
			var currentTime = new Date().getTime()
			var item = that.cache[key]
			item.data[item.data.length] = data
			item.lastupdate = currentTime
			item.nextUpdate = currentTime + item.interval
		}
	}

	this.update = function() {
		var currentTime = new Date().getTime()
		for( var key in that.cache) {
			var item = that.cache(key)
			if( item.active && currentTime < item.nextUpdate) {
				item.func(that, item.lastupdate)
			}
		}
	}

	this.disable = function(key) {
		that.cache[key].active = false
		return that.cache[key]
	}

	this.enable = function(key) {
		that.cache[key].active = true
	}
}

Fish.init()