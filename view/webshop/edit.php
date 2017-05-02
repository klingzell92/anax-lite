<div class="tab-pane fade active in" id="createproduct">
<div class="row">
<div class="col-lg-8">
<form action="<?= $handle ?>" method="POST" class="form-horizontal">
  <fieldset>
    <legend>Add Product</legend>
    <input type="hidden" name="id" value="<?= $result->id ?>">
    <div class="form-group">
      <label for="inputDescription" class="col-lg-2 control-label">Name</label>
      <div class="col-lg-10">
        <input type="text" name="description"  id="inputDescription" value="<?= $result->description ?>" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="inputImg" class="col-lg-2 control-label">Image</label>
      <div class="col-lg-10">
        <input type="text" name="image"  id="inputImg" value="<?= $result->image ?>" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="price" class="col-lg-2 control-label">Price</label>
      <div class="col-lg-10">
        <input type="number" class="form-control" id="price" name="price" value="<?= $result->price ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="status" class="col-lg-2 control-label">Status</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="status" name="status" value="<?= $result->status ?>">
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
      <input type="submit" name="submitCreateForm" value="Save" class="btn btn-success">
    </div>
   </div>
 </fieldset>
</form>
<a href="<?= $delete ?>?id=<?= $result->id ?>" class="btn btn-warning">Delete</a>
<a href='<?= $admin ?>' class="btn btn-primary">Back to admin</a>
</div>
</div>
</div>
</div>
