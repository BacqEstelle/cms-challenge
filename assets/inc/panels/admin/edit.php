<?php
if (isset($_GET['edit_post'])) {

    if ($_SESSION['statut'] != "admin" ) 
    {
        echo "<script>window.open('index.php','_self')</script>";
        echo '<body onLoad="alert(\'Access not authorized.\')">';
    }
    else 
    {


include('function.php');
edit_post();

}
}else {
    echo "<script>window.open('index.php','_self')</script>";
    echo '<body onLoad="alert(\'Access not authorized.\')">';
}
?>