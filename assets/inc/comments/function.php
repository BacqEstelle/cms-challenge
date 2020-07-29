<?php

function show_comments()
{
    if (isset($_GET['post'])) {
        $bdd = include("assets/inc/conn/db.php");
        $id = $_GET['post'];
        $get_comments = $pdo->query("SELECT * FROM comments WHERE post_id='$id'");
        while ($all_comments = $get_comments->fetch()) {
            $userId = $all_comments['from_id'];
            $get_users = $pdo->query("SELECT * FROM users WHERE id='$userId'");
            while ($all_users = $get_users->fetch()) {
?>
                <div class="card my-3">
                    <div class="card-header">
                        <?php echo $all_users['user']; ?>
                    </div>
                <?php
            };
                ?>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><?php echo $all_comments['text'] ?></li>
                </ul>
                </div>

            <?php
        };
    }
}

function add_comment()
{
    if (isset($_GET['post'])) {
        if (isset($_SESSION['login'])) {
            ?>
            <form method="POST" class="updatepassword">
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                </div>
                <input type="submit" name="sendcomment" class="btn btn-primary btn-block"></input>
        </form>
    <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["sendcomment"])) 
            {
                $comment = filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
                if (empty($_POST["comment"])) { 
                    echo "<p>* Please enter a comment.</p>";
                }
                else {
                    
                    include("assets/inc/conn/db.php");
                    $id = $_GET['post'];       
                    $get_post = $pdo->query("SELECT * FROM posts WHERE id='$id'");
                    $post = $get_post->fetch();
                    $post_id = $post['id'];

                    $user = $_SESSION['login'];
                    $get_user = $pdo->query("SELECT * FROM users WHERE user='$user'");
                    $user = $get_user->fetch();
                    $from_id = $user['id'];
                    $date = date("Y-m-d");

                    $req = $pdo->prepare('INSERT INTO comments(text, from_id, post_id, created_at) VALUES(:text, :from_id, :post_id, :created_at)');
                    $req->execute(array(
                        'text' => $comment,
                        'from_id' => $from_id,
                        'post_id' => $post_id,
                        'created_at' => $date,
                        ));
        
                        echo '<body onLoad="alert(\'Your comment is send.\')">';
                        echo "<script>window.open('index.php?post=".$id."','_self')</script>";
                }
            }
        } else {
            echo 'vous devez être connecté pour publier un commentaire';
        }
    }
}
