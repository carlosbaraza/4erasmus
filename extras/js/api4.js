
var 4E = new function() {
	var api = this
	var log = ''

	this.newEvent = function(Arr) {
		var dataArr = new Array()
		for( var key in Arr) {
			var selector = Arr[key]
			if( $(selector).val() != '') {
				dataArr[dataArr.length] = $(selector).val()
			}
		}

		$.ajax({
			url  : "/api4/newEvent",
			type : "post",
			data : dataArr,
			success : function(response) {

			}
		})
	}

	this.autocompletePlace = function(needle, autocomp) {
		$.ajax({
			url	 : "/api4/autocompletePlace",
			type : "post",
			data : {
				needle : needle
			},
			success : function(response) {
				var place = $.parseJSON(response);
				if( typeof place.error != undefined) {
					console.log(place.error)
					api.log(place.error)
				} else {
					autocomp.process(response)
				}
			}
		})
	}

	this.log = function(msg) {
		api.log += msg + "\n"
	}
}