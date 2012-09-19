	$(document).ready(function() {
		$('.leftButton').bind('mouseover', openSubMenu);
		$('.leftButton').bind('mouseout', closeSubMenu);
		
		function openSubMenu() {
			$(this).find('ul').css('visibility', 'visible');	
		};
		
		function closeSubMenu() {
			$(this).find('ul').css('visibility', 'hidden');	
		};
				   
	});
