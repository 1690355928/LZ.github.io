<?php
$start=0;
$limit=20;
$page=0;

if(isset($_GET['p']))
	
{
$page=$_GET['p'];
$start=($page-1)*$limit;
}
$condition="";
$keyword="";
if (isset($_REQUEST['keyword'])&& $_REQUEST['keyword']!="")	
{
$keyword=test_input($_REQUEST['keyword']);
$condition="where playerid like '%".$keyword."%' or playername like '%".$keyword."%' or action like '%".$keyword."%'";

}
?>

<div id="content">
<div class="search">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=2" method="post">
  <input type="text" id="keyword" name="keyword" value='<?php echo $keyword ?>'>  
  <button  type="submit">搜索</button>
</form>
</div>

<?php
$ElstpRun = $conn->query("set names 'utf8'");//执行前设置编码
$result=$conn->query("SELECT * FROM keylog ".$condition." order by id DESC LIMIT $start, $limit");

//$info=array("playerid","name","cash","bankacc","adminlevel","donatorlvl","coplevel","civ_talents","lastupdated");
$info=array("id","playerid","playername","action","actionid","instanceid","time");
if(($result->num_rows) > 0)
{
	?>

<table class="w3-table-all">
 <tr>
	<th>记录ID</th>
	<th>用户ID</th>
	<th>用户名</th>
	<th>内容</th>
	<th>动作ID</th>
	<th>服务器编号</th>
	<th>更新时间</th>
 </tr>

<?php
while(($row = $result->fetch_assoc()))
{
	echo "<tr>";
	foreach($info as $t)
	{
			echo "<td>".$row[$t]."</td>";
	}
	echo "</tr>";
}
echo "</table>";
}
else
{
	echo "结果为空";
}
$result=$conn->query("select count(*) as num from log ".$condition);
$row=$result->fetch_assoc();
$rows=$row["num"];
$total=ceil($rows/$limit);
$url="?page=2&keyword=".$keyword;
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