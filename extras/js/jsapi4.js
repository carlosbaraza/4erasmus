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
				return false;
			});
		});
				   
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