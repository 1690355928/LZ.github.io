
<div id="content">
<br/>
这里是服务器管理端，欢迎您访问！
<div class="edit">
<?php
if($_SESSION["Admin"]>1)
{	
echo "<br/><h1>谨慎操作！！！<a href=\"index.php?page=55\" style='color:red'>重启</a></h1>";
}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>
</div>






  
