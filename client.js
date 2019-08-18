var pollserver = function () {
    $.get('myChat.php', function (result) {
        if (!result.success){
            console.log("Error polling server for new message!");
            return;
        }

        $.each(result.messages, function (idx) {
            var chatBubble;
            var div = document.getElementById('chatPanel');

            //只需要每五秒顯示對方的訊息
            if (this.sent_by != 'self'){
                //chatBubble = $('<div class="chipSent"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqcJoc1sACzwkcA-2klCAU3hXEcOrXnXrNlXmPmhvPk8pIQtOX" alt="Person" width="60" height="60">GM</div><br><div class="row buble-sent pull-right">' + this.message + '</div><div class="clearfix"></div>');
                chatBubble = $('<div class="chipRecv"><img src="http://www.fzlkz.com/uploads/allimg/c150828/1440K300J4640-261U.jpg" alt="Person" width="96" height="96"><b>' + this.sent_from + '</b></div><div class="row buble-recv pull-left">' + this.message + '</div><div class="clearfix"></div>');
            //} else {
                //chatBubble = $('<div class="chipRecv"><img src="http://www.fzlkz.com/uploads/allimg/c150828/1440K300J4640-261U.jpg" alt="Person" width="96" height="96">Guest</div><br>' + '<div class="row buble-recv pull-left">' + this.message + '</div><div class="clearfix"></div>');
            }

            $('#chatPanel').append(chatBubble);
            div.scrollTop = div.scrollHeight; //scroll到底
        });

        setTimeout(pollserver, 3000);
    });
}

$(document).on('ready', function () {
    pollserver();
    $('button').click(function () {
        $(this).toggleClass('active');
    });
});

$('#sendMessageBtn').on('click', function (event) {
    event.preventDefault();
    var message = $('#chatMessage').val();
    var title = $('#chatTitle').val();

    $.post('myChat.php', {'message' : message, 'title' : title},function (result) {
        $('#sendMessageBtn').toggleClass('active');
        if (!result.success){
            alert("There was an error sending your meassage");
        }else {
            console.log("Message sent!");
            $('#chatMessage').val('');
            //$('#chatTitle').val('');
        }
    });
});
