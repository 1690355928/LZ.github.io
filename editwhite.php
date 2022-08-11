
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
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql="update whitelist set";
		foreach($info as $t=>$tname)
	{
		switch($t){
			case "playerid":
				$sql=$sql." `".$t."`='".$_POST[$t]."'";
			break;
			case "nowname":
			break;
			case "createtime":
			break;
			default:
				$sql=$sql.", `".$t."`='".$_POST[$t]."'";
		}
		
	}			
	$sql=$sql." where id='".$_POST["id"]."'";
	$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
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
	
$condition=" AND w.id='".$id."'";
$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
$result=$conn->query("select w.side,w.id,w.deadline,w.createtime,w.playerid,w.name,p.name as nowname from whitelist as w,players as p WHERE w.playerid=p.playerid".$condition);

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");

if(($result->num_rows) > 0)
{
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=12&id=<?php echo $id ?>" class="edit" method="post">
<input name="id" value="<?php echo $id?>" type="text" style="display: none;">
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
			case "side":
				echo "<td><select id=\"".$t."\" name=\"".$t."\">";
					foreach($side as $sidestring=>$siderole)
					{
						if($row[$t]==$sidestring)
						{
							echo "<option value=\"".$sidestring."\" selected>".$siderole."</option>";
						}else
						{
							echo "<option value=\"".$sidestring."\">".$siderole."</option>";
						}
					}
					echo "</select></td>";
			break;
			case "nowname":
				echo "<td><input class=\"w3-input w3-border\" name=\"".$t."\" value='".$row[$t]."' type=\"text\" readonly></td>";
			break;
			default:
				echo "<td><input class=\"w3-input w3-border\" name=\"".$t."\" value='".$row[$t]."' type=\"text\"></td>";
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
echo "<div><a href=\"index.php?page=16&id=".$id."\">删除</a></div>";
}
else
{
	echo "<div class='info'>未找到相应记录</div>";
}
}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>
</div>






  
