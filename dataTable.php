<?php
$sqlConn = new mysqli('127.0.0.1','root','root','ces');
if ($sqlConn->error) exit('SQL Connect Error');

$sel = "select * from dept";
$stmt = $sqlConn->prepare($sel);    $stmt->execute();
$stmt->store_result();  $stmt->bind_result($id,$dept,$note);

?>

<html>
<head>
    <title>test data table</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="js/data.js"></script>
    <script src="js/b4-dataTable.js"></script>

</head>
<body>
<br>
<div class="container">
    <table id="example" class="table" style="width:100%">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>部門</th>
            <th>備註</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $stmt->fetch()){
            echo "<tr><td>{$id}</td><td>{$dept}</td><td>{$note}</td></tr>";
        }
        ?>
        </tbody>

    </table>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
</body>
</html>
