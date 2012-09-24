
var FE = new function() {

	// GOOGLE ANALYTICS

	// VARIABLES
	var that = this

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
		$.post("/index.php/api4/newEvent", dataArr,
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
			type : "post",
			data : {
				needle : needle
			},
			success : function(response) {
				var place = $.parseJSON(response);
				if( typeof place.error != undefined) {
					console.log(place.error)
					that.log(place.error)
				} else {
					autocomp.process(response)
				}
			}
		})
	}

	this.log = function(title, msg) {
		that.logtext += title + ':  ' + msg + "\n"
	}
}