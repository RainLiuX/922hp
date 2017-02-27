<h1>用户登录</h1>
<form action="login.php" method="post" role="form">
	<div class="form-group">
		<p>用户名</p>
		<input type="text" name="user_name" size="20" value="<?php if(isset($_POST['user_name'])) print(htmlspecialchars($_POST['user_name'])); ?>" />
		<p class="help-block">不超过20个字符</p>
	</div>
	<div class="form-group">
		<p>密码</p>
		<input type="password" name="password" value="<?php if(isset($_POST['password'])) print(htmlspecialchars($_POST['password'])); ?>" />
	</div>
	<button type="submit" class="btn btn-default">提交</button>
</form>
