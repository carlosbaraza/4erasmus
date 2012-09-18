<html>
<head>
	<title><?php echo $title;?></title>
</head>

<body>
	<h1>Welcome to Outtimed</h1>

	<?php
		foreach ($results as $key => $value) {
			echo $value->id.' ';
			echo $value->name.'<br>';
		}
	?>

</body>
</html>