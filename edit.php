<?php
session_start();
require_once 'db.php';

if ($_SESSION['admin'] == "admin") {
	if (isset($_POST['name_edit']) && isset($_POST['email_edit']) && isset($_POST['task_text_edit'])) {
		if ($_POST['name_edit'] == '' || $_POST['email_edit'] == '' || $_POST['task_text_edit'] == '') {
			echo 'Заполните все поля';
		} else {
			$texteditchek = mysqli_fetch_assoc(mysqli_query($link,'SELECT text, edit FROM task WHERE id="' . $_POST['taskid'] . '"'));
			if ($_POST['task_text_edit'] != $texteditchek['text'] && $texteditchek['edit'] != 1) {
				$texteditresult = 1;
			} else {
				$texteditresult = 0;
			}
			if (filter_var($_POST['email_edit'], FILTER_VALIDATE_EMAIL)) {
				$edit_task = 'UPDATE task SET name="' . $_POST['name_edit'] . '", email="' . $_POST['email_edit'] . '", text="' . $_POST['task_text_edit'] . '", status="' . $_POST['status_edit'] . '"';
				if ($texteditresult == 1) {
					$edit_task = $edit_task . ', edit="1"';
				}
				$edit_task = $edit_task . ' WHERE id="' . $_POST['taskid'] . '"';
				mysqli_query($link,$edit_task);
				echo '1';
			} else {
				echo 'Поле e-mail заполнено не верно';
			}
		}
	}
} else {
	echo 'Авторизуйтесь';
}
?>