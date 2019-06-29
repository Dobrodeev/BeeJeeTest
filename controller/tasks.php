<?php 
include 'model/Tasks.php';
$ModelTasks = new Tasks;
$page=1;
if(isset($_REQUEST['action'])&& $_REQUEST['action']=='add'){
	$text = addslashes(trim($_REQUEST['text']));
	$email = addslashes(trim($_REQUEST['email']));
	$login = addslashes(trim($_REQUEST['login']));
	$ModelTasks->add($text, $login, $email);
}

if(isset($_REQUEST['page']) && $_REQUEST['page']!='')$page=addslashes(trim($_REQUEST['page']));
$array_filter=array();$filter_str='';
if(isset($_REQUEST['login']) && $_REQUEST['login']!=''){
	$array_filter[] = " login LIKE '%".addslashes(trim($_REQUEST['login']))."%' ";
}
if(isset($_REQUEST['email']) && $_REQUEST['email']!=''){
	$array_filter[] = " email LIKE '%".addslashes(trim($_REQUEST['email']))."%' ";
}
if(isset($_REQUEST['status']) && $_REQUEST['status']!='-1'){
	$array_filter[] = " status=".intval(addslashes(trim($_REQUEST['status'])))." ";
}
if(!empty($array_filter)){
	$filter_str = implode(" and ",$array_filter);
}
$tasks = $ModelTasks->getTasks($filter_str, $page);
$cnt = $ModelTasks->getCNT($filter_str, $page);
$pagination = $ModelTasks->getPagination($page, $cnt);
include 'view/tasks.php';
