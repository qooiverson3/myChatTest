<?php

$sqlConn = new mysqli('127.0.0.1','root','root','chat');
$stmt = $sqlConn->query("select * from `TABLE 3` where 1");
$json = new stdClass();

    $data = [];
    while ($result = $stmt->fetch_assoc()) {
            $data['profile'] = $result['COL 1'];
            $data['domain'] = $result['COL 2'];
            $json->Datas[] = $data;
    }

header("Content-type: application/json");
echo json_encode($json);
