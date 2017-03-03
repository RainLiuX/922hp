<?php include('inc/header_simple.php'); ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(empty($_POST['name'])) {
            print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>名称不能为空</h1></div>');
        } elseif(!empty($_FILES['picture']['error'])) {
            print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>图片错误</h1></div>');
        } elseif(empty($_POST['price'])) {
            print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>价格不能为空</h1></div>');
        } elseif(empty($_POST['description'])) {
            print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>描述不能为空</h1></div>');
        } elseif(empty($_POST['link'])) {
            print('<div class="container"><div class="jumbotron" style="background-color:#ff9900;"><h1>链接不能为空</h1></div>');
        } else {
            $dbc = new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
            $name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name'])));
            $price = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['price'])));
            $description = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['description'])));
            $link = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['link'])));
            $query = "INSERT INTO nvzhuang (Name, Price, Description, Link, Vote) VALUES ('$name', '$price', '$description', '$link', 0);";
            $dbc->query($query);
            $query ="SELECT MAX(Id) FROM nvzhuang;";
            $result = $dbc->query($query);
            $dbc->close();
            $result = $result->fetch_array();
            $id = $result['MAX(Id)'];
            //mkdir("../user/nvzhuang/$id");
            //move_uploaded_file($_FILES['picture']['tmp_name'], "../user/nvzhuang/$id/picture");
			$s = new SaeStorage();
			$path = "user/nvzhuang/$id/picture";
			$->putObject($path, '922', $_FILES['picture']['tmp_name']);
            print('<div class="container"><div class="jumbotron" style="background-color:#ccff99;"><h1>添加成功</h1>
                <p>页面将于3秒后跳转</p></div></div>');
            header("Refresh:3, Url='nvzhuang.php'");
        }
    }
?>
<body style="padding-top:50px;">
    <div class="container">
        <div class="jumbotron">
            <h1>新建女装</h1>
            <form action="nvzhuang_new.php" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <p>名称</p>
                    <input type="text" name="name" size="20" />
                </div>
                <div class="form-group">
                    <p>图片</p>
                    <input type="hidden" name="MAX_FILE_SIZE" size="3000000" />
                    <input type="file" name="picture" />
                    <p>图片大小不能超过3M</p>
                </div>
                <div class="form-group">
                    <p>价格</p>
                    <input type="text" name="price" size="20" />
                </div>
                <div class="form-group">
                    <p>描述</p>
                    <input type="text-area" name="description" />
                    <p>简单描述一下这套衣服吧</p>
                </div>
                <div class="form-group">
                    <p>链接</p>
                    <input type="text" name="link" size="20" />
                </div>
                <button type="submit" class="btn btn-default">提交</button>
            </form>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>
