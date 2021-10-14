<?php
	//开启SESSION
	session_start();
	//判断用户是否登入
	if(empty($_SESSION['name'])){
		header("refresh:0.1,url=./login.php");
		die();
    }
	//连接数据库
	include 'php/conn.php';
	
	//SQL语句 查询stuinfo表所有数据
	$sql = 'SELECT * FROM stuinfo;';
	
	//执行SQL语句
	$result = mysqli_query($link,$sql);
	
	//查询结果  二维枚举数组
	$arr = mysqli_fetch_all($result,MYSQLI_ASSOC);
	
	//查询stuinfo表有多少行数据     共多少人
	$count = count($arr);
	
	//查询男、女生有多少人
	$sex = '';
	for($i = 0; $i < count($arr); $i++){
		$sex .=  $arr[$i]['sex'];
	}
	$man = substr_count($sex,'男');
	$woman = substr_count($sex,'女');
	
	//页码总数
	$pages = ceil($count/10);
	
	//如果$_GET['page']为空则把1赋值给$page  防止第一次进入出问题
	$page = isset($_GET['page'])?$_GET['page']:1;
	//查询起始位置
	$starRow = ($page-1)*10;
	//执行查询SQL语句
	$sql2 = "select  *  from  stuinfo  limit  ".$starRow.",  15;";
	$result2 = mysqli_query($link,$sql2);
	$arr2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
	
	
	//防止从url篡改大于总页码的参数报错
	if(isset($_GET['page'])){
		if($_GET['page'] > $pages){
			die();
		}
	}
	
	
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>学生信息管理平台</title>
	<!-- 引入layui.css框架 -->
	<link rel="stylesheet" href="layui/css/layui.css"/>
	<!-- 引入index.css样式表 -->
	<link rel="stylesheet" href="css/index.css"/>
</head>
<body>
	<table class="layui-table" lay-skin="line"  id="tableExcel">
		<caption style="text-align:center">
			<h2>学生信息管理平台</h2>欢迎您管理员,<?php echo $_SESSION['name'];?>|&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="logout">退出登入</a>
			<div class="btn_left">
				<a>
					共<?php echo $count;?>人
				</a>
				<a>
					男<?php echo $man;?>人
				</a>
				<a>
					女<?php echo $woman;?>人
				</a>
			</div>
			<div class="btn_right">
				<a title="添加学生" class="add_btn" onclick="show(this.getAttribute('title'),'add.php')">
					<i class="layui-icon layui-icon-add-circle-fine"></i> 
				</a>&nbsp;&nbsp;
				<a title="删除学生" class="many_del">
					<i class="layui-icon layui-icon-delete"></i> 
				</a>&nbsp;&nbsp;
				<a title="点击下载" class="download" id="export">
					<i class="layui-icon layui-icon-download-circle"></i> 
				</a>
			</div>
		</caption>
		<thead>
			<tr>
				<th width="20"></th>
				<th>编号</th>
				<th>姓名</th>
				<th>性别</th>
				<th>年龄</th>
				<th>手机号码</th>
				<th>生日</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php for($i = 0; $i < count($arr2); $i++){?>
			<tr> 
				<td class="id"><?php echo $arr2[$i]['id'];?></td>
				<td>
					<form class="layui-form" action="">
						<input type="checkbox" class="checkbox" lay-skin="primary">	
					</form>
				</td>	
				<td><?php echo $i+1;?></td>
				<td><?php echo $arr2[$i]['name'];?></td>
				<td><?php echo $arr2[$i]['sex'];?></td>
				<td><?php echo $arr2[$i]['age'];?></td>
				<td><?php echo $arr2[$i]['phone_number'];?></td>
				<td><?php echo $arr2[$i]['birthday'];?></td>	
				<td>
					<a title="修改" href="javascript:;" onclick="show('修改信息','update.php?id=<?php echo $arr2[$i]['id'];?>')"><i class="layui-icon layui-icon-edit" style="color: #1E9FFF;"></i></a>
					<a title="删除" class="single_del" href="javascript:;"><i class="layui-icon layui-icon-delete" style="color: red;"></i> </a>
				</td>
			</tr> 
		<?php } ?>
		</tbody>
	</table>
	<div id="page" style="margin:0 auto">
		<ul class="pagination">
			<?php
				if($page == 1){
					echo '<li><span>&laquo;</span></li>';
				}else {
					echo "<li><a title='首页' href='./?page=1'>首页</a></li>";
					echo "<li><a title='上一页' href='./?page=".($page-1)."' disabled>&laquo;</a></li>";
				}
				
				if($page<=$pages){
					$start = 1;
					$end = $pages;
				}
				// if($page > $end-2){
				// 	$start = $page - 2;
				// 	$end = $page + 2;
				// }
				// if($page + 3 >= $pages){
				// 	$start = $page - 2;
				// 	$end = $pages;
				// }				
				
				for($i = $start; $i <= $end; $i++){
					echo "<li>";
					if($i==$page){
						echo "<span class='active'>$i</span>";
					}else {
						echo "<a href='?page=$i'>$i</a>";
					}
				}
				
				if($page < $pages){
					echo "<li><a title='下一页' href='./?page=".($page+1)."'>&raquo;</a></li>";
					echo "<li><a title='尾页' href='./?page=".$pages."'>尾页</a></li>";
					
				}else {
					echo '<li><span>&raquo;</span></li>';
				}
			?>
			
			
		</ul>
	</div>
	
	<!-- 引入layui 框架 -->
	<script src="layui/layui.js"></script>
	<!-- 引入弹出层模块 -->
	<script src="js/eject.js"></script>	
	<!-- 引入index。js-->
	<script src="js/index.js"></script>
</body>
</html>