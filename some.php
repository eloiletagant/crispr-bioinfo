<?php
session_start();
$seq = $_POST['seq'];
$db = $_POST['db'];

$_SESSION['paramValues'] = $_POST['paramValues'];
$_SESSION['seq'] = $seq;
$_SESSION['res'] = file_get_contents("https://crispr.dbcls.jp/?db=" . $db . "&format=json&userseq=" . $seq);
?>
