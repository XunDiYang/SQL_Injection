<?php

$securityLevel = '';
if (isset($_POST[ 'seclev' ])) {
    switch ($_POST[ 'seclev' ]) {
        case 'low':
            $securityLevel = 'low';
            $securityLevelPHP = "low_main.php";
            break;
        default:
            $securityLevel = 'improved';
            $securityLevelPHP = "improved_main.php";
            break;
    }
    $_COOKIE[ 'security' ] = $securityLevel;

    // echo $securityLevelPHP;
}

$securityLevelHtml  = '';
$securityOptionsHtml = '';
foreach (array( 'low','improved' ) as $securityLevel) {
    $selected = '';
    if ($securityLevel == $_COOKIE[ 'security' ]) {
        $selected = 'selected="selected"';
        $securityLevelHtml = "<h3>现在的安全选项是： <em>$securityLevel</em>.<h3>";
    }
    $securityOptionsHtml .= "<option value=\"{$securityLevel}\"{$selected}>" . ucfirst($securityLevel) . "</option>";
}

$page[ 'body' ].="
<div class=\"body_padded\" align = \"center\">
<h2>2019-2020下 网络信息安全大作业 - SQL 注入攻击</h2>

<div class=\"vulnerable_code_area\">
    
    <h5>选择安全选项</h5>

    <form action=\"#\" method= \"POST\" >
        <select name=\"seclev\">
            {$securityOptionsHtml}
        </select>
        <input type=\"submit\" value=\"确认\" name=\"seclev_submit\">
    </form>

    <h3> {$securityLevelHtml}</h3>

    <br>
    <form action={$securityLevelPHP} method= \"GET\" >
       <button type=\"submit\"> 进入系统 </button>
    </form>

    <img src =\"panda.png\" />
    <br></br>
    <h6>BY 计算机学院-1120172169-杨训迪</h6>

</div>
</div>";


echo $page[ 'body' ];
