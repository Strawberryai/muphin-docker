<form action="sign_in.php" method="POST">
    <label for="fname">First name:</label><br>
    <input type="text" id="fname" name="fname" value="John"><br>
    <label for="lname">Last name:</label><br>
    <input type="text" id="lname" name="lname" value="Doe"><br><br>
    <input type="submit" value="Submit">
</form>

<?php
  echo '<h1>Yeah, it works!<h1>';
  // phpinfo();

  require 'data_base.php';
  $db = database::getInstance();

  $res = $db->comprobar_identidad("Mikel001", "test");
  $mss = $res ? 'true' : 'false';

  echo "<p>" . $mss . "</p>"
  

?>
