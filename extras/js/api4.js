
var fourErasmus = new function() {

	// GOOGLE ANALYTICS
	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

	// VARIABLES
	var api = this
	var log = ''

	this.newEvent = function(selectorArray) {
		var dataArr = new Array()
		for( var key in selectorArray) {
			var selector = selectorArray[key]
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

	this.log = function(title, msg) {
		api.log += title + ':  ' + msg + "\n"
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-35018312-1'])
		_gaq.push(['_setDomainName', '4erasmus.com'])
		_gaq.push(['_trackPageview'])
	}
}