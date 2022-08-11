
<div id="content">
<div class="edit">
<?php

$info=array("cmd"=>"命令类型","content"=>"内容");
$cmd=array("1"=>"30分钟重启","2"=>"立即重启","3"=>"发送管理员公告","4"=>"立即保存玩家数据和车辆信息");
if($_SESSION["Admin"]>2)
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql="insert into asylumlife1.command (`cmd`,`content`) values (";
		foreach($info as $t=>$tname)
	{
		switch($t)
		{
			case 'cmd':
				$sql=$sql."'".test_input($_POST[$t])."'";
			break;
			case 'content':
				$sql=$sql.",'".test_input($_POST[$t])."'";
			break;			
			 
		}
			
	}	
			
	$sql=$sql.")";
	$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
	$result=$conn->query($sql);
	$conn->query("insert into adminlog (user,action) values ('".$_SESSION["User"]."',\"".$cmd[$_POST["cmd"]].":".$_POST["content"]."\")");
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=20&charset:utf8" class="edit" method="post">
<table class="w3-table-all">
 <tr>
	<th>属性名</th>
	<th>内容</th>
 </tr>

<?php
	
	foreach($info as $t=>$tname)
	{
		echo "<tr>";
		echo "<td style=\"width:140px;\"><label>".$tname."</label></td>";
		switch($t)
		{
			case "cmd":
				echo "<td><select id=\"".$t."\" name=\"".$t."\">";
					foreach($cmd as $val=>$str)
					{
						echo "<option value=\"".$val."\">".$str."</option>";						
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

echo "</table><button  type=\"submit\">添加</button></form>";

}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>

<?php
$start=0;
$limit=20;
$page=0;

if(isset($_GET['p']))
	
{
$page=test_input($_GET['p']);
$start=($page-1)*$limit;
}

$condition="";
$keyword="";
/*
if (isset($_REQUEST['keyword'])&& $_REQUEST['keyword']!="")	
{
$keyword=test_input($_REQUEST['keyword']);
$condition=" and( p.playerid like '%".$keyword."%' or p.name like '%".$keyword."%')";

}
?>

<div class="search">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=1" method="post" >
    <input type="text" id="keyword" name="keyword" value='<?php echo $keyword ?>'>   
  <button  type="submit">搜索</button>
</form>
</div>

<?php
*/
$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
$result=$conn->query("SELECT `cmd`,`content`,`done`,`createtime` from asylumlife1.command order by createtime DESC LIMIT ".$start.", ".$limit);

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");
$info=array("cmd"=>"命令类型","content"=>"内容","done"=>"执行情况","createtime"=>"创建时间");
if(($result->num_rows) > 0)
{
	?>

<table class="w3-table-all">
 <tr>
	<?php 
	foreach($info as $t=>$tinfo)
	{		
		echo "<th>".$tinfo."</th>";
	}
	?>
 </tr>

<?php
while(($row = $result->fetch_assoc()))
{
	echo "<tr>";
	foreach($info as $t=>$tinfo)
	{
		if($t=="cmd"){
			if(array_key_exists($row[$t],$cmd))
				{
					echo "<td>".$cmd[$row[$t]]."</td>";
				}else
				{
					echo "<td>".$row[$t]."</td>";
				}
		}else{
			echo "<td>".$row[$t]."</td>";
		}			
	}
	echo "</tr></a>";
}
echo "</table>";
}
else
{
	echo "<div class='info'>结果为空</div>";
}
$result=$conn->query("select count(*) as num from asylumlife1.command order by createtime DESC");
$row=$result->fetch_assoc();
$rows=$row["num"];
$total=ceil($rows/$limit);
$url="?page=20&keyword=".$keyword;
echo "<div class='pageboot'>";
echo "<ul class='pagination'>";
if($page>3)
{
echo "<li><a href='".$url."&p=1'> << </a></li>";
}
$ps=$page-3;
$pe=$page+3;
if($ps<1) 
{
	$ps=1;
	$pe=$ps+6;
}
if($pe>$total)
{
	$pe=$total;
	$ps=$pe-6;
	if($ps<1) {$ps=1;}
}

for($i=$ps;$i<=$pe;$i++)
{
if($i==$page) { echo "<li><a class='active' href=''>".$i."</a></li>"; }

else { echo "<li><a href='".$url."&p=".$i."'>".$i."</a></li>"; }
}
if($page+3<$total)
{
echo "<li><a href='".$url."&p=".$total."'> >> </a></li>";
}
?>
</ul>
<p>共<?php echo $total;?>页<input type="text" id="page"> <button  type="submit" onclick="GoTo()">跳转</button></p>
<script>
function GoTo(){
 var PageNo=document.getElementById("page").value;
 var url = "";
 url = "<?php echo $url ?>&p="+PageNo;
window.open(url, '_self')
}
</script>
</div>
</div>




  
