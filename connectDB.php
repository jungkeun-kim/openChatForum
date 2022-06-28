<?php
    date_default_timezone_set('Asia/Seoul');
    $host = 'localhost';
    $root = 'root';
    $rootPwd = '';
    try{
        $db = new PDO("mysql:host=$host; dbname=forum; charset=utf8", $root, $rootPwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e){
        die('Error : '. $e->getMessage());
    }
?>