<?php session_start(); 


?>
<?php include ('assets/inc/template/header.php') ?>
    <section>
        <?php 
        if(isset($_GET['post']))
        {
            include('assets/inc/posts/show.php');
        }
        elseif(isset($_GET['register']))
        {
            include('assets/inc/register/index.php');
        }
        elseif(isset($_GET['login']))
        {
            include('assets/inc/login/login.php');
        }
        elseif(isset($_GET['logout']))
        {
            include('assets/inc/login/logout.php');
        }
        elseif(isset($_GET['profile']))
        {
            include('assets/inc/panels/profile/index.php');
        }
        elseif(isset($_GET['admin']))
        {
            include('assets/inc/panels/admin/index.php');
        }
        elseif(isset($_GET['create_post']))
        {
            include('assets/inc/panels/admin/add.php');
        }
        elseif(isset($_GET['edit_post']))
        {
            include('assets/inc/panels/admin/edit.php');
        }
        else{

            include('assets/inc/posts/index.php') ;

        };

        
        ?>
    </section>

<?php include ('assets/inc/template/footer.php') ?>