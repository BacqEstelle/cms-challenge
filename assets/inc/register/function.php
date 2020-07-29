<?php 

function register(){
    try
    {
    include("assets/inc/conn/db.php");
    if ( $_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST["register"]) ) { 
        $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['pwd1'],FILTER_SANITIZE_STRING);
        $statut = "user";
        $date = date("Y-m-d");
        if (empty($_POST["username"])) 
        { 
                    echo "<p>* Veuillez entrer un pseudo.</p>";
                    return;
        }
        elseif (empty($_POST["pwd1"])) 
        { 
            echo "<p>* Veuillez entrer un mot de passe.</p>";
            return;
        }   
        else 
        {
            $req = $pdo->prepare('INSERT INTO users(user, pwd, statut, created_at) VALUES(:user, :pwd, :statut, :created_at)');
            $req->execute(array(
                'user' => $username,
                'pwd' => sha1($password),
                'statut' => $statut,
                'created_at' => $date,
                ));

                echo "<script>window.open('index.php?login','_self')</script>";
                echo '<body onLoad="alert(\'Votre compte a été créé.\')">';
                
        }
    }

}    catch (Exception $e) {
    if ($e->errorInfo[1] === 1062) {
        echo "<script>alert('UserName already exist')</script>";
        echo "<script>window.open('index.php?register','_self')</script>";
    }
}

}