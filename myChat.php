<?php
if (empty($_COOKIE['acc'])) header("Location: login.php");
$user = $_COOKIE['acc'];
$myTi = $_COOKIE['title'];

ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');

//Connect SQL
$sqlConn = new mysqli('127.0.0.1','root','root','chat');
if ($sqlConn->connect_error) exit('SQL Connect Error!');

try{
    $currentTime = time();
    $lastPoll = isset($_COOKIE['last_poll']) ? $_COOKIE['last_poll'] : $currentTime;
    $action = isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'send' : 'poll';

    switch ($action){
        case 'poll':
            $query = "select * from chatlog where a_title = ? and date_created >= ?";
            $stmt = $sqlConn->prepare($query);
            $stmt->bind_param('ss',$myTi,$lastPoll);
            $stmt->execute();
            $stmt->bind_result($id, $message, $user, $date_created, $title);
            $result = $stmt->get_result();

            $newChats = [];
            while ($chat = $result->fetch_assoc()){
                if ($user == $chat['sent_by']){
                    $chat['sent_by'] = 'self';
                }else{
                    //$chat['sent_by'] = 'other';
                    $chat['sent_from'] = $chat['sent_by'];
                }
                $newChats[] = $chat;
            }
            setcookie('last_poll',$currentTime,time()+3600);

            print json_encode(
                [
                    'success' => true,
                    'messages' => $newChats
                ]
            );
            exit;
        case 'send':
            $message = isset($_POST['message']) ? $_POST['message'] : '';
            $message = strip_tags($message);
            $query = "insert into chatlog (message, sent_by, date_created, a_title) values (?, ?, ?, ?)";
            $stmt = $sqlConn->prepare($query);
            $stmt->bind_param('ssis',$message, $user, $currentTime, $myTi);
            $stmt->execute();

            print json_encode(['success' => true]);
            exit;
    }
}catch (\Exception $e){
    print json_encode(
        [
            'success' => false,
            'error' => $e->getMessage()
        ]
    );
}

