<?php 
// define variables and set to empty values
$nameErr = $passErr = "";
$name = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "用户名不能为空";
  } else {
    $name = test_input($_POST["name"]);
  }

  if (empty($_POST["psw"])) {
    $passErr = "密码不能为空";
  } else {
    $pass = test_input($_POST["psw"]);
  }
  if (($name!="")&&($pass!="")){
	  $sql="select adminlevel from admin where user='".$name."' AND psw='".md5($pass)."'";
	$result=$conn->query($sql);
	if($result->num_rows >0){
		//write to session
		$_SESSION["User"]=$name;
		$row=$result->fetch_assoc();
		$_SESSION["Admin"]=$row["adminlevel"];
		echo "<script>window.location.href ='".htmlspecialchars($_SERVER["PHP_SELF"])."';</script>";
	}
  }
}

?>

<div class="w3-container">
  <h2>后台管理 </h2>

  <button onclick="document.getElementById(&#39;id01&#39;).style.display=&#39;block&#39;" class="w3-btn w3-green w3-large">Login</button>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal"></span>
        <img src="./images/img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="w3-section">
          <label><b>用户名</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="输入用户名" name="name" value="<?php echo $name;?>" required="">
		  <span class="error">* <?php echo $nameErr;?></span>
          <label><b>密码</b></label>
          <input class="w3-input w3-border" type="password" placeholder="输入密码" name="psw" value="<?php echo $pass;?>" required="">
		  <span class="error">* <?php echo $passErr;?></span>
          <button class="w3-btn-block w3-green w3-section w3-padding" type="submit">登录</button>
          <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> 记住用户名
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById(&#39;id01&#39;).style.display=&#39;none&#39;" type="button" class="w3-btn w3-red">取消</button>
      </div>

    </div>
  </div>
</div>
            

<div id="cntvlive2-is-installed"></div>
