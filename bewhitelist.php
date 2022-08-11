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
if (isset($_REQUEST['keyword'])&& $_REQUEST['keyword']!="")	
{
$keyword=test_input($_REQUEST['keyword']);
$condition=" where (w.playerid like '%".$keyword."%' or p.name like '%".$keyword."%')";

}
?>

<div id="content">
<div class="search">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=17" method="post" >
    <input type="text" id="keyword" name="keyword" value='<?php echo $keyword;?>'>  
  <button  type="submit">搜索</button>
</form>
</div>

<?php

$result=$conn->query("SELECT w.id,w.createtime,w.playerid,p.name as nowname from bewhitelist.whitelist as w left join players as p on w.playerid=p.playerid".$condition." LIMIT $start, $limit");

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");
$info=array("playerid"=>"用户ID","nowname"=>"当前姓名","createtime"=>"添加时间","delete"=>"删除");
$side=array("cop"=>"警察","med"=>"医生","hunter"=>"赏金");
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
		switch($t){
			case "playerid":
				echo "<td><a href='?page=12&id=".$row["id"]."'>".$row[$t]."</a></td>";
			break;
			case "side":
				if(array_key_exists($row[$t],$side))
				{
					echo "<td>".$side[$row[$t]]."</td>";
				}else
				{
					echo "<td>".$row[$t]."</td>";
				}
			break;
			case "delete":
				echo "<td><a href='?page=19&id=".$row["id"]."'>删除</a></td>";
			break;
			default:
				echo "<td>".$row[$t]."</td>";
		}					
	}
	echo "</tr></a>";
}
echo "</table>";
}
else
{
	echo "结果为空";
}
$result=$conn->query("select count(*) as num from bewhitelist.whitelist as w left join players as p on w.playerid=p.playerid".$condition);
$row=$result->fetch_assoc();
$rows=$row["num"];
$total=ceil($rows/$limit);
$url="?page=17&keyword=".$keyword;
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