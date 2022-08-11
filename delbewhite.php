
<div id="content">
<div class="edit">
<?php
$id=0;
if(isset($_GET['id']))
	
{
$id=test_input($_GET['id']);
}
$info=array("playerid"=>"用户ID","name"=>"白名单姓名","nowname"=>"当前姓名","side"=>"类型","deadline"=>"有效期","createtime"=>"添加时间");
$side=array("cop"=>"警察","med"=>"医生","hunter"=>"赏金");
if($_SESSION["Admin"]>2)
{
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$sql="delete from bewhitelist.whitelist";
		
	$sql=$sql." where id='".$_GET["id"]."'";
	$result=$conn->query($sql);
	$conn->query("insert into adminlog (user,action) values ('".$_SESSION["User"]."',\"".str_replace("\"","\"\"",$sql)."\")");
		if ($result)
		{			
		echo "<div class='info'>删除成功！</div>";
		}else
		{
			echo "<div class='info'>删除失败！</div>";
		}
		echo "</div></div>";
		die();
	}	
}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>
</div>






  
