<?php

$securityLevelPHP = "low.php";

$page[ 'body' ].="
<div class=\"body_padded\" align = \"center\">
<h2>2019-2020下 网络信息安全大作业 - SQL 注入攻击</h2>

<div class=\"vulnerable_code_area\">
    
    <h3>现在的安全选项是： <em>Low</em>.<h3>

    <HR style=\"FILTER: progid:DXImageTransform.Microsoft.Shadow(color:#987cb9,direction:145,strength:15)\" width=\"80%\" color=#987cb9 SIZE=1>

    <h5>进入个人主页：</h5>

    <form action={$securityLevelPHP} method=\"GET\">
        <p>
            用户ID:
            <input type=\"text\" size=\"15\" name=\"uid\">
            <br></br>
            PSWD:
            <input type=\"password\" size=\"15\" name=\"password\">
            <br></br>
            <input type=\"submit\" name=\"Submit_USER\" value=\"确认\">
        </p>

    </form>

    <HR style=\"FILTER: progid:DXImageTransform.Microsoft.Glow(color=#987cb9,strength=10)\" width=\"80%\" color=#987cb9 SIZE=1>

    <h5>输入你要搜索的用户信息：</h5>

    <form action={$securityLevelPHP} method=\"GET\">
        <p>
            用户ID:
            <input type=\"text\" size=\"15\" name=\"id\">
            <input type=\"submit\" name=\"Submit_ID\" value=\"确认\">
        </p>
    </form>


    <img src =\"panda.png\" />
    <br></br>
    <h6>BY 计算机学院-1120172169-杨训迪</h6>

</div>
</div>";


echo $page[ 'body' ];
