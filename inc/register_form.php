<h1>用户注册</h1>
<form action="register.php" method="post" role="form">
	<div class="form-group">
		<p>用户名</p>
		<input type="text" name="user_name" size="20" value="<?php if(isset($_POST['user_name'])) print(htmlspecialchars($_POST['user_name'])); ?>" />
		<p class="help-block">不超过20个字符</p>
	</div>
	<div class="form-group">
		<p>email</p>
		<input type="text" name="email" value="<?php if(isset($_POST['email'])) print(htmlspecialchars($_POST['email'])); ?>" />
	</div>
	<div class="form-group">
		<p>真实姓名</p>
		<input type="text" name="real_name" size="10" value="<?php if(isset($_POST['real_name'])) print(htmlspecialchars($_POST['real_name'])); ?>" />
	</div>
	<div class="form-group">
		<p>密码</p>
		<input type="password" name="password" value="<?php if(isset($_POST['password'])) print(htmlspecialchars($_POST['password'])); ?>" />
	</div>
	<div class="form-group">
		<p>重复密码</p>
		<input type="password" name="password_repeat" value="<?php if(isset($_POST['password_repeat'])) print(htmlspecialchars($_POST['password_repeat'])); ?>" />
	</div>
	<button type="submit" class="btn btn-default">提交</button>
</form>
