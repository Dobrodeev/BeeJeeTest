<?php
include 'config/config.php';
include 'view/header.php';
$module = '';
if ($_SERVER['REQUEST_URI'] != '/')
{
	try {
		// Для того, что бы через виртуальные адреса можно было также передавать параметры
		// через QUERY_STRING (т.е. через "знак вопроса" - ?param=value),
		// необходимо получить компонент пути - path без QUERY_STRING.
		// Данные, переданные через QUERY_STRING, также как и раньше будут содержаться в
		// суперглобальных массивах $_GET и $_REQUEST.
		$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		// Разбиваем виртуальный URL по символу "/"
		$uri_parts = explode('/', trim($url_path, ' /'));
		$module = array_shift($uri_parts); // Получили имя модуля
		// Получили в $params параметры запроса
		for ($i=0; $i < count($uri_parts); $i++)
		{
			$params[] = $uri_parts[$i];
		}
	} catch (Exception $e) {
		$module = 'home';
	}
}

if ($module == '') $module = 'tasks';
if ($module == 'admin') $module = 'admin';
if (!file_exists('controller/'.$module . '.php')){
    header('location: /');
}
//include 'controller/admin.php';
if (file_exists('controller/'.$module . '.php')){
    include ('controller/'.$module .'.php');
}
include 'view/footer.php';