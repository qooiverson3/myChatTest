<?php
$sqlConn = new mysqli('127.0.0.1','root','root','ces');
$sqlConn->set_charset('utf-8');
if ($sqlConn->connect_error) exit('SQL Connect Error');

$user = $_POST['account'];
$login = "select * from account where a_account =?";
$checkAcc = $sqlConn->prepare($login);
$checkAcc->bind_param('s',$user);
$checkAcc->execute();
$checkAcc->store_result();
$checkAcc->bind_result($id,$account,$password,$dept);
$checkAcc->fetch();


$select = "select * from orderList where 1";
$stmt = $sqlConn->query($select);
$result = $stmt->fetch_assoc();
