
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pagination</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/pagination/public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/pagination/public/css/style.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h1>Learning Pagination</h1>
			<p>Using PHP and MYSQL</p>
		</div>

<!-- 		<div class="content">
			<p>This is paragraph</p>
		</div>
 -->
	
<?php
	require_once('db.php');

	pagination();
?>
	</div>

	<script type="text/javascript" src="public/js/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
</body>
</html>