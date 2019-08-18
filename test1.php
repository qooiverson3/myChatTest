<?php
session_start();
$result = new stdClass();
//$data = [];
//$data['title'] = 'title_1';
//$data['user'] = 'wesley_lai';
$result->user = 'wesley'; $result->title = 'title_test';


$_SESSION['data'] = $result;
header("Location: test2.php");