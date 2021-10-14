<?php
	
	// 处理退出登录的功能
//  if(isset($_GET['do']) && $_GET['do'] == 'logout'){
//      setCookie("name",'',time() - 3600,"/");
//      setCookie("password",'',time() - 3600,"/");
//      setCookie("isLogin",'',time()-3600,"/");
//      echo '<script>location="../login.php"</script>';
//  }
    session_start();
    //删除Session数据
    unset($_SESSION['name']);
    unset($_SESSION['name']);
	unset($_SESSION['id']);
	unset($_SESSION['student_id']);
    setCookie("PHPSESSID",false);  
    echo '<script>location="../login.php"</script>';
