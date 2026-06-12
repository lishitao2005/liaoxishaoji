<?php
session_start();
$num = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo $num;
?>