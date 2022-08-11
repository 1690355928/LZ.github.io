<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<title>Arma3管理端</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/w3.css">
<link rel="stylesheet" href="./css/my.css">
<body>
<?php	include 'conn.php';	?>
<div class="main">
<div class="banner"></div>
<?php
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
  $sql="select count(DISTINCT playerid) as num from online";
  $result=$conn->query($sql);
	if($result->num_rows >0){
		//write to session
		$row=$result->fetch_assoc();
		$onlinenum=$row["num"];
	}
?>
<?php include 'menu.php'; ?>
<?php
if(empty($_SESSION["User"]))
{
	include 'login.php';
}
else
{
	if(!empty($_GET["page"]))
	{
		switch($_GET["page"])
		{
			case '1':
				include 'list.php';
			break;
			case '2':
				include 'log.php';
			break;
			case '3':
				include 'Police.php';
			break;
			case '4':
				include 'whitelist.php';
			break;
			case '5':
				include 'online.php';
			break;
			case '6':
				include 'add.php';
			break;
			case '7':
				//include 'logkey.php';
				include 'logmoney.php';
			break;
			case '9':
				include 'about.php';
			break;
			case '55':
				include 'restart.php';
			break;
			case '11':
				include 'edit.php';
			break;
			case '12':
				include 'editwhite.php';
			break;
			case '13':
				include 'addwhite.php';
			break;
			case '15':
				include 'editcop.php';
			break;
			case '16':
				include 'delete.php';
			break;
			case '17':
				include 'bewhitelist.php';
			break;
			case '18':
				include 'addbewhite.php';
			break;
			case '19':
				include 'delbewhite.php';
			break;
			case '20':
				include 'advance.php';
			break;
			default:
			 include 'home.php';
		}
	}	
	else
	{
		include 'home.php';
	}
}
?>
<?php 	$conn->close();
	include 'boot.php';
	?>

</div>
</body>
</html>

