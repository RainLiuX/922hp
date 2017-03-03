<?php include('inc/header_simple.php');
    $dbc = new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
    foreach($_POST as $key => $value) {
        $query = "SELECT * FROM nvzhuang WHERE Id = $key;";
        $result = $dbc->query($query);
        if($result->num_rows == 1) {
            $query = "UPDATE nvzhuang set Vote = Vote + 1 WHERE Id = $key;";
            $dbc->query($query);
            $slogan = "提交成功!感谢您的支持";
        } else {
            $slogan = "提交失败";
        }
    }
?>
<body style="padding-top:50px;">
    <div class="container">
        <div class="jumbotron">
            <h1><?php print($slogan); ?></h1>
            <p>页面将于3秒钟后转跳</p>
        </div>
    </div>
</body>
<?php
    header("Refresh:3, Url='nvzhuang.php'");
    include('inc/footer.php')
?>
