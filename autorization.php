<?php
session_start();
require_once 'db.php';

if (isset($_POST['login']) && isset($_POST['pass']) ) {
    $loginsql = 'SELECT password FROM users WHERE login="' . $_POST['login'] . '"';
	$result = mysqli_fetch_assoc(mysqli_query($link,$loginsql));
	
	if(password_verify($_POST['pass'], $result['password'])) {
		$_SESSION['admin'] = $_POST['login'];
		echo '1';
	} else {
		echo 'Неверный логин/пароль';
	}
}
?>