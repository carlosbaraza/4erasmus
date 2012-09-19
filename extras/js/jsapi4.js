	$(document).ready(function() {
		$('.leftButton').bind('click', openSubMenu);
				
		function openSubMenu() {
			$(this).find('ul').css('visibility', 'visible');	
		};

		$('html').click(function() {
		 	$('.leftButton').find('ul').css('visibility', 'hidden');	
		});

		$('.leftButton').click(function(event){
		    event.stopPropagation();
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