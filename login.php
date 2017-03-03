<?php include('inc/header_simple.php'); ?>
<body style="padding-top:50px;">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(empty($_POST['user_name'])) {
			print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>用户名不能为空</h1></div></div>');
		} elseif(empty($_POST['password'])) {
			print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>密码不能为空</h1></div></div>');
		} else {
			$dbc = new mysqli(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS, SAE_MYSQL_DB, SAE_MYSQL_PORT);
			$user_name = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['user_name'])));
			$password = md5(mysqli_real_escape_string($dbc,trim(strip_tags($_POST['password']))));
			$query = "SELECT * FROM user WHERE User_name = '$user_name';";
			$retval = $dbc->query($query);
			if(empty($retval->num_rows)) {
				print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>用户名不存在</h1></div></div>');
			} else {
                $retval = $retval->fetch_array();
                $select_password = $retval['Password'];
                if($select_password != $password) {
                    print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>密码错误</h1></div></div>');
                }
                $user_id = $retval['User_id'];
				session_start();
				$_SESSION['User_name'] = $user_name;
				$_SESSION['User_id'] = $user_id;
				print('<div class="container"><div class="jumbotron" style="background-color:#ccff99;"><h1>登录成功</h1>
					<p>页面将于3秒后跳转</p></div></div>');
				header("Refresh:3, Url='index.php'");
			}
		}}
	?>
	<div class="container" style="text-align=center;">
		<div class="jumbotron">
		<?php include('inc/login_form.php'); ?>
		</div>
        <div class="jumbotron" style="background-color:#ccccff">
            <a href="register.php"><button type="button" class="btn-primary btn-lg">没有账号?点此注册</button></a>
	</div>
</body>
<?php include('inc/footer.php'); ?>
