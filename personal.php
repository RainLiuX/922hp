<?php
    session_start();
    if(empty($_SESSION['User_id']))
        header('Location:login.php');
    include('inc/header.php');
?>
<body style="padding-top:50px;">
    <?php
        include('inc/acquire_user_info.php');
        acquire_user_info();
    ?>
    <div class="container">
        <div class="jumbotron" style="background:url(pic/bg2.png);padding-top:100px;">
			<?php $s = new SaeStorage(); $file_dir = $s->getUrl('922', "user/$user_id/photo.jpg"); ?>
            <img src="<?php print($file_dir); ?>" class="img-rounded" width="200" />
            <h3><?php print($user_name); ?></h3>
            <p><small><?php print($signature); ?></small></p>
        </div>
        <div class="row">
            <div class="col-sm-4" style="background-color:#99ccff;">
                <p>我的财产</p>
                <p><h1 style="display:inline-block;"><?php print($money); ?></h1>门思韬</p>
            </div>
            <div class="col-sm-4" style="background-color:#99ccff;">
                <p>今日开采时间</p>
                <p><h1 style="display:inline-block;"><?php print($_SESSION['Mnining_time']); ?></h1>小时</p>
            </div>
            <div class="col-sm-4"style="background-color:#99ccff;">
                <p>开采状态</p>
                <p><?php
                        $mining = empty($_SESSION['Mining']) ? false : $_SESSION['Mining'];
                        if($mining == true) print('<h1 style="display:inline-block;color:green;">正在开采</h>');
                        else print('<h1 style="display:inline-block;color:grey;">空闲中</h>');
                ?></p>
            </div>
        </div>
        <div class="jumbotron">
            <p>我的开采</p>
            <h1 style="text-align:center;">通过自习开采门思韬</h1>
            <a href="mine.php"><button type="button" class="btn-primary btn-lg">
                <?php
                    if($mining == true) print('结束开采');
                    else print('开始开采');
                ?>
            </button></a>
        </div>
        <div class="jumbotron">
            <p>让我们看到你的选择</p>
            <h1 style="text-align:center;">献给吹比的成年礼</h1>
            <a href="nvzhuang.php"><button type="button" class="btn-primary btn-lg">Vote Now!</button></a>
        </div>
    </div>
</body>
<?php include('inc/footer.php'); ?>
