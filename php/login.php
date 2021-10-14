<?php
	//登入
	/* 
		查询，的结果不存在，但是也会得到一个，值为0的对象，该对象转换成布尔型是真
	*/
	
	//连接数据库
	include 'conn.php';
	
	//接收前端传来的值
	$user = $_POST['name'];
	$pwd = $_POST['password'];
	$captcha = $_POST['captcha'];
	$administrator = $_POST['administrator'];
	session_start();
	//SQL语句
	$sql = 'select * from admin where user="'.$user.'"';
	
	//执行SQL语句
	$result = mysqli_query($link,$sql);
	
	//取出一行数据
	$arr = mysqli_fetch_assoc($result);
	
	if(!$arr){
		echo '0'; //账号不存在
		die();
	}
	if($user == $arr['user']){
		if($pwd == $arr['password']){
			//密码正确
//          setCookie("name",$user,$time,"/");//..设置COOKIE
//          setCookie("password",$pwd,$time,"/");//..设置一个用户名COOKIE
//          setCookie("isLogin",1,$time,"/");//..设置一个登录判断的标记isLogin    
			if($captcha == $_SESSION['captcha'] || $captcha == $_SESSION['captcha2']){
				if($administrator == $arr['administrator'] && $administrator == '0'){
					echo '3';
					
					$_SESSION['name'] = $user;
					$_SESSION['password'] = $pwd;
					$_SESSION['administrator'] = $administrator;
					$_SESSION['student_id'] = $arr['id'];
				}else if($administrator == $arr['administrator'] && $administrator == '1'){
					echo '4';
					
					$_SESSION['name'] = $user;
					$_SESSION['password'] = $pwd;
					$_SESSION['administrator'] = $administrator;
				}else{
					echo '7';
				}
			}else {
				echo '6'; //验证码错误
			}
		} else {
			echo '5'; //密码错误
		}
	} 
?>