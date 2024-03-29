<?php
include 'model/Tasks.php';
$ModelTasks = new Tasks();
$page = 1;

if (isset($_REQUEST['page']) && $_REQUEST['page'] != '') $page = addslashes(trim($_REQUEST['page']));
$array_filter = array();
$filter_str = '';
if (isset($_REQUEST['login']) && $_REQUEST['login'] != '') {
    $array_filter[] = " login LIKE '%" . addslashes(trim($_REQUEST['login'])) . "%' ";
}
if (isset($_REQUEST['email']) && $_REQUEST['email'] != '') {
    $array_filter[] = " email LIKE '%" . addslashes(trim($_REQUEST['email'])) . "%' ";
}
if (isset($_REQUEST['status']) && $_REQUEST['status'] != '-1') {
    $array_filter[] = " status=" . intval(addslashes(trim($_REQUEST['status']))) . " ";
}
if (!empty($array_filter)) {
    $filter_str = implode(" and ", $array_filter);
}
$tasks = $ModelTasks->getTasks($filter_str, $page);
$cnt = $ModelTasks->getCNT($filter_str, $page);
$pagination = $ModelTasks->getPagination($page, $cnt);

if ($_REQUEST['come']) {
    $login = $_REQUEST['login'];
    $password = md5($_REQUEST['password']);
    define('USER_TYPE', 0);
    $query = 'SELECT * FROM bj_users WHERE login="' . $login . '" AND password="' . $password . '" AND type=0';
    $result = $ModelTasks->login($query);

    if ($result) {
        echo 'Come in. <br>';
        echo '<a href="/">Перейти';
        $_SESSION['type'] = 'admin';
//        echo '$_SESSION["type"] = ' . $_SESSION['type'];
        exit();
    } else {
        echo 'Не получилось зайти.';
    }
}
include 'view/admin.php';
