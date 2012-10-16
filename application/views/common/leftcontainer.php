<div id="leftContainer">

	<a href="/">
	<div class="mainTitle">
		<!--<h1 class="title1">4</h1>
		<h1 class="title2">ERASMUS</h1>-->
		<img src="<?=FULLRESOURCEPATH?>img/logo.png">

		<div id="titleStrip1" class="titleStrip"></div>
		<div id="titleStrip2" class="titleStrip"></div>
		<div id="titleStrip3" class="titleStrip"></div>
		<div id="titleStrip4" class="titleStrip"></div>

	</div>
	</a>

	<div class="bocaRightContainer"><img src="<?=FULLRESOURCEPATH?>img/boca.png"/></div>
	<!--$('.bocaRightContainer').animate({top: $('#datepicker .ui-datepicker').offset()['top']},5000)-->

	<div class="schoolsMenu">
		<a href="/school/1"><p class="schoolsMenuItem">Waterford Institute of Technology</p></a>
		<p class="schoolsMenuItem">Cork Ins. of Technology</p>

	</div>


	<script type="text/javascript">
		$(function(){

			// Datepicker
			$('#datepicker').datepicker({
				inline: true,
				onSelect: function(dateText, inst) { alert(dateText) }
			});

			//hover states on the static widgets
			$('#dialog_link, ul#icons li').hover(
				function() { $(this).addClass('ui-state-hover'); },
				function() { $(this).removeClass('ui-state-hover'); }
			);

		});
	</script>
	
	<div id="datepickerTopColorStrip"></div>
	<div id="datepicker"></div>
	<div id="datepickerBottomColorStrip"></div>

	<div id="europeMap"></div>
	
</div>