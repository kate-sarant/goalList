<?php
$user = 'root';
$password = '';
$db = 'toDoList';
$host = 'localhost';

$link = mysqli_init();
$success = mysqli_real_connect($link,$host,$user,$password,$db);
if ($link === false) {
    die("ERROR:Could not connect.".mysqli_connect_error());
}
