<?php

function login()
{


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"]) && isset($_POST["pwd"])) {
        include("assets/inc/conn/db.php");
        $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['pwd'],FILTER_SANITIZE_STRING);     
        $get_user = $pdo->query("SELECT * FROM users WHERE user='$username'");
        $user = $get_user->fetch();

        if($username == $user['user'] && sha1($password) == $user['pwd'])
        {
            session_start();
            $_SESSION['login'] = $user['user'];
            $_SESSION['statut'] = $user['statut'];

            echo "<script>window.open('index.php?index','_self')</script>";
            echo '<body onLoad="alert(\'Vous êtes maintenant connecté.\')">';

        };

    };
}
function logout(){

    unset($_SESSION['login']);
    unset($_SESSION['statut']);
    // Finally, destroy the session.    
    session_destroy();
    
    echo "<script>window.open('index.php?index','_self')</script>";
    echo '<body onLoad="alert(\'Vous êtes maintenant déconnecté.\')">';
}