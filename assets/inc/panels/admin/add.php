<?php
if (isset($_GET['create_post'])) {

    if ($_SESSION['statut'] != "admin" ) 
    {
        echo "<script>window.open('index.php','_self')</script>";
        echo '<body onLoad="alert(\'Access not authorized.\')">';
    }
    else 
    {


include('function.php');
add_post();
?>
<div class="container mt-3">
    <h3>Add a Post</h3>
    <form method="POST" class="register" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="inputState">Template</label>
            <select id="inputState" class="form-control" name="template">
                <option selected>Choose...</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>



        <div class="form-group">
            <label for="img">Image Upload</label>
            <input type="file" accept='image/*' class="form-control-file" id="img" name='image'>
        </div>

        <div class="form-group">
            <label for="text">Text</label>
            <textarea class="form-control" id="text" rows="10" name="text"></textarea>
        </div>
        <input type="submit" name="addpost" class="btn btn-primary btn-block"></input>
    </form>
</div>

<?php
}
}else {
    echo "<script>window.open('index.php','_self')</script>";
    echo '<body onLoad="alert(\'Access not authorized.\')">';
}
?>