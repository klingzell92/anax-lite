<div class="row">
<div class="col-lg-8">
<form action="<?= $handle ?>" method="POST" class="form-horizontal">
  <fieldset>
    <legend>Edit user</legend>
    <input type="hidden" name="userName" value="<?= $userName ?>">
    <div class="form-group">
      <label for="inputName" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
        <input type="text" name="new_name"  id="inputName"  value="<?= $name ?>" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="email" name="new_email"  id="inputEmail"  value="<?=$email?>" class="form-control">
      </div>
    </div>
    <div class="form-group">
     <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" name="submitEditForm" value="Edit" class="btn btn-success">
    </div>
   </div>
 </fieldset>
</form>
<a href='<?= $profile ?>' class="btn btn-primary">Back to profile</a>
</div>
</div>
