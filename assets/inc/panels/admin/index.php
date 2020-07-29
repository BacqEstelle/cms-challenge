<?php

if ($_SESSION['statut'] === "admin" && isset($_GET['admin'])) {


?>

<div class="container mt-3">
    <h3>List of posts</h3>
    <button type="button" class="btn btn-secondary btn-lg btn-block"><a class="text-light" href="index.php?create_post">Add new post</a></button>
    <table>
        <tr>
            <th>Sr No.</th>
            <th>Post Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
    include('function.php');
    display_post();
    ?>
    </table>


</div>
<?php

}else {
    echo "<script>window.open('index.php','_self')</script>";
    echo '<body onLoad="alert(\'Access not authorized.\')">';
}
?>