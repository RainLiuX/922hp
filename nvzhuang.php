<?php include('inc/header_simple.php') ?>
<body style="padding-top:50px;">
    <div class="container">
        <div class="jumbotron" style="background:url(pic/bg3.png);">
            <h1 style="display:inline-block;">吹比的成年礼</h1>
            <a href="nvzhuang_new.php"><button type="button" class="btn-primary btn-lg" style="margin-left:100px;display:inline-block;">添加自定义女装</button></a>
        </div>
        <form action="nvzhuang_vote.php" method="post">
        <?php
            $dbc = new mysqli(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS, SAE_MYSQL_DB, SAE_MYSQL_PORT);
            $query = "SELECT SUM(Vote) FROM nvzhuang;";
            $result =$dbc->query($query);
            $result = $result->fetch_array();
            $vote_sum = $result['SUM(Vote)'];
            $query = "SELECT * FROM nvzhuang;";
            $result = $dbc->query($query);
            if ($result->num_rows >0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['Id'];
                    $name = $row['Name'];
                    $price = $row['Price'];
                    $description = $row['Description'];
                    $link = $row['Link'];
                    $vote = $row['Vote'];
                    print_choice($id, $name, $price, $description, $link, $vote, $vote_sum);
                }
            }
            $dbc->close();
            function print_choice($id, $name, $price, $description, $link, $vote, $vote_sum) {
				$s = new SaeStorage();
				$file_dir = $s->getUrl('922', "user/nvzhuang/$id/picture");
                print('
                <div class="col-sm-6">
                    <h1 style="display:inline-block;">'.$name.'</h1>
                    <input type="checkbox" name="'.$id.'" value="true" style="margin-left:60px; width:30px;" />
                    <hr />
                    <div style="text-align:center;" onclick="fold(this)">
                    <img class="img-rounded" width=70% height=200 src="'.$file_dir.'" style="margin:auto;" />
                    </div>
                    <div id="foldable" style="display:none;">
                        <h2>¥ '.$price.'</h2>
                        <br/>
                        <p>'.$description.'</p>
                        <a href="'.$link.'">点此查看详情</a>
                    </div>
                    <hr />
                    <div class="progress">
        				<div class="progress-bar" role="progressbar" aria-valuenow="'.$vote.'" aria-valuemin="0" aria-valuemax="'.$vote_sum.'"
                        style="width:'.($vote_sum == 0 ? 0 : $vote/$vote_sum*100).'%;">
        					<span class="sr-only">vote '.$vote.'</span>
        				</div>
        			</div>
        			<p>'.$vote.'票</p>
                </div>
                ');
            }
        ?>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
        </form>
    </div>
    <script>
        function fold(object) {
            var foldable = object.nextElementSibling;
            if (foldable.style.display != "none") {
                foldable.style.display = "none";
            } else {
                foldable.style.display = "inline";
            }
        }
    </script>
</body>
<?php include('inc/footer.php') ?>
