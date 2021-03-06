<div class="tab-pane fade active in" id="createproduct">
<div class="row">
<div class="col-lg-8">
<form action="<?= $handle ?>" method="POST" class="form-horizontal">
  <fieldset>
    <legend>Add Product</legend>
    <input type="hidden" name="userName" value="<?= $userName ?>">
    <div class="form-group">
      <label for="inputDescription" class="col-lg-2 control-label">Name</label>
      <div class="col-lg-10">
        <input type="text" name="description"  id="inputDescription" placeholder="description" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="inputImg" class="col-lg-2 control-label">Image</label>
      <div class="col-lg-10">
        <input type="text" name="image"  id="inputImg" placeholder="In case of no image, type noimage" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="price" class="col-lg-2 control-label">Price</label>
      <div class="col-lg-10">
        <input type="number" class="form-control" id="price" name="price" placeholder="Price">
      </div>
    </div>
    <div class="form-group">
      <label for="status" class="col-lg-2 control-label">Status</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="status" name="status" placeholder="In store or Not in store">
      </div>
    </div>
    <div class="form-group">
    <label class="col-lg-2 control-label">Category</label>
    <div class="col-lg-10">
      <div class="radio">
        <label>
          <input type="radio" name="category" id="optionsRadios1" value="1" checked="">
          Console
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="category" id="optionsRadios2" value="2">
          Game
        </label>
      </div>
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
</div>
</div>
