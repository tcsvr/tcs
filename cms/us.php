<?php
include('include/init.php');


$sql = "SELECT * FROM tv_article WHERE a_id=1";
$us = getOne($sql);

$sus = $us['a_content'];

preg_match_all("/<img\s+src=\"(.+)\"/U", $sus, $matches);


if($_POST){

	// 获取数据
	$a_title = $_POST['a_title'];
	$a_content = $_POST['editorValue'];

	preg_match_all("/<img\s+src=\"(.+)\"/U", $a_content, $submitimg);

	foreach($matches[1] as $v){
		if(!in_array($v, $submitimg[1])){
			
			$delpath = str_replace(_WEB_, _ROOT_, $v);
			unlink($delpath); 

		}
	}

	$sql = "UPDATE tv_article SET `a_title`='{$a_title}',`a_content`='{$a_content}' WHERE a_id=1";

	$bool = mysql_query($sql);
	alert('已保存');

	
}


include('view/us.html');
?>