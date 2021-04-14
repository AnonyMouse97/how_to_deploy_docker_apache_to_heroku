<?php 

require('vendor/autoload.php');

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Apache 2</title>
</head>
<body>
	<h1>Hello Jepsens 4.27</h1>
</body>
</html>