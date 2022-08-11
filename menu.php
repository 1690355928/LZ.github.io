
<?php

/*
<div class='menu'>
<ul>
  <li><a href="index.php">首页</a></li>
  <li><a class="active" href="index.php?page=1">玩家列表</a></li>
  <li><a href="index.php?page=2">日志</a></li>
  <li><a href="index.php?page=3">警局管理</a></li>
  <li><a href="index.php?page=5">白名单管理</a></li>
  <li><a href="index.php?page=4">当前在线玩家：<?php echo $onlinenum ?></a></li>
  <li style="float:right"><a href="index.php?page=9">About</a></li>
</ul>
</div>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Dropdown</a>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </li>
*/

/*                                                                                        "17"=>"白名单管理",                            */
 $menu=array("1"=>"玩家列表","2"=>"日志","7"=>"充值记录","3"=>"警局管理","4"=>"职业白名单管理","5"=>"当前在线玩家：","20"=>"高级") ;
if(!empty($_GET["page"]))
{
	$cur=$_GET["page"];	
}else{
	$cur=0;
}
?>
<div class='menu'>
<ul>
  <li><a href="index.php">首页</a></li>
	<?php 
	foreach($menu as $t=>$tinfo)
	{	
		switch ($t)
		{
			case "5":
				if($cur==$t){
						echo "<li><a class=\"active\" href=\"index.php?page=".$t."\">".$tinfo.$onlinenum."</a></li>";
					}else
					{
						echo "<li><a href=\"index.php?page=".$t."\">".$tinfo.$onlinenum."</a></li>";
					}
				break;
			case "4":
				if($cur==$t){
						echo "  <li class=\"dropdown\" id=\"active\">
									<a href=\"javascript:void(0)\" class=\"dropbtn\">".$tinfo."</a>
									<div class=\"dropdown-content\">
									  <a href=\"index.php?page=".$t."\">".$tinfo."</a>
									  <a href=\"index.php?page=13\">添加白名单</a>									  
									</div>
								  </li>";
					}else
					{
						echo "  <li class=\"dropdown\">
									<a href=\"javascript:void(0)\" class=\"dropbtn\">".$tinfo."</a>
									<div class=\"dropdown-content\">
									  <a href=\"index.php?page=".$t."\">".$tinfo."</a>
									  <a href=\"index.php?page=13\">添加白名单</a>									  
									</div>
								  </li>";
					}
				break;
				case "17":
				if($cur==$t){
						echo "  <li class=\"dropdown\" id=\"active\">
									<a href=\"javascript:void(0)\" class=\"dropbtn\">".$tinfo."</a>
									<div class=\"dropdown-content\">
									  <a href=\"index.php?page=".$t."\">".$tinfo."</a>
									  <a href=\"index.php?page=18\">添加白名单</a>									  
									</div>
								  </li>";
					}else
					{
						echo "  <li class=\"dropdown\">
									<a href=\"javascript:void(0)\" class=\"dropbtn\">".$tinfo."</a>
									<div class=\"dropdown-content\">
									  <a href=\"index.php?page=".$t."\">".$tinfo."</a>
									  <a href=\"index.php?page=18\">添加白名单</a>									  
									</div>
								  </li>";
					}
				break;
				case "20":
				if($cur==$t){
						echo "  <li class=\"dropdown\" id=\"active\">
									<a href=\"javascript:void(0)\" class=\"dropbtn\">".$tinfo."</a>
									<div class=\"dropdown-content\">
									  <a href=\"index.php?page=".$t."\">".$tinfo."</a>
									  <a href=\"index.php?page=6\">添加账户</a>									  
									</div>
								  </li>";
					}else
					{
						echo "  <li class=\"dropdown\">
									<a href=\"javascript:void(0)\" class=\"dropbtn\">".$tinfo."</a>
									<div class=\"dropdown-content\">
									  <a href=\"index.php?page=".$t."\">".$tinfo."</a>
									  <a href=\"index.php?page=6\">添加账户</a>									  
									</div>
								  </li>";
					}
				break;
			default:
				if($cur==$t){
						echo "<li><a class=\"active\" href=\"index.php?page=".$t."\">".$tinfo."</a></li>";
					}else
					{
						echo "<li><a href=\"index.php?page=".$t."\">".$tinfo."</a></li>";
					}
		}		
	}
	?>
  <li style="float:right"><a  href="index.php?page=9">About</a></li>
</ul>
</div>