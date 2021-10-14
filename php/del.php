<?php
	include 'conn.php';
	$id = $_GET['id'];
	$sql = 'Delete from stuinfo where id='.$id.'';
	if(!mysqli_query($link,$sql)){
		echo "1"; //删除失败
		die();
	}else {
		echo '2'; //删除成功
	}
?>