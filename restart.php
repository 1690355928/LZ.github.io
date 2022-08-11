
<div id="content">
<div class="edit">
<?php
if($_SESSION["Admin"]>1)
{	
echo "<div class='info'>";
system("\"D:\\Arma 3 server\\killarma3.bat\"",$relval);
echo "重起成功!";
echo "</div>";
}else
{
	echo "<div class='info'>你的权限不够!</div>";
}
?>
</div>
</div>






  
