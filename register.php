<?php
include('inc/header_simple.php');
?>
<body style="padding-top:50px;">
	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(empty($_POST['user_name'])) {
			print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>用户名不能为空</h1></div></div>');
		} elseif(empty($_POST['email'])) {
			print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>email不能为空</h1></div></div>');
		} elseif(empty($_POST['real_name'])) {
			print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>真实姓名不能为空</h1></div></div>');
		} elseif(empty($_POST['password']) || empty($_POST['password_repeat'])) {
			print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>密码不能为空</h1></div></div>');
		} elseif($_POST['password'] != $_POST['password_repeat']) {
			print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>两次密码不一致</h1></div></div>');
		} else {
			$dbc = new mysqli(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS, SAE_MYSQL_DB, SAE_MYSQL_PORT);
			$user_name = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['user_name'])));
			$real_name = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['real_name'])));
			$email = mysqli_real_escape_string($dbc,trim(strip_tags($_POST['email'])));
			$password = md5(mysqli_real_escape_string($dbc,trim(strip_tags($_POST['password']))));
			$query = "SELECT User_id FROM user WHERE User_name = '$user_name';";
			$retval = $dbc->query($query);
			if(!empty($retval->num_rows)) {
				print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>用户名已重复</h1></div></div>');
				$dbc->close();
			} else {
				$query = "INSERT INTO user(User_name, Real_name, Email, Password) VALUES ('$user_name','$real_name','$email','$password');";
				$dbc->query($query);
				$query = "SELECT User_id FROM user WHERE User_name = '$user_name';";
				$user_id = $dbc->query($query);
				$user_id = $user_id->fetch_array();
				$user_id = $user_id['User_id'];
				//mkdir("../user/$user_id");
				//copy('pic/photo.jpg', "../user/$user_id/photo.jpg");
				$s = new SaeStorage();
				$path = "user/$user_id/photo.jpg";
				$s->upload('922', $path, 'pic/photo.jpg');
				$query = "INSERT INTO possession(User_name, Money) VALUES ('$user_name', 0);";
				$dbc->query($query);
				$query = "INSERT INTO profile(User_name) VALUES ('$user_name');";
				$dbc->query($query);
				$dbc->close();
				session_start();
				$_SESSION['User_name'] = $user_name;
				$_SESSION['User_id'] = $user_id;
				print('<div class="container"><div class="jumbotron" style="background-color:#ccff99;"><h1>注册成功</h1>
					<p>页面将于3秒后跳转</p></div></div>');
				header("Refresh:3, Url='index.php'");
			}
		}}
	?>
	<div class="container" style="text-align=center;">
		<div class="jumbotron">
		<?php include('inc/register_form.php'); ?>
		</div>
	</div>
</body>
<?php include('inc/footer.php'); ?>
