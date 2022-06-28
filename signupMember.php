<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<?php
    if(!empty($_POST['loginID']) AND !empty($_POST['pwd']) AND !empty($_POST['pwdRe']) AND !empty($_POST['email'])){
        $loginID = addslashes(htmlspecialchars(htmlentities(trim($_POST['loginID']))));
        $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $email = addslashes(htmlspecialchars(htmlentities(trim($_POST['email']))));
    } else{
        header('Location: signup.php');
    }

    if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){
        null;
    } else{
        header('Location: signup.php');
    }

    include("connectDB.php");

    // Checking if the login_id is already taken
    $response = $db->prepare("SELECT login_id FROM member WHERE login_id = :login_id");
    $response->execute(array('login_id' => $loginID));
    $match = $response->fetch(PDO::FETCH_ASSOC);
    $response->closeCursor();
    if(isset($match['login_id'])){
        header('Location: signup.php/?signup=false');
    } else{
        // Apparently this code MUST be inside the else condition, otherwise it may get executed regardless of the first if condition ???
        $response = $db->prepare("INSERT INTO member(login_id, pwd, email, date_subscribed) VALUES(:login_id, :pwd, :email, NOW())");
        $response->execute(array(
            'login_id' => $loginID,
            'pwd' => $pwd,
            'email' => $email
        ));
        header('Location: signin.php?signup=true');
    }

?>