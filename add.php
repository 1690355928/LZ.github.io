
<div id="content">
<div class="edit">
<?php

$info=array("id"=>"ID","user"=>"用户名","psw"=>"密码","adminlevel"=>"等级","ip"=>"IP","lasttime"=>"登陆时间");
if($_SESSION["Admin"]>2)
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql="insert into admin (user,psw,adminlevel,ip,lasttime) values (";
		foreach($info as $t=>$tname)
	{
		switch($t)
		{
			case 'user':
				$sql=$sql."'".test_input($_POST[$t])."'";
			break;
			case 'psw':
				$sql=$sql.",'".md5($_POST[$t])."'";
			break;
			case 'adminlevel':
				$sql=$sql.",'".test_input($_POST[$t])."'";
			break;
			
			 
		}
			
	}	
			
	$sql=$sql.",'',now())";

	$result=$conn->query($sql);
	$conn->query("insert into adminlog (user,action) values ('".$_SESSION["User"]."',\"".str_replace("\"","\"\"",$sql)."\")");
		if ($result)
		{			
		echo "<div class='info'>更改成功！</div>";
		}else
		{
			echo "<div class='info'>更新失败！</div>";
		}
		echo "</div></div>";
		die();
	}
	

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");

?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=6&" class="edit" method="post">
<table class="w3-table-all">
 <tr>
	<th>属性名</th>
	<th>内容</th>
 </tr>

<?php
	$row = $result->fetch_assoc();

	foreach($info as $t=>$tname)
	{
		echo "<tr>";
		echo "<td style=\"width:140px;\"><label>".$tname."</label></td>";
		switch($t)
		{
			case "adminlevel":
				echo "<td><select id=\"country\" name=\"adminlevel\">";
					for($x=0;$x<4;$x++)
					{
						echo "<option value=\"".$x."\">".$x."</option>";
						
					}
					echo "</select></td>";
			break;			
			default:
				echo "<td><input class=\"w3-input w3-border\" name=\"".$t."\" value='' type=\"text\"></td>";
		}
		echo "</tr>";
		/*echo @"  <select id=\"country\" name=\"country\">
				<option value=\"usa\">Australia</option>
				<option value=\"usa\">Canada</option>
				<option value=\"usa\">USA</option>
				</select>"
				*/
	}

echo "</table><button  type=\"submit\">更改</button></form>";

}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>
</div>






  
