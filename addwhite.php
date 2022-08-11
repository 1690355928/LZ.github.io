
<div id="content">
<div class="edit">
<?php

$info=array("playerid"=>"用户ID","name"=>"白名单姓名","nowname"=>"当前姓名","side"=>"类型","deadline"=>"有效期","createtime"=>"添加时间");
$side=array("cop"=>"警察","med"=>"医生","hunter"=>"赏金");
if($_SESSION["Admin"]>1)
{
	if($_SESSION["Admin"]<3) {$side=array("cop"=>"警察");}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql="insert into whitelist (playerid,name,side,deadline) values(";
		foreach($info as $t=>$tname)
	{
		switch($t){
			case "playerid":
				$sql=$sql."'".test_input($_POST[$t])."'";
			break;
			case "nowname":
			break;
			case "createtime":
			break;
			default:
				$sql=$sql.",'".test_input($_POST[$t])."'";
		}
		
	}			
	$sql=$sql.")";
	$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
	$result=$conn->query($sql);
	$conn->query("insert into adminlog (user,action) values ('".$_SESSION["User"]."',\"".str_replace("\"","\"\"",$sql)."\")");
		if ($result)
		{			
		echo "<div class='info'>添加成功！</div>";
		}else
		{
			echo "<div class='info'>添加失败！</div>";
		}
		echo "</div></div>";
		die();
	}
	


//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");

?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=13" class="edit" method="post">
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
		
		switch($t)
		{
			case "side":
				echo "<td style=\"width:140px;\"><label>".$tname."</label></td>";
				echo "<td><select id=\"".$t."\" name=\"".$t."\">";
					foreach($side as $sidestring=>$siderole)
					{
						echo "<option value=\"".$sidestring."\">".$siderole."</option>";						
					}
					echo "</select></td>";
			break;
			case "nowname":				
			break;
			case "createtime":				
			break;
			case "deadline":	
				echo "<td style=\"width:140px;\"><label>".$tname."</label></td>";
				date_default_timezone_set("Asia/Shanghai");
				echo "<td><input class=\"w3-input w3-border\" name=\"".$t."\" value='".date("Y-m-d h:i:s")."' type=\"text\"></td>";			
			break;
			default:
				echo "<td style=\"width:140px;\"><label>".$tname."</label></td>";
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


echo "</table><button  type=\"submit\">添加</button></form>";
}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>
</div>






  
