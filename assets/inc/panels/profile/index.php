<?php 
include('function.php');
show_user();
?>


<script type="text/javascript">
function checkPassword(str) {
  var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
  return re.test(str);
}

function checkForm(form) {
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
