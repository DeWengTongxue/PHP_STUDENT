<?php
	//连接数据库
	$host = 'localhost';
	$user = 'root';
	$pwd = '';
	$link = mysqli_connect($host,$user,$pwd);
	mysqli_set_charset($link,'utf8');
	
	if(!mysqli_select_db($link,'stuinfo')){
		echo "<h2>选择数据库失败</h2>";
		die();
	}
?>