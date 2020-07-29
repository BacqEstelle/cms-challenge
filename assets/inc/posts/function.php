<?php

function view_posts()
{

    include("assets/inc/conn/db.php");
    $get_posts = $pdo->query("SELECT * FROM posts");
    while ($all_posts = $get_posts->fetch()) {
        $text = $all_posts['text'];
        echo "<div class='col mb-4'>";
        echo "<div class='card'>";
        echo "<img src='assets/uploads/img/".$all_posts['img']."' class='card-img-top' alt='".$all_posts['title']."'/>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>".$all_posts['title']."</h5>";
        echo "<p class='card-text'>".substr($text,0,100)."</p>";
        echo "</div>";
        echo "<div class='card-footer'>";
        echo "<a class='btn btn-light' href='index.php?post=".$all_posts['id']."' role='button'>Read More ...</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";


    };
}

function show_post()
{
    if (isset($_GET['post'])) {
        $bdd = include("assets/inc/conn/db.php");        
        $id = $_GET['post'];       
        $get_post = $pdo->query("SELECT * FROM posts WHERE id='$id'");
        $post = $get_post->fetch();
        

// Verifie que le post existe

        if(empty($post['id']))
        {   
            echo "<div class='container mt-5'>";
            echo "Ce post n'existe pas";
            echo "</div>";
        }
        else {
            //  Template 1   
        if($post['template'] == 1)
        {
?>
        <div class="container mt-5">
            <h1><?php echo $post['title']?></h1>
            <div class="row mt-5">
            <div class="col-2"><img src="assets/uploads/img/<?php echo $post['img'] ?>" alt="<?php echo $post['title'] ?>"/></div>
            <div class="col-10"><?php echo $post['text'] ?></div>
            </div>
        </div>
<?php          
        }
// Template 2
        if($post['template'] == 2)
        {
            ?>
        <div class="container mt-5">
            <h1><?php echo $post['title']?></h1>
            <div class="row mt-5">
            <div class="col-10"><?php echo $post['text'] ?></div>
            <div class="col-2"><img src="assets/uploads/img/<?php echo $post['img'] ?>" alt="<?php echo $post['title'] ?>"/></div>
            </div>
        </div>
<?php   
        }
        }




    
    
        
    }
}
