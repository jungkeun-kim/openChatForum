<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your forum account</title>
    <style>
        form label{
            display: block;
        }
    </style>
</head>
<body>
    <form action="signupMember.php" method="post">
        <label for="loginID">ID: <input type="text" name="loginID" id="loginID"></label>
        <label for="pwd">Password: <input type="password" name="pwd" id="pwd"></label>
        <label for="pwdRe">Confrim Password: <input type="password" name="pwdRe" id="pwdRe"></label>
        <label for="email">Email: <input type="text" name="email" id="email"></label>
        <input type="submit" value="Sign Up">
    </form>
</body>
<?php
    if(isset($_GET['signup']) AND $_GET['signup']==='false'){
        echo "<script>alert('This ID is already taken. Please choose a new one!');</script>";
    }
?>
<script type="text/javascript">
    document.querySelector('form').addEventListener('submit', function(e){
        e.preventDefault();
        let inputs = document.querySelectorAll('input');
        let emailRegex = /^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;  // # at the beginning & end MESSED THIS UP
        for(let i=0; i<inputs.length; i++){
            if(!inputs[i].value){
                alert("You must fill out every field to sign up");
                return;
            }
        }
        if(inputs[1].value!==inputs[2].value){
            alert("Password confirm does not match your password");
            return;
        } else if(!emailRegex.test(inputs[3].value)){
            alert("Your email address is not valid");
        } else{
            e.target.submit();
        }
    });
</script>
</html>