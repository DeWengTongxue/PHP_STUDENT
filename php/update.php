<?php
	session_start();
	//连接数据库
	include 'conn.php';
	
	//获取参数id
	@$id = $_SESSION['id'];
	@$student_id = $_SESSION['student_id'];
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$age = $_POST['age'];
	$phone = $_POST['phone'];
	$birthday = $_POST['birthday'];

	// echo $student_id;
	//SQL语句   UPDATE table_name SET field1=new-value1, field2=new-value2
	if($student_id){
		// echo '我是'.$student_id;
		$sql = "update stuinfo set sex = '$sex',age = $age,phone_number = $phone,birthday = '$birthday' where student_id = '$student_id' ";
	}else{
		// echo '我是id'.$id.'<br>';
		$sql = "update stuinfo set sex = '$sex',age = $age,phone_number = $phone,birthday = '$birthday' where id = '$id' ";
	}
	//执行sql语句
	$result = mysqli_query($link,$sql);	
	if(!$result){
		echo '0'; //执行失败
		die();
	}else {
		echo '1'; //执行成功
	}

?>