<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<?php
    // if(!isset($_COOKIE['pseudo'])) setcookie('pseudo', 'pseudo', time() + 24*3600, false, false, false, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Chat</title>
    <style>
        #chatWindow span{
            display: none;
        }
        #chatWindow{
            width: 500px;
        }
        /* .myChat{
            text-align: right;
        } */
    </style>
</head>
<body>
    <div id="mainContainer">
        <form action="" method="post">
            <input type="hidden" name="limit" id="limit" value="2">
            <div>
                <label for="pseudo">Pseudo :</label>
                <input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_SESSION['pseudo'])){ echo $_SESSION['pseudo']; } else{ echo 'Stranger'; } ?>" readOnly>
            </div>
            <div>
                <label for="message">Message :</label>
                <input type="text" name="message" id="message">
            </div>
            <div>
                <button type="submit" id="send">Send</button>
            </div>
            <div>
                <button type="button" id="refresh">Refresh</button>
                <!-- <button type="button" id="showMore">Show More</button> -->
            </div>
        </form>
        <p id="showMessages"></p>
        <div id="chatWindow">
            <?php
                // if(!isset($_SESSION['chat'])){
                //     echo '<p>Why don\'t you start the chat?</p>';
                // }
            ?>
        </div>
    </div>

    <script type="text/javascript">
        function chat(pseudo, message){
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'chat.php');
            xhr.addEventListener('load', function(e){
                if(xhr.status === 200){
                    document.querySelector('#chatWindow').innerHTML = xhr.responseText;
                    document.querySelector('#showMore').addEventListener('click', function(e){
                        let limit = document.querySelector('#limit');
                        limit.value = parseInt(limit.value) + 2;
                        chat();
                        // querySelector passes by reference, but .value passes by value !
                        // recursive function ? and is it a new 'a' element every time ?
                    });
                } else{
                    // error
                }
            });
            let data = new FormData();
            let limit = document.querySelector('#limit').value;
            data.append('limit', encodeURIComponent(limit));
            if(pseudo && message){
                data.append('pseudo', encodeURIComponent(pseudo));
                data.append('message', encodeURIComponent(message));
            }
            xhr.send(data);
        }

        // Display the chat by calling the chat function upon loading the page
        chat();

        document.querySelector('form').addEventListener('submit', function(e){
            e.preventDefault();
            let inputs = document.querySelectorAll('input');
            for(let i=0; i<inputs.length; i++){
                if(!inputs[i].value){
                    alert("Say something to join the chat!");
                    return;
                }
            }
            let pseudo = document.querySelector('#pseudo').value;
            let message = document.querySelector('#message').value;
            chat(pseudo, message);
        });
    </script>
    <!-- NOTE: disabled input is NOT sent through post, NOR its value selected as FormData -->
</body>
</html>