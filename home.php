<?php include ('server.php');

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>User registration System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>



<div>
	
	<?php if (isset($_SESSION['username'])): ?>
		<?php include_once('header.php'); ?>
		<?php include_once('welcome.php'); ?>
	<?php endif ?>

</div>

</body>
</html>
<html>
