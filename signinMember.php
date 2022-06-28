<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php
    include("connectDB.php");

    if(!empty($_POST['loginID']) AND !empty($_POST['pwd'])){
        $login_id = $_POST['loginID'];
        $pwd = $_POST['pwd'];
    } else{
        header('Location: signin.php');
    }

    $response = $db->prepare("SELECT login_id, pwd FROM member WHERE login_id = :login_id");
    $response->execute(array(
        'login_id' => $login_id
    ));    
    $data = $response->fetch(PDO::FETCH_ASSOC);
    $response->closeCursor();

    if(password_verify($pwd, $data['pwd'])) {
        $_SESSION['pseudo'] = $login_id;
        header('Location: member.php');
    } else {
        header('Location: signin.php?signin=false');
    }
?>