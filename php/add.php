<?php
	include 'conn.php';
	session_start();
	//获取前端的值
	@$username = $_SESSION['name'];
	
	@$administrator = $_POST['administrator'];
	if($administrator == '0'){
		$username = $_POST['userid'];
		$password = $_POST['password'];
		$administrator = $_POST['administrator'];
		
		$_SESSION['name'] = $username;
		$_SESSION['administrator'] = $administrator;
		$sql = 'select user from admin';
		$result = mysqli_query($link,$sql);
		$arr = mysqli_fetch_array($result);
		for($i = 0; $i < count($arr); $i++){
			$bool = true;
			if($username == $arr['user']){
				$bool = false;
				echo "0";//插入失败
				break;
			}else{
				continue;
			}
		}
		if($bool){
			$sql = "insert into admin(id, user, password, administrator) values (null, '$username', '$password', '$administrator')";
			$result = mysqli_query($link,$sql);
			if (!$result){
				echo '0';//插入失败
				die();
			}else{
				echo '1';//插入成功
			}
		}
	}else{
		$name = $_POST['name'];
		$sex = $_POST['sex'];
		$age = $_POST['age'];
		$phone = $_POST['phone'];
		$date = $_POST['birthday'];
		
		$sql = "select id from admin where user = '$username'";
		$result = mysqli_query($link,$sql);
		if (!$result) {
		        printf("Error: %s\n", mysqli_error($link));
		}
		$arr = mysqli_fetch_array($result);
		$whos_user = $arr['id'];
		$sql = "insert into stuinfo(name,sex,age,phone_number,birthday,student_id) values ('$name','$sex',$age,$phone,'$date',$whos_user)";
		$result = mysqli_query($link,$sql);
		if (!$result){
			echo '0';//插入失败
			die();
		}else{
			if($_SESSION['administrator'] == '0'){
				unset($_SESSION['name']);
				unset($_SESSION['id']);
				unset($_SESSION['student_id']);
				echo '2'; //普通用户新插入成员
			}else{
				echo '1';//插入成功
			}
		}
	}
		
?>