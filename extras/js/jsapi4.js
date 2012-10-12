	
	$(document).ready(function() {

		//Show login Form
		$('#loginBar p').bind('click', openLoginForm);
		function openLoginForm() {
			$("#loginForm").css('visibility','visible');
		}
		//Not propague the hiding of all when click inside.
		$('#loginBar p, #loginForm').click(function(event){
		    event.stopPropagation();
		});

		//Open dropdown menu leftButton
		$('.leftButton').bind('click', openSubMenu);	
		function openSubMenu() {
			$(this).find('ul').css('visibility', 'visible');	
		};
		//Not propague the hiding of all when click inside.
		$('.leftButton').click(function(event){
		    event.stopPropagation();
		});

		// Hide all the forms and menus clicking on the body
		$('html').click(function() {
		 	$('.leftButton').find('ul').css('visibility', 'hidden');
		 	$('#loginForm').css('visibility','hidden');
		});


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


		// Add Event Dialog with JQuery UI Dialog
		$.fx.speeds._default = 400;
		if ( $.browser.msie ){ //IExplore compatible...
			$(function() {
				$( "#addEventDialog" ).dialog({
					autoOpen: false,
					title: "Add a new Event",
					resizable: "false",
					width: "900",
					height: "482",
					modal: "true",
				});
			});
		} else {
			$(function() {
				$( "#addEventDialog" ).dialog({
					autoOpen: false,
					title: "Add a new Event",
					resizable: "false",
					width: "900",
					height: "482",
					show: "puff",
					hide: "puff",
					modal: "true"
				});
			});
		}
		
		// Datepicker
		$('#addEventDate').datetimepicker();

		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);

		$( "#addEventButton" ).click(function() {
			$( "#addEventDialog" ).dialog( "open" );
			$(".ui-widget-overlay").click( function() {
				$('#addEventDialog').dialog("close");
				window.history.back()
			});
			window.history.pushState('add event', 'add event', 'addEvent')
		});

		// FACEBOOK
/*
        (function() {
          	var e = document.createElement('script'); e.async = true;
          	e.src = document.location.protocol +
          	'//connect.facebook.net/en_US/all.js';
          	document.getElementById('fb-root').appendChild(e);
        }());
*/

        /* Add Add Event Gallery to the form */
        $("#addEventGallery").mCustomScrollbar({
			scrollButtons:{
				enable:true
			}
		});
		$(".addEventGalleryPic").click(function(){
			$(".addEventGalleryPic").removeClass("selected");
			$(".addEventGalleryPic").addClass("notSelected");
			$(this).removeClass("notSelected");
			$(this).addClass("selected");
		});
		$('#addEventPlace').typeahead({
			source : function(needle, typeahead) {
				FE.autocompletePlace(needle, typeahead)
			}
		})

		window.localStorage.clear()
		less.env = "development";
		less.watch();


		// Datepicker
		$('#datepicker').datepicker({
			inline: true,
			onSelect: function(dateText, inst) { 
				FE.loadEventsOfDate(dateText, 0)

				if (!$('#datepickerTopColorStrip').hasClass('switched')) {
					$('#datepickerTopColorStrip').addClass('switched');
					$('#datepickerBottomColorStrip').addClass('switched');
				} else {
					$('#datepickerTopColorStrip').removeClass('switched');
					$('#datepickerBottomColorStrip').removeClass('switched');
				}
				
			}
		});

		//hover states on the static widgets
		$('#dialog_link, ul#icons li').hover(
			function() { $(this).addClass('ui-state-hover'); },
			function() { $(this).removeClass('ui-state-hover'); }
		);

	});

	// Add Event AJAX
	//
	function addEventSendAJAX() {
		var $title = $("#addEventTitle")
		var $date = $("#addEventDate")
		var $place = $("#addEventPlace")
		var $category = $("#addEventCategory")
		var $sharewith = $("#addEventShareWith")
		var $description = $("#addEventDescription")

		var selectedPic = $(".addEventGalleryPic.selected img").attr('src').split('/')
		selectedPic = selectedPic[selectedPic.length-2]+'/'+selectedPic[selectedPic.length-1]

		FE.newEvent({
			'eventname' : $title.val(), 
			'eventdate'	: $date.val(), 
			'place' 	: $place.val(),
			'sharewith' : $sharewith.val(),
			'eventdesc'	: $description.val(),
			'category'	: $category.val(),
			'imagename'	: selectedPic
		})

		$title.val('')
		$date.val('')
		$place.val('')
		$sharewith.val('')
		$description.val('')
		$category.val('')
	}

