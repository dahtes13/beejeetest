<?php
// Database connection
$host = 'mysql.zzz.com.ua:3306';
$database = 'dahtes13';
$user = 'dahtes';
$password = 'Exv3%R3~jl';

$link = mysqli_connect($host, $user, $password, $database) or die('Ошибка: ' . mysqli_error($link));
?>