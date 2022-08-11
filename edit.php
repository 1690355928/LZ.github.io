
<div id="content">
<div class="edit">
<?php
$uid=0;
if(isset($_GET['uid']))
	
{
$uid=test_input($_GET['uid']);
}
$pinfo=array("cash"=>"现金","bankacc"=>"银行存款","worldSpace"=>"坐标","aliases"=>"最初姓名","gang1"=>"帮派ID");
$ginfo=array("adminlevel"=>"管理等级","coplevel"=>"警察等级","swatlevel"=>"特警等级","wealth"=>"声望","lootrewards"=>"宝箱物品","honor"=>"赏金荣誉","keys"=>"钥匙");
if($_SESSION["Admin"]>2)
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql="update players set";
		foreach($pinfo as $t=>$tname)
	{
		switch($t){
			case "cash":
				$sql=$sql." `".$t."`='".$_POST[$t]."'";
			break;
			default:
				$sql=$sql.", `".$t."`='".$_POST[$t]."'";
		}
		
	}
	
			$sql2="update players_global set";
		foreach($ginfo as $t=>$tname)
	{
		switch($t){
			case "adminlevel":
				$sql2=$sql2." `".$t."`='".$_POST[$t]."'";
			break;
			default:
				$sql2=$sql2.", `".$t."`='".$_POST[$t]."'";
		}		
	}
	$sql=$sql." where playerid='".$_POST["playerid"]."'";
	$sql2=$sql2." where playerid='".$_POST["playerid"]."'";
	$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
	$result=$conn->query($sql);
	$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
	$result2=$conn->query($sql2);
	$conn->query("insert into adminlog (user,action) values ('".$_SESSION["User"]."',\"".str_replace("\"","\"\"",$sql.$sql2)."\")");
		if ($result&&$result2)
		{			
		echo "<div class='info'>更改成功！</div>";
		}else
		{
			echo "<div class='info'>更新失败！</div>";
		}
		echo "</div></div>";
		die();
	}
	
$condition=" AND p.uid='".$uid."'";
$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
$result=$conn->query("SELECT p.playerid, p.name, p.cash, p.bankacc, p.aliases, p.civ_licenses, p.arrested, g.adminlevel, g.donatorlvl,g.coplevel,g.swatlevel, p.cop_licenses, p.cop_gear, p.civ_gear, p.worldSpace, p.alive, p.civ_inventory, p.damage, p.thirst, p.hunger, p.prestige, p.instance, TIME_TO_SEC(TIMEDIFF(NOW(), p.`lastupdated`)) as time,  p.`lastupdated` ,  p.gang1, p.gangrank1, p.civ_talents, p.civ_exp, p.pain, p.broken, p.drugs, g.wealth, g.achievements, g.stats, p.title, p.revive, p.customtexture, p.parole, g.mailbox, g.honor, g.honortalents, g.keys, g.lootrewards FROM players as p, players_global as g WHERE p.playerid=g.playerid".$condition);

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");
$info=array("playerid"=>"用户ID","name"=>"用户名","cash"=>"现金","bankacc"=>"银行存款","adminlevel"=>"管理等级","donatorlvl"=>"赞助等级","coplevel"=>"警察等级","swatlevel"=>"特警等级","lootrewards"=>"宝箱物品","keys"=>"钥匙","worldSpace"=>"坐标","aliases"=>"最初姓名","wealth"=>"声望","honor"=>"赏金荣誉","gang1"=>"帮派ID","lastupdated"=>"最后更新时间");
if(($result->num_rows) > 0)
{
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=11&uid=<?php echo $uid ?>" class="edit" method="post">
<input name="uid" value="<?php echo $uid?>" type="text" style="display: none;">
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
						if($row[$t]==$x)
						{
							echo "<option value=\"".$x."\" selected>".$x."</option>";
						}else
						{
							echo "<option value=\"".$x."\">".$x."</option>";
						}
					}
					echo "</select></td>";
			break;
			case "coplevel":
				echo "<td><select id=\"coplevel\" name=\"coplevel\">";
					for($x=0;$x<10;$x++)
					{
						if($row[$t]==$x)
						{
							echo "<option value=\"".$x."\" selected>".$x."</option>";
						}else
						{
							echo "<option value=\"".$x."\">".$x."</option>";
						}
					}
					echo "</select></td>";
			break;
			case "donatorlvl":
				echo "<td><select id=\"donatorlvl\" name=\"donatorlvl\">";
					for($x=0;$x<11;$x++)
					{
						if($row[$t]==$x)
						{
							echo "<option value=\"".$x."\" selected>".$x."</option>";
						}else
						{
							echo "<option value=\"".$x."\">".$x."</option>";
						}
					}
					echo "</select></td>";
			break;
			case "swatlevel":
				echo "<td><select id=\"swatlevel\" name=\"swatlevel\">";
					for($x=0;$x<7;$x++)
					{
						if($row[$t]==$x)
						{
							echo "<option value=\"".$x."\" selected>".$x."</option>";
						}else
						{
							echo "<option value=\"".$x."\">".$x."</option>";
						}
					}
					echo "</select></td>";
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






  
