<?php
    $upload = $_FILES['file1'];
    if (is_uploaded_file($upload['tmp_name'])){
        if (move_uploaded_file($upload['tmp_name'], "/tmp/0803-new.txt")){
            echo "Success";
        }else{
            echo "Fail";
        }
    }
?>

<form action="file.php" enctype="multipart/form-data" method="post">
    <input type="file" name="file1">
    <input type="submit" value="send">
</form>
