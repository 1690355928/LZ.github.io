
<div id="content">
<div class="edit">
<?php

$info=array("id"=>"ID","user"=>"用户名","psw"=>"密码","adminlevel"=>"等级","ip"=>"IP","lasttime"=>"登陆时间");
if($_SESSION["Admin"]>2)
{
	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$sql="delete from whitelist where id='";
		$sql=$sql.test_input($_GET["id"])."'";
	
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
	

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");

}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>
</div>






  
