<?php

$user_loggedin = "";
$app->session->start();
// Make sure no one is logged in
if ($app->session->has("name")) {
    echo "<p>You are already logged in as " . $app->session->get('name') . "</p>";
    echo "<p><a href='$logout'>Logout</a></p>";
    echo "<p>Go to <a href='$profile'>profile</a> </p>";
    $user_loggedin = "disabled";
}

?>
<div class="row">
<div class="col-lg-8">
<form action="<?= $validate ?>" method="POST" class="form-horizontal">
  <fieldset>
    <legend>Login</legend>
    <div class="form-group">
      <label for="inputName" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" name="name"  id="inputName" placeholder="username" class="form-control" <?=$user_loggedin?>>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="pass" <?=$user_loggedin?>>
      </div>
    </div>
    <div class="form-group">
     <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" name="submitForm" class="btn btn-primary" value="Login" <?=$user_loggedin?>>
    </div>
   </div>
 </fieldset>
</form>
<a href="<?= $create ?>"class="btn btn-danger">Create User</a>
</div>
</div>
