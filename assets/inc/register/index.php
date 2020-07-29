<?php
include('function.php');

register();

?>


<div class="container mt-5">

  <div class="login-form">
    <form method="POST" class="register" onsubmit="return checkForm(this);">
      <h2 class="text-center">Register</h2>
      <div class="form-group">
        <label for="username">UserName</label>
        <input class="form-control" type="text" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="pwd1">
      </div>
      <div class="form-group">
        <label for="password">Confirm Password:</label>
        <input class="form-control" type="password" name="pwd2">
      </div>

      <input type="submit" name="register" class="btn btn-primary btn-block"></input>
    </form>
  </div>
</div>

<script type="text/javascript">
  function checkPassword(str) {
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
    return re.test(str);
  }

  function checkForm(form) {
    if (form.username.value == "") {
      alert("Error: Username cannot be blank!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    if (!re.test(form.username.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return false;
    }
    if (form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
      if (!checkPassword(form.pwd1.value)) {
        alert("The password you have entered is not valid!");
        form.pwd1.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.pwd1.focus();
      return false;
    }
    return true;
  }
</script>