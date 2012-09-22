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
        window.fbAsyncInit = function() {
	        FB.init({
	          appId: '529250917090161',
	          cookie: true,
	          xfbml: true,
	          oauth: true
	        });
	        FB.Event.subscribe('auth.login', function(response) {
	          window.location.reload();
	        });
	        FB.Event.subscribe('auth.logout', function(response) {
	          window.location.reload();
	        });
	        FB.api('/<?=$fbid?>/?fields=picture.width(34).height(34)&access_token=AAAHhWdTpA3EBAOSbW67NjsAGh92UXnk0ZBpAnWCslFmFScGRaKn1a5fZBhYxRn9rMDjcsXLiaTKsfTFLq70kFdUt7T3MX6B41jiLtK1AZDZD', function(response) { 
	        	console.log(response)
	        	$('#loginBar p').prepend('<img src="'+ response.picture.data.url +'">')
			});
        };


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




	});

	// Add Event AJAX
	//
	function addEventSendAJAX() {
		var title = $("#addEventTitle").val();
		var date = $("#addEventDate").val();
		var place = $("#addEventPlace").val();
		var description = $("#addEventDescription").val();
		var category = $("#addEventCategory").val();
		var sharewith = $("#addEventShareWith").val();

		var selectedPic = $(".addEventGalleryPic.selected img").attr('src').split('/');
		selectedPic = selectedPic[selectedPic.length-2]+'/'+selectedPic[selectedPic.length-1];

		$("#addEventDescription").val(title+' '+date+' '+place+' '+category+' '+sharewith+' '+selectedPic);
	}

