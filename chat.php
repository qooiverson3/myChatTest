<?php
if (empty($_COOKIE['acc'])) header("Location: login.php");
$title = !empty($_REQUEST['title'])?$_REQUEST['title']:header("Location: main2.php");
setcookie('title',$title,time()+3600);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>myFirstChat</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
    <script src="js/j.cookie.js"></script>
    <style>
        .chipSent {
            float: right;
            display: inline-block;
            padding: 0 25px;
            height: 90px;
            font-size: 12px;
            line-height: 50px;
            border-radius: 25px;
            background-color: #f3d4d4;
        }

        .chipRecv {
            float:left;
            display: inline-block;
            padding: 0 25px;
            height: 90px;
            font-size: 12px;
            line-height: 50px;
            border-radius: 25px;
            background-color: #f1f1f1;
        }

        .chipSent img {
            float: right;
            margin: 0 -15px 0 10px;
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }
        .chipRecv img {
            float: left;
            margin: 0 10px 0 -15px;
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }

        .buble-recv{
            position: relative;
            width: 480px;
            height: 75px;
            padding: 10px;
            background: #ffffff;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            //border: #000000 solid 1px;
            border: #a0999985 solid 1px;
            margin-bottom: 10px;
        }

        .buble-recv:after{
            content: '';
            position: absolute;
            border-style: solid;
            border-width: 15px 15px 15px 0;
            border-color: transparent #ffffff;
            display: block;
            width: 0;
            z-index: 1;
            left: -15px;
            top: 12px;
        }

        .buble-recv:before{
            content: '';
            position: absolute;
            border-style: solid;
            border-width: 15px 15px 15px 0;
            border-color: transparent #a0999985;
            display: block;
            width: 0;
            z-index: 0;
            left: -16px;
            top: 12px;
        }

        .buble-sent{
            position: relative;
            width: 480px;
            height: 75px;
            padding: 10px;
            background: #ffffff;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            //border: #000000 solid 1px;
            border: #a0999985 solid 1px;
            margin-bottom: 10px;
        }

        .buble-sent:after{
            content: '';
            position: absolute;
            border-style: solid;
            border-width: 15px 0 15px 15px;
            border-color: transparent #ffffff;
            display: block;
            width: 0;
            z-index: 1;
            right: -15px;
            top: 12px;
        }

        .buble-sent:before{
            content: '';
            position: absolute;
            border-style: solid;
            border-width: 15px 0 15px 15px;
            border-color: transparent #a0999985;
            display: block;
            width: 0;
            z-index: 0;
            right: -16px;
            top: 12px;
        }

        .spinner{
            display: inline-block;
            opacity: 0;
            width: 0;
            -webkit-transition: opacity 0.25s, width 0.25s;
            -moz-transition: opacity 0.25s, width 0.25s;
            -o-transition: opacity 0.25s, width 0.25s;
            transition: opacity 0.25s, width 0.25s;
        }

        .has-spinner.active{
            cursor: progress;
        }

        .has-spinner.active .spinner{
            opacity: 1;
            width: auto;
        }

        .has-spinner.btn-mini.active .spinner{
            width: 10px;
        }

        .has-spinner.btn-small.active .spinner{
            width: 13px;
        }

        .has-spinner.btn.active .spinner{
            width: 16px;
        }

        .has-spinner.btn-large.active .spinner{
            width: 19px;
        }

        .panel-body{
            padding-right: 35px;
            padding-left: 35px;
        }
    </style>
</head>
<body style="background-color:transparent">
<br>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title" align="center"><?php echo $_REQUEST['title'];?></h2>
        </div>
        <div class="panel-body" id="chatPanel" style="overflow:auto; height: 600px;">
        </div>
        <script type="text/javascript">

            function add() {
                var now = new Date();
                var div = document.getElementById('chatPanel');
                //div.innerHTML = div.innerHTML + 'time_' + now.getTime() + '<br />';
                userCookie = $.cookie("acc");

                var month = new Array(12);
                month[0] = "1";
                month[1] = "2";
                month[2] = "3";
                month[3] = "4";
                month[4] = "5";
                month[5] = "6";
                month[6] = "7";
                month[7] = "8";
                month[8] = "9";
                month[9] = "10";
                month[10] = "11";
                month[11] = "12";

                //直接print給對方的訊息
                nowTime = + now.getFullYear() + '/' + month[now.getMonth()] + '/' + now.getDate() + ' ' + now.getHours() + ':' +now.getMinutes();
                message = $("#chatMessage").val();
                chatBubble = $('<div class="chipSent"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqcJoc1sACzwkcA-2klCAU3hXEcOrXnXrNlXmPmhvPk8pIQtOX" alt="Person" width="60" height="60"><b>' + userCookie + '</b><br><i>' + nowTime + '</i></div><br><div class="row buble-sent pull-right">' + message + '</div><div class="clearfix"></div>');
                $('#chatPanel').append(chatBubble);
                div.scrollTop = div.scrollHeight;//scroll到底
            }
        </script>
        <div class="panel-footer">
            <form action="myChat.php" method="post">
            <div class="input-group">
                <input type="hidden" id="chatTitle" value="<?php echo $title;?>">
                <input type="text" class="form-control" id="chatMessage" placeholder="Send a message here..">
                <span class="input-group-btn">
                    <button id="sendMessageBtn" class="btn btn-primary has-spinner" type="submit" onclick="add()">
                        <span class="spinner">
                            <i class="icon-spin icon-spin icon-refresh"></i>
                        </span>
                        SEND
                    </button>
                </span>
            </div>
            </form>
        </div>
    </div>
</div>

    <script src="client.js"></script>

</body>
</html>