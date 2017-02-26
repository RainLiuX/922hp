<?php include('inc/header.php'); ?>
<div class="navbar-header">
	<a class="navbar-brand" href="index.php">922</a>
</div></nav>
</head>
<body style="padding-top:50px;">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(empty($_POST['user_name'])) {
			print('用户名不能为空');
		} elseif(empty($_POST['email'])) {
			print('email不能为空');
		} elseif(empty($_POST['real_name'])) {
			print('真实姓名不能为空');
		} elseif(empty($_POST['password']) || empty($_POST['password_repeat'])) {
			print('密码不能为空');
		} elseif($_POST['password'] != $_POST['password_repeat']) {
			print('两次密码不一致');
		} else {
			$dbc = new mysqli('localhost', 'user922', 'mensitao', 'project922');
			$user_name = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['user_name'])));
			$real_name = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['real_name'])));
			$email = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['email'])));
			$password = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['password'])));
			$query = "SELECT User_id FROM user WHERE User_name = '$user_name';";
			$retval = $dbc->query($query);
			if(!empty($retval->num_rows)) {
				print('用户名已重复');
				$dbc->close();
			} else {
				$query = "INSERT INTO user(User_name, Real_name, Email, Password) VALUES ('$user_name','$real_name','$email','$password');";
				$dbc->query($query);
				$dbc->close();
				print('注册成功');
			}
		}}
	?>
	<div class="jumbotron" style="text-align=center;">
		<div class="container">
		<?php include('inc/register_form.php'); ?>
		</div>
	</div>
</body>
</html>
