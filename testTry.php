<?php

try{
    $sqlConn = new mysqli('127.0.0.1','root','root1','ces');
    if ($sqlConn->connect_error) throw new Exception("SQL Connect Error!");

    $select = "select a_account from account1";
    $stmt = $sqlConn->query($select);
    if ($sqlConn->error) throw new Exception("SQL Query Error");
    if (!$row = $stmt->fetch_object()) {
        throw new Exception("SQL Fetch Error!");
    }else {
        do {
            $data[] = $row;
        } while ($row = $stmt->fetch_object());
    }
}catch (Exception $e){
    echo "{$e->getMessage()}<br>";
    echo "Catch in {$e->getLine()} line<br>";
}

if (count($data)>0) {
    echo json_encode($data);
}