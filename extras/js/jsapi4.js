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

		/*
		$('.event').hover( function() {
			$(this).children('.page1,.page2').animate({top: '-=164'}, 500);
		}, function() {
			$(this).children('.page2,.page1').animate({top: '+=164'}, 500)
		})
		*/

		/*
		$('.event').bind('mouseover', function() {
			$(this).find('.page1,.page2').animate({top: '-=164'},500,function(){});
			console.log('in');
		});

		//Event Animation for show description
		$('.event').bind('mouseout', function() {
			$(this).find('.page1,.page2').animate({top: '+=164'},500,function(){});
			console.log('out');
		});
*/


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

				$( "#addEventButton" ).click(function() {
					$( "#addEventDialog" ).dialog( "open" );
					$(".ui-widget-overlay").click( function(){
						$('#addEventDialog').dialog("close");
					});
					return false;
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
					show: "drop",
					hide: "drop",
					modal: "true"
				});

				$( "#addEventButton" ).click(function() {
					$( "#addEventDialog" ).dialog( "open" );
					$(".ui-widget-overlay").click( function(){
						$('#addEventDialog').dialog("close");
					});
					return false;
				});
			});
		}

        (function() {
          	var e = document.createElement('script'); e.async = true;
          	e.src = document.location.protocol +
          	'//connect.facebook.net/en_US/all.js';
          	document.getElementById('fb-root').appendChild(e);
        }());


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

		less.env = "development";
		less.watch();

	});

	// Add Event AJAX
	//
	function addEventSendAJAX() {
		var title = $("#addEventTitle").val();
		var date = $("#addEventDate").val();
		var place = $("#addEventPlace").val();
		var category = $("#addEventCategory").val();
		var sharewith = $("#addEventShareWith").val();
		var description = $("#addEventDescription").val();

		var selectedPic = $(".addEventGalleryPic.selected img").attr('src').split('/');
		selectedPic = selectedPic[selectedPic.length-2]+'/'+selectedPic[selectedPic.length-1];

		console.log('selectedPic:')
		console.log(selectedPic)
		$("#addEventDescription").val(title+' '+date+' '+place+' '+category+' '+sharewith+' '+selectedPic);

		FE.newEvent({
			'eventname' : title, 
			'eventdate'	: date, 
			'place' 	: place,
			'sharewith' : sharewith,
			'eventdesc'	: description,
			'category'	: category,
			'imagename'	: selectedPic
		})
	}

