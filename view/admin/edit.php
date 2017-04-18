<div class="row">
<div class="col-lg-4 col-lg-offset-1">
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
</div>

<div class="col-lg-4 col-lg-offset-1 ">
<form action="<?= $change ?>" method="POST" class="form-horizontal">
  <fieldset>
    <legend><?=$status?></legend>
    <input type="hidden" name="userName" value="<?= $userName ?>">
    <div class="form-group">
      <label for="oldPassword" class="col-lg-2 control-label">Old Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="oldPassword" name="old_pass" placeholder="Old Password">
      </div>
    </div>
    <div class="form-group">
      <label for="newPassword" class="col-lg-2 control-label">New Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="newPassword" name="new_pass" placeholder="New Password">
      </div>
    </div>
    <div class="form-group">
      <label for="rePassword" class="col-lg-2 control-label">Re enter Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="rePassword" name="re_pass" placeholder="Re enter Password">
      </div>
    </div>
    <div class="form-group">
     <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" name="submitForm" value="Change password" class="btn btn-success">
    </div>
   </div>
 </fieldset>
</form>
</div>
</div>
<div class="panel panel-default">
  <div class="panel-body">
  <h4>Delete User</h4>
  <a href="<?= $delete ?>?name=<?= $name ?>"class="btn btn-danger">Delete</a>
  </div>
</div>

<a href='<?= $admin ?>' class="btn btn-primary">Back to admin</a>
