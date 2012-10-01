<div id="loginBar">
			
	<div id="fb-root"></div>
	<?php if( !isset($username)) { ?>
		<p><fb:login-button></fb:login-button></p>
	<?php } else { 
			echo '<p><strong>'.$username.'</strong> at <strong>Waterford Institute of Technology</strong> ▼</p>';
		  }
	?>
	<div id="loginForm"></div>

</div>