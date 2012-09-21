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
					width: "600",
					height: "400",
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
					width: "600",
					height: "400",
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
	});


/*		$('.leftButton').bind('mousein', openSubMenu);
		$('.leftButton').bind('mouseout', closeSubMenu);
		
		function openSubMenu() {
			$(this).find('ul').css('visibility', 'visible');	
		};
		
		function closeSubMenu() {
			$(this).find('ul').css('visibility', 'hidden');	
		};
*/