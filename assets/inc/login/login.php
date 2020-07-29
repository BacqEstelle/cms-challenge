<?php 
include('function.php');

login();

?>
<div class="login-form">
    <form action="" method="POST">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="pwd" required="required">
        </div>
        <div class="form-group">
            <button name="login" type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>      
    </form>
    <p class="text-center"><a href="index.php?register">Create an Account</a></p>
</div>

