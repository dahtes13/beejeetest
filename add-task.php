<?php
require_once 'db.php';

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['task_text']) ) {
	if ($_POST['name'] == '' || $_POST['email'] == '' || $_POST['task_text'] == '') {
		echo 'Заполните все поля';
	} else {
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$add_task = 'INSERT INTO task (name, email, text) VALUES ("' . $_POST["name"] .'","' . $_POST['email'] . '","' . htmlspecialchars($_POST['task_text']) . '")';
			mysqli_query($link,$add_task);
			echo '1';
		} else {
			echo 'Поле e-mail заполнено не верно';
		}
	}
}
?>