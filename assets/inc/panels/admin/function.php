<?php

function display_post()
{

    include("assets/inc/conn/db.php");
    $get_posts = $pdo->query("SELECT * FROM posts");
    while ($all_posts = $get_posts->fetch()) {
?>
        <ul class="list-group">
            <tr>
                <td><?php echo $all_posts['id'] ?></td>
                <td><?php echo $all_posts['title'] ?></td>
                <td>
                    <a href="index.php?edit_post=<?php echo $all_posts['id'] ?>"><i class="fas fa-edit"></i></a>
                
                
                </td>
                <td>
                    <a href="index.php?admin&delete=<?php echo $all_posts['id'] ?>"><i class="fas fa-times"></i></a>
                </td>
            </tr>
        </ul>
<?php


    }
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        echo $id;
        $delete = $pdo->prepare("DELETE FROM posts WHERE id='$id'");
        if ($delete->execute()) {
            echo "<script>alert('Post Delete with Success')</script>";
            echo "<script>window.open('index.php?admin','_self')</script>";
        } else {
            echo "<script>alert('Post not Delete with Success')</script>";
            echo "<script>window.open('index.php?admin','_self')</script>";
        }
    }
}


function add_post()
{
    





        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["addpost"])) {
            include("assets/inc/conn/db.php");
            $user = $_SESSION['login'];
            $get_user = $pdo->query("SELECT * FROM users WHERE user='$user'");
            $user = $get_user->fetch();
            $userId = $user['id'];


            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $template = filter_var($_POST['template'], FILTER_SANITIZE_NUMBER_INT);
            $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
            $date = date("Y-m-d");

            $folder = $_SERVER["DOCUMENT_ROOT"] . "/blog/assets/uploads/img/";
            $maxsize =  100000;
            $image = $_FILES['image']['name'];
            $unique = uniqid();
            $rename = $unique;
            $path = $folder . $rename;
            $target_file = $folder . basename($_FILES["image"]["name"]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


            $allowed = array('jpeg', 'png', 'jpg', 'gif');
            $filename = $_FILES['image']['name'];

            $pathInfo = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($pathInfo, $allowed)) {

                echo '<script> alert("Désolé, les formats JPG, JPEG, PNG & GIF  sont seulement autorisé.")</script>';
            }

            if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                echo '<script> alert("Votre fichier est trop gros. La taille max est de 100Ko")</script>';
            } else {

                move_uploaded_file($_FILES['image']['tmp_name'], $path);





                $reponse = $pdo->prepare('INSERT INTO posts(title, template, img, text, from_id, created_at ) VALUES(:title, :template, :img, :text, :from_id, :created_at)');
                $reponse->execute(array(
                    'title' => $title,
                    'template' => $template,
                    'img' => $rename,
                    'text' => $text,
                    'from_id' => $userId,
                    'created_at' => $date,
                ));
                echo "<script>window.open('index.php?admin','_self')</script>";
                echo '<body onLoad="alert(\'You post is created.\')">';
            }
        }

}



function edit_post()
{
    include("assets/inc/conn/db.php");
    $id = $_GET['edit_post'];       
    $get_post = $pdo->query("SELECT * FROM posts WHERE id='$id'");
    $post = $get_post->fetch();

    ?>
<div class="container mt-3">
<h3>Edit Post</h3>
<form method="POST" class="editpost" enctype="multipart/form-data">
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['title']?>">
</div>
<div class="form-group">
    <label for="inputState">Template</label>
    <select id="inputState" class="form-control" name="template">
        <option selected><?php echo $post['template']?></option>
        <option value="1">1</option>
        <option value="2">2</option>
    </select>
</div>



<div class="form-group">
    <img src="assets/uploads/img/<?php echo $post['img']?>" width="50px" height="50px"/>
    <label for="img">Image Upload</label>
    
    <input type="file" accept='image/*' class="form-control-file" id="img" name='image' value="<?php echo $post['image']?>">
</div>

<div class="form-group">
    <label for="text">Text</label>
    <textarea class="form-control" id="text" rows="10" name="text"><?php echo $post['text']?></textarea>
</div>
<input type="submit" name="editpost" class="btn btn-primary btn-block"></input>
</form>
</div>
<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["editpost"])) {
            
            $user = $_SESSION['login'];
            $get_user = $pdo->query("SELECT * FROM users WHERE user='$user'");
            $user = $get_user->fetch();
            $userId = $user['id'];






            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $template = filter_var($_POST['template'], FILTER_SANITIZE_NUMBER_INT);
            $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
            $date = date("Y-m-d");

            $folder = $_SERVER["DOCUMENT_ROOT"] . "/blog/assets/uploads/img/";
            $maxsize =  100000;
            $image = $_FILES['image']['name'];
            $unique = uniqid();
            $rename = $unique;
            $path = $folder . $rename;
            $target_file = $folder . basename($_FILES["image"]["name"]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


            $allowed = array('jpeg', 'png', 'jpg', 'gif');
            $filename = $_FILES['image']['name'];

            $pathInfo = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($pathInfo, $allowed)) {

                echo '<script> alert("Désolé, les formats JPG, JPEG, PNG & GIF  sont seulement autorisé.")</script>';
            }

            if (($_FILES['image']['size'] >= $maxsize) || ($_FILES["image"]["size"] == 0)) {
                echo '<script> alert("Votre fichier est trop gros. La taille max est de 100Ko")</script>';
            } else {

                move_uploaded_file($_FILES['image']['tmp_name'], $path);



                $req = $pdo->prepare("UPDATE posts SET title='$title', template='$template', img='$rename', text='$text', from_id='$userId', modified_at='$date' WHERE id='$id'");               
                $req->execute();

                echo "<script>window.open('index.php?admin','_self')</script>";
                echo '<body onLoad="alert(\'You post is modify.\')">';
            }
        }

}