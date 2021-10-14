<?php
//多条删除
	//连接数据库	
	include 'conn.php';
	
	//接收前端传来的值
	$str = $_GET['ids'];
	
	//SQL语句
	//delete from 表名 where id in (1,3,5)
	$sql = 'delete from stuinfo where id in('.$str.')';
	
	//执行SQL语句
	$result = mysqli_query($link,$sql);
	if(!$result){
		echo '0'; //执行失败
		die();
	}
	echo '1'; //执行成功
?>