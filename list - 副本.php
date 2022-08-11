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
$condition=" and( p.playerid like '%".$keyword."%' or p.name like '%".$keyword."%')";

}
?>

<div id="content">
<div class="search">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=1" method="post" >
    <input type="text" id="keyword" name="keyword" value='<?php echo $keyword ?>'>   
  <button  type="submit">搜索</button>
</form>
</div>

<?php
$result=$conn->query("SELECT p.uid, p.playerid, p.name, p.cash, p.bankacc, p.civ_licenses, p.arrested, g.adminlevel, g.donatorlvl,g.coplevel, p.cop_licenses, p.cop_gear, p.civ_gear, p.worldSpace, p.alive, p.civ_inventory, p.damage, p.thirst, p.hunger, p.instance, TIME_TO_SEC(TIMEDIFF(NOW(), p.`lastupdated`)) as time,  p.`lastupdated` ,  p.gang1, p.gangrank1, p.civ_talents, p.civ_exp, p.pain, p.broken, p.drugs, g.wealth, g.achievements, g.stats, p.title, p.revive, p.customtexture, p.parole, g.mailbox, g.honor, g.honortalents, g.keys, g.lootrewards FROM players as p, players_global as g WHERE p.playerid=g.playerid".$condition." LIMIT ".$start.", ".$limit);

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");
$info=array("playerid"=>"用户ID","name"=>"游戏名","cash"=>"现金","bankacc"=>"银行存款","adminlevel"=>"管理等级","donatorlvl"=>"赞助等级","coplevel"=>"警察等级","lootrewards"=>"宝箱物品","keys"=>"钥匙","lastupdated"=>"更新时间");
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
		if($t=="playerid"){
			echo "<td><a href='?page=11&uid=".$row["uid"]."'>".$row[$t]."</a></td>";
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
$result=$conn->query("select count(*) as num from players as p, players_global as g WHERE p.playerid=g.playerid".$condition);
$row=$result->fetch_assoc();
$rows=$row["num"];
$total=ceil($rows/$limit);
$url="?page=1&keyword=".$keyword;
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