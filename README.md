# 学生信息管理系统

#### 介绍

​		学生信息管理是高校管理的一项重要工作，而良好的学 生信息管理系统则是整个学生信息管理工作质量和效率的重要保证。实现的系统包括添加学生信息、删除学生信息、修改学生信息、查询学生信息、下载学生信息模块。

​		系统采用 B/S 模式，对学生信息的添加、修改、删除、查询、浏览、信息录入等操作。为了实现数据的安全与保密性要求，针对不同的用户具有不同的访问权限控制。 

#### 技术栈
```
layui、jQuery、PHP、HTML、CSS、JavaScript、Ajax
```


#### 安装教程

1. 把项目放置服务器网站根目录下，如： 放置在www目录

2. 把项目根目录下的stuinfo.sql文件导入到MySQL数据库中

3. 修改项目中的conn.php文件，如自身环境配置和文件中一致则忽略本步骤，文件所在位置/php/conn.php

   ```php
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
   ```

4. 打开浏览器在地址栏输入[http://localhost/stuinfo/](http://localhost:80/stuinfo/)，默认端口是80可以忽略，如果链接打不开首先检查步骤1和步骤2是否操作，另外检查80端口是否被其他程序占用，如果被占用需要修改PHP study的端口号

5. 到此为止，项目可以正常运行了

#### 使用说明

1.  请勿轻易删除项目根目录下的文件，**数据无价谨慎操作**
2.  后端PHP接口放置在项目根目录php文件夹中
3.  访问[http://localhost/stuinfo/](http://localhost:80/stuinfo/)默认是读取项目根目录中的index.php文件

#### 总结


2. 这个项目是我第一次前后端配合搭建，让我懂得前后端交互的方式及原理

   > (1)通过表单
   >
   > a.前端HTML页面设置form表单，确定需要传递的参数name让用户输入，通过点击按钮后submit()提交到后台 。
   >
   > b.后台对前端请求的反应，接收数据，处理数据以及返回数据。 
   >
   > (2) 通过Ajax
   >
   > a. Ajax是专门做异步请求，在本项目中用的都是Ajax提交数据交给后端处理；
   >
   > b.发送给后端，后端做出处理响应返回给前端，前端根据返回值做出不同处理

