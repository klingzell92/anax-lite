<div class="row">
<div class="col-lg-8">
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
<a href='<?= $profile ?>' class="btn btn-primary">Back to profile</a>
</div>
</div>
