<?php
session_start();
$data = $_SESSION['data'];
echo $data->user;