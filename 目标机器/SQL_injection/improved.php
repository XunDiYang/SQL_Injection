<?php
session_start();

$servername = "localhost";
$username = "xundi";
$password = "20190120";
$database = "secure_info";

// 创建连接
$handle = new mysqli($servername, $username, $password, $database);

// 检测连接
if ($handle->connect_error) {
    die("连接失败: " . $handle->connect_error);
}

echo "hello world"."<br>";


if (isset($_GET["Submit_USER"])) {

    // 进入个人主页
    $uid = $_GET["uid"];
    $pswd = $_GET["password"];

    $uid = mysqli_real_escape_string($handle, $uid);
    $pswd = mysqli_real_escape_string($handle, $pswd);
    echo "<br>" . "输入用户ID: " . $uid;
    echo "<br>" . "输入密码: " .$pswd . "<br>";
   
    if (is_numeric($id)) {
        $login = "SELECT user_id, first_name, last_name, user, last_login, sex, email FROM users WHERE user_id = $uid AND password='$pswd' AND cancel = 0 LIMIT 1";
        echo "<br>". "查询语句: " . $login. "<br>";
    
        // Low level: 不过滤非法字符，直接搜索
        $ifLogin = mysqli_query($handle, $login);
    
        $i = 0;
        if ($row = mysqli_fetch_array($ifLogin)) {
            //登录成功
            session_start();
            $_SESSION['uid'] = $uid;
            $_SESSION['password'] = $row['password'];
            
            echo "<br>" . "user_id:" . $row['user_id'] ;
            echo "<br>" . "first_name: " . $row['first_name'] ;
            echo "<br>" . "last_name: " .  $row['last_name'];
            echo "<br>" . "user: " .  $row['user'] ;
            echo "<br>" . "sex: " .   $row['sex'] ;
            echo "<br>" . "email: " .   $row['email'];
            echo "<br>" . "last_login: " .  $row['last_login'] . "<br>" ;
            exit;
        } else {
            echo "<br>". "无此用户或密码错误" . $getid. "<br>";
        }
    } else {
        echo "<br>". "无此用户或密码错误" . $getid. "<br>";
    }
} elseif (isset($_GET["Submit_ID"])) {
    // 搜索用户信息-ID
    $id = $_GET["id"];
    echo "<br>" . "搜索用户ID: " . $id . "<br>";

    $i = 0;
    if (is_numeric($id)) {
        $getid = "SELECT first_name, last_name, user, last_login FROM users WHERE user_id = $id AND cancel = 0";
        echo "<br>". "查询语句: " . $getid. "<br>";
    
        // Low level: 不过滤非法字符，直接搜索
        $result = mysqli_query($handle, $getid);
    
        while ($row = mysqli_fetch_array($result)) {
            echo "<pre>";
            echo "ID: " . $id . "<br>First name: " . $row["first_name"] ;
            echo  "<br>Last Name: " . $row["last_name"] ;
            echo  "<br>NickName: " . $row["user"] ;
            echo "<br>Last_login: " . $row["last_login"];
            echo "</pre>";
    
            $i++;
        }
    }

    if ($i == 0) {
        echo "无结果";
    }
}
