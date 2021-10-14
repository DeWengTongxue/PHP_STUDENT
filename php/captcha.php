<?php
/*
	图像验证码：
	(1)创建空画布，并分配颜色
	(2)填充背景色
	(3)绘制像素点
	(4)绘制线段
	(5)写入随机TTF字符串
	(6)输出图像，并销毁图像
*/

//(1)创建画布
$width =200;
$height = 80;
$img = imagecreatetruecolor($width,$height);

//(2)填充背景色
$color = imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
imagefill($img,0,0,$color);

//(3)绘制像素点
for($i=1;$i<=50;$i++)
{
	$colorPoint = imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),$colorPoint);
}

//(4)绘制线段
for($i=1;$i<=10;$i++)
{
	$colorLine = imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$colorLine);
}

/* 
	(5)写入字符串
*/
//设置字号大小
$fontNum = 35;
//字号(磅值)转像素值
$fontSize = ($fontNum/72)*96;
//每个字符横轴的范围
$x_range = $width/4;
//字体文件绝对路径
$fontFile = "C:/Windows/Fonts/msyh.ttc";
//设置字符集合
$arr = array_merge(range('a','z'),range(0,9),range('A','Z'));
$str1 = '';
for($i=1;$i<=4;$i++){
	//坐标范围（难点）
	$y = rand($fontSize,$height);
	// 加30像素是为了让前面字符，出现一点点重合，增加辨识难度
	$x = rand(($i-1)*$x_range,$i*$x_range-$fontSize+30);	//难点中的难点
	// 最后字符不加，怕超出范围
	if($i==4){
		$x = rand(($i-1)*$x_range,$width-$fontSize);
	}
	//随机字体颜色
	$fontColor = imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	//随机字符
	$str = $arr[rand(0,count($arr)-1)];
	//imagettftext(图像资源,字号大小,旋转角度,X坐标,Y坐标,颜色,字体文件,字符串)
	imagettftext($img,$fontNum,mt_rand(-15,15),$x,$y,$fontColor,$fontFile,$str);
	$str1 .= $str;
}
session_start();
$_SESSION['captcha'] = $str1;
$str1 = strtolower($str1);
$_SESSION['captcha2'] = $str1;
//(6)输出图像，并销毁图像
header("content-type:image/png");
imagepng($img);
imagedestroy($img);
