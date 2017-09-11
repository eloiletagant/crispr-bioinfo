<?php
session_start();
$seq = $_POST['seq'];
$_SESSION['res'] = file_get_contents("https://crispr.dbcls.jp/?format=json&userseq=" . $seq);
?>
