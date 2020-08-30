<?php
session_start();

// Session close
if($_GET['do'] == 'logout'){
	unset($_SESSION['admin']);
	session_destroy();
}

// Page navigation count
$countTask = 3;
if (isset($_GET['page'])){
	$pageNum = (int)$_GET['page'];
} else { 
	$pageNum = 1;
}
$startTask = ($pageNum-1)*$countTask;

// Sort type options
if (isset($_GET['sort'])) {
	$sort_type_page = (int)$_GET['sort'];
} else {
	$sort_type_page = 1;
	$sort_type = 'task.id ASC';
}

if ($sort_type_page == 2) {
	$sort_type = 'task.name ASC';
}

if ($sort_type_page == 3) {
	$sort_type = 'task.name DESC';
}

if ($sort_type_page == 4) {
	$sort_type = 'task.email ASC';
}

if ($sort_type_page == 5) {
	$sort_type = 'task.email DESC';
}

if ($sort_type_page == 6) {
	$sort_type = 'task.status ASC';
}

if ($sort_type_page == 7) {
	$sort_type = 'task.status DESC';
}

// Multiple GET request handler
if ($_SERVER["QUERY_STRING"] != '') {
	if (strstr($_SERVER["QUERY_STRING"], '=', true) == 'page') {
		$separator = '?page=' . (int)$_GET['page'] . '&';
		$separatorpaginator = '?';
	}
	if (strstr($_SERVER["QUERY_STRING"], '=', true) == 'sort') {
		$separatorpaginator = '?sort=' . $sort_type_page . '&';
		$separator = '?';
	}
} else {
	$separator = '?';
	$separatorpaginator = '?';
}

// Task list output
require_once 'db.php';
$sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM task ORDER BY ' . $sort_type . ' LIMIT ' . $startTask . ',' . $countTask;
$allTask = mysqli_fetch_assoc(mysqli_query($link,'SELECT COUNT(*) FROM task'));
$lastPageNum = ceil($allTask['COUNT(*)']/$countTask);

$result = mysqli_query($link,$sql);

// Task list header output
echo '<div id="task-head"><div id="name-head">';
if ($sort_type_page != 2) {
	echo '<a href="' . $separator . 'sort=2">';
} else {
	echo '<a href="' . $separator . 'sort=3">';
}
echo 'Имя пользователя</a></div><div id="email-head">';
if ($sort_type_page != 4) {
	echo '<a href="' . $separator . 'sort=4">';
} else {
	echo '<a href="' . $separator . 'sort=5">';
}
echo 'E-mail</a></div><div id="text-heat">Сообщение</div><div id="status-head">';
if ($sort_type_page != 6) {
	echo '<a href="' . $separator . 'sort=6">';
} else {
	echo '<a href="' . $separator . 'sort=7">';
}
echo 'Статус</a></div>';
if($_SESSION['admin'] == "admin"){
	echo '<div id="edit-rask-head">Управление</div></div>';
} else {
	echo '</div>';
}

// Tasl list string output
echo '<div id="task-content">';
while($task = mysqli_fetch_assoc($result)) {
    echo '<div class="task-string" id="taskid-' . $task["id"] . '"><div class="name">' . $task["name"]. '</div>'
    .'<div class="email">' . $task["email"]. '</div>'
    .'<div class="text">' . $task["text"]. '</div>';
	if ($task["status"] == 0 || $task["status"] == '0') {
		$staustask = 'В процессе';
		$statusclass = 'not-ready';
	} else {
		$staustask = 'Выполнена';
		$statusclass = 'ready';
	}
	// Task chek administrator change
	if ($task["edit"] == 1) {
		$staustask = $staustask . '<br /><span>Отредактировано администратором</span>';
	}
    echo '<div class="status ' . $statusclass . '">' . $staustask. '</div>';
	// Task change button output
	if($_SESSION['admin'] == "admin"){
		echo '<div class="change">Изменить</div></div>';
	} else {
		echo '</div>';
	}
}

echo '</div>';

mysqli_close($link);
?>