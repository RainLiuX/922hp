<?php include('inc/header.php'); ?>
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
				<span class="sr-only">切换导航</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">922</a>
		</div>
		<div class="collapse navbar-collapse" id="example-navbar-collapse">
			<ul class="nav navbar-nav">
			<li class="active"><a href="#">主页</a></li>
			<li><a href="#">交易</a></li>
			<li><a href="#">日志</a></li>
			<li><a href="#">论坛</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					个人中心
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">钱包</a></li>
					<li><a href="#">我的帖子</a></li>
					<li><a href="#">我的交易</a></li>
					<li><a href="#">收藏</a></li>
					<li class="danger"><a href="#">退出</a></li>
				</ul>
			</li>
			</ul>
		</div>
	</nav>
</head>
<body style="padding-top:50px;">
	<div class="jumbotron" style="background-color:#ccccff">
		<div class="container">
			<h1>欢迎来到922</h1>
			<p>在922开采门思韬,交易与讨论</p>
			<a href="register.php"><button type="button" class="btn-primary btn-lg">立即加入</button></a>
		</div>
	</div>
	<div class="row" style="margin-bottom:30px;">
		<div class="col-sm-6" style="text-align:center;">
			<h3><span class="glyphicon glyphicon-transfer"></span>兑换屁股</h3>
			<h1>10000屁股</h1>
			<a href="#"><small>了解更多关于屁股</small></a>
		</div>
		<div class="col-sm-6" style="text-align:center;">
			<h3><span class="glyphicon glyphicon-transfer"></span>兑换辣椒包</h3>
			<h1>1.34辣椒包</h1>
			<a href="#"><small>了解更多关于辣椒包</small></a>
		</div>
	</div>
	<div class="jumbotron" style="background-color:#0099cc; margin-bottom:0">
		<div class="container" style="text-align:center;">
			<h3>开采情况</h3>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="2000" style="width:0%">
					<span class="sr-only">进度 0%</span>
				</div>
			</div>
			<p>进度 0%</p>
		</div>
	</div>
	<div class="jumbotron" style="margin-bottom:0">
		<div class="container">
			<h3>成员人数</h3>
			<?php
				$dbc = new mysqli('localhost', 'user922', 'mensitao','project922');
				$query = 'SELECT * FROM user;';
				$result = $dbc->query($query);
				$member_num = $result->num_rows;
				print("<p><h1 style=\"display:inline-block;\">$member_num</h1>人</p>");
				$dbc->close();
			?>
		</div>
	</div>
</body>
</html>
