<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
echo "<pre>";
echo "REQUEST_METHOD  = " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "POST recebido   = "; print_r($_POST);
echo "</pre>";
