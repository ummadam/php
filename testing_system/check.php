<?php

session_start();
if(isset($_POST)){
    $_SESSION['answers'][] = $_POST;

}

if(isset($_SESSION['answers'][4])){
    $_SESSION['result'] = 0;
    if($_SESSION['answers'][0]['q'] == 'a3'){
        $_SESSION['result']++;
    }
    if($_SESSION['answers'][1]['q'] == 'a2'){
        $_SESSION['result']++;
    }
    if($_SESSION['answers'][2]['q'] == 'a2'){
        $_SESSION['result']++;
    }
    if($_SESSION['answers'][3]['q'] == 'a4'){
        $_SESSION['result']++;
    }
    if($_SESSION['answers'][4]['q'] == 'a2'){
        $_SESSION['result']++;
    }
}
header('Location: /');


?>