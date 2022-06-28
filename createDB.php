<?php
    // Creating db & tables
    date_default_timezone_set('Asia/Seoul');
    $host = 'localhost';
    $root = 'root';
    $rootPwd = '';

    try{
        $link = new PDO("mysql:host=$host", $root, $rootPwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));   // double quotes essential here
    } catch(Exception $e){
        die('Error : '. $e->getMessage());
    }
    $forum = 'CREATE DATABASE IF NOT EXISTS forum';
    $link->exec($forum);
    // $forum = "CREATE DATABASE `$db`;
    // CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
    // GRANT ALL ON `$db`.* TO '$user'@'localhost';
    // FLUSH PRIVILEGES;"

    try{
        $db = new PDO("mysql:host=$host; dbname=forum; charset=utf8", $root, $rootPwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }catch(Exception $e){
        die('Error : '. $e->getMessage());
    }
    $member = 'CREATE TABLE IF NOT EXISTS member(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        login_id VARCHAR(255) NOT NULL,
        pwd VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        date_subscribed DATETIME NOT NULL
        )';
    $db->exec($member);
    $chat = 'CREATE TABLE IF NOT EXISTS chat(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_member INT(6) NOT NULL,
        message VARCHAR(255) NOT NULL,
        date_posted DATETIME NOT NULL,
        date_exp DATETIME NOT NULL
        )';
    $db->exec($chat);
?>