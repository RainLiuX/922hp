<?php
    function acquire_user_info() {
        global $user_id, $user_name, $money, $gender, $age, $signature;
        $user_id = $_SESSION['User_id'];
        $user_name = $_SESSION['User_name'];
        $dbc = new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
        $query = "SELECT Money FROM possession WHERE User_id = $user_id;";
        $retval = $dbc->query($query);
        $retval = $retval->fetch_array();
        $money = empty($retval['Money']) ? 0 : $retval['Money'];
        $query = "SELECT * FROM profile WHERE User_id = $user_id;";
        $retval = $dbc->query($query);
        $retval = $retval->fetch_array();
        if(empty($retval['Gender']))
            $genger = '未设置';
        elseif($retval['Gender'] == 0)
            $gender = '女';
        else
            $gender = '男';
        $age = empty($retval['Age']) ? 0 : $retval['Age'];
        $signature = empty($retval['Signature']) ? '苟...?' : $retval['Signature'];
        $_SESSION['Mnining_time'] = empty($_SESSION['Mnining_time']) ? 0 : $_SESSION['Mnining_time'];
    }
?>
