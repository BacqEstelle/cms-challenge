<?php

function show_user()
{

    if (isset($_GET['profile'])) {
        if (isset($_SESSION['login'])) {
            include("assets/inc/conn/db.php");
            $user = $_SESSION['login'];
            $get_user = $pdo->query("SELECT * FROM users WHERE user='$user'");
            $user = $get_user->fetch();
            $username = $user['user'];

            $userId = $user['id'];

            $get_post = $pdo->query("SELECT count(*) as total FROM posts WHERE from_id='$userId'");
            $post = $get_post->fetch();

            $get_comment = $pdo->query("SELECT count(*) as total FROM comments WHERE from_id='$userId'");
            $comment = $get_comment->fetch();

?>
            <div class="container mt-5">
                <h2 class="text-center">Profile : <?php echo $username ?></h2>
                <div class="card">
                    <div class="card-header">Your Stats</div>
                    <div class="card-body">
                        <fieldset>
                        Currently you have posted : <?php
                                                            echo $post['total'];

                                                            if ($post['total'] <= '1') {
                                                                echo " post";
                                                            } else {
                                                                echo " posts";
                                                            }
                                                            ?>

                        </fieldset>
                        <fieldset>
                        Currently you have posted : <?php
                                                            echo $comment['total'];

                                                            if ($comment['total'] <= '1') {
                                                                echo " comment";
                                                            } else {
                                                                echo " comments";
                                                            }
                                                            ?>

                        </fieldset>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Informations</div>
                    <div class="card-body">
                        <p>Username : <?php echo $username ?></p>
                        <p>Created date : <?php echo $user['created_at'] ?></p>
                        <p>Your rank: <?php echo $user['statut']?></p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">Change Your Password</div>
                    <div class="card-body">

                        <form method="POST" class="updatepassword" onsubmit="return checkForm(this);">

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="pwd1">
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password:</label>
                                <input class="form-control" type="password" name="pwd2">
                            </div>

                            <input type="submit" name="updatepassword" class="btn btn-primary btn-block"></input>
                        </form>

                    </div>
                </div>

    <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["updatepassword"])) 
            {
                $password = filter_var($_POST['pwd1'],FILTER_SANITIZE_STRING);
                if (empty($_POST["pwd1"])) { 
                    echo "<p>* Please enter a password.</p>";
                }
                else {
                    
                    $password = sha1($password);
                    $req = $pdo->prepare("UPDATE users SET pwd='$password' WHERE user='$username'");               
                    $req->execute();

                    echo '<body onLoad="alert(\'Your password has been modify\')">';
                }
            }
        } else {
            echo '<body onLoad="alert(\'Access not authorized.\')">';
            echo "<script>window.open('index.php?login','_self')</script>";
            
        }
    }
}
    ?>