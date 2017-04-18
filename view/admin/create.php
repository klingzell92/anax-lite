<div class="row">
<div class="col-lg-8">
<form action="<?= $handle ?>" method="POST" class="form-horizontal">
  <fieldset>
    <legend><?=$status?></legend>
    <input type="hidden" name="userName" value="<?= $userName ?>">
    <div class="form-group">
      <label for="inputName" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
        <input type="text" name="new_name"  id="inputName" placeholder="username" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="email" name="new_email"  id="inputEmail" placeholder="email" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-lg-2 control-label">New Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="password" name="new_pass" placeholder="New Password">
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
      <input type="submit" name="submitCreateForm" value="Create" class="btn btn-success">
    </div>
   </div>
 </fieldset>
</form>
<a href='<?= $admin ?>' class="btn btn-primary">Back to admin</a>
</div>
</div>
