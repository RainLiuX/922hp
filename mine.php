<?php
	include('inc/header.php');
	session_start();
	$mining = empty($_SESSION['Mining']) ? false : $_SESSION['Mining'];
	if($mining == false) {
		$_SESSION['Mining'] = true;
		$_SESSION['Mining_start'] = time();
		$slogan = ('正在开采...');
	} else {
		$user_id = $_SESSION['User_id'];
		$money_increase = round((time() - $_SESSION['Mining_start'])/3600, 2);
		//$_SESSION['Mining_time'] += round(time() - $_SESSION['Mining_start'], 2);
		$dbc = new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
		$query = "SELECT Money from possession WHERE User_id = $user_id;";
		$retval = $dbc->query($query);
		$retval = $retval->fetch_array();
		$money = $retval['Money'];
		$money += $money_increase;
		$query = "UPDATE possession SET Money = $money WHERE User_id = $user_id;";
		$dbc->query($query);
		$dbc->close();
		$_SESSION['Mining'] = false;
		$slogan = ('开采已结束');
	}
?>
<body style="padding-top:50px;">
    <div class="container">
		<div class="jumbotron" style="background-color:#666666;">
			<h1><?php print($slogan); ?></h1>
		</div>
	</div>
</body>
<?php include('inc/footer.php'); ?>
