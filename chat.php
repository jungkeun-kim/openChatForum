<?php
    if(session_status() === PHP_SESSION_NONE) session_start();

    include("connectDB.php");

    // Adding member input into the chat table IF the input exists
    if(!empty($_POST['pseudo']) AND !empty($_POST['message'])){
        $pseudo = strip_tags(urldecode($_POST['pseudo']));
        $message = strip_tags(urldecode($_POST['message']));
        
        $request = $db->prepare(
            'INSERT INTO chat(id_member, message, date_posted, date_exp)
            VALUES((SELECT id FROM member WHERE login_id = :login_id), :message, NOW(), DATE_ADD(NOW(), INTERVAL 2 MONTH))'
        );
        $request->execute(array(
            'login_id' => $pseudo,
            'message' => $message
        ));
        $request->closeCursor();
    }
    
    // Setting the variable referencing the number of chats the user wants to see
    $limit = $_POST['limit'];

    // Selecting the 3+ latest chats from db with their pseudo & message
    $response = $db->prepare("SELECT m.login_id AS pseudo, c.message AS message FROM chat c JOIN member m ON c.id_member = m.id ORDER BY date_posted DESC LIMIT {$limit}");
    // PHP variable should be concatenated inside the SQL query !!!
    $response->execute();
    $data = $response->fetchAll(PDO::FETCH_ASSOC);
    $response->closeCursor();

    foreach($data as $datum){
        echo "<p><strong>{$datum['pseudo']}: </strong>{$datum['message']}</p>";
    }
    echo "<a href='#' onclick='return false;' id='showMore'>show more</a>";
    
?>