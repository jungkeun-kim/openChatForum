<?php if(session_status() === PHP_SESSION_NONE) session_start(); $_SESSION['member'] = "jk"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign into your forum account</title>
    <style>
        form label{
            display: block;
        }
    </style>
</head>
<body>
    <form action="signinMember.php" method="post">
        <label for="loginID">ID: <input type="text" name="loginID" id="loginID"></label>
        <label for="pwd">Password: <input type="password" name="pwd" id="pwd"></label>
        <input type="submit" value="Sign In">
    </form>
</body>
<?php
    if(isset($_GET['signup']) AND $_GET['signup']==='true'){
        echo "<script>alert('Thank you for signing up!');</script>";
    }
    if(isset($_GET['signin']) AND $_GET['signin']==='false'){
        echo "<script>alert('Wrong ID or password!');</script>";
    }
?>
<script type="text/javascript">
    document.querySelector('form').addEventListener('submit', function(e){
        e.preventDefault();
        let inputs = document.querySelectorAll('input');
        for(let i=0; i<inputs.length; i++){
            if(!inputs[i].value){
                alert("Enter your credentials to sign in");
                return;
            }
        }
        e.target.submit();
    });
</script>
</html>