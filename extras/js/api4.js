
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
		$.ajax({
			url  : "/index.php/api4/newAction?access_token=" + that.token,
			type : "post"
		})
	}
}