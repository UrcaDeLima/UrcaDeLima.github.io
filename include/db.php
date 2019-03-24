<?php 
	require 'config.php';
	$connection = mysqli_connect(
		$config['db']['server'],
		$config['db']['login'],
		$config['db']['password'],
		$config['db']['name']
	);
	if($connection == 0){
		echo 'База данных не подключилась!<br>';
		echo mysql_connect_error();
		exit();
	}
?>