<div class="tab-pane fade active in" id="createproduct">
<div class="row">
<div class="col-lg-8">
<form action="<?= $handle ?>" method="POST" class="form-horizontal">
  <fieldset>
    <legend>Add Product</legend>
    <input type="hidden" name="id" value="<?= $result->prod_id ?>">
    <div class="form-group">
    <label class="col-lg-2 control-label">Shelf</label>
    <div class="col-lg-10">
      <div class="radio">
        <label>
          <input type="radio" name="shelf" id="optionsRadios1" value="AAA101" checked="">
          AAA101
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="shelf" id="optionsRadios2" value="AAA102">
          AAA102
        </label>
      </div>
      <div class="radio">
        <label>
          <input type="radio" name="shelf" id="optionsRadios3" value="None">
          None
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="items" class="col-lg-2 control-label">Amount of items</label>
    <div class="col-lg-10">
      <input type="number" class="form-control"  min="0" id="items" name="items" value="<?= $result->items ?>">
    </div>
  </div>
    <div class="form-group">
     <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" name="submitCreateForm" value="Save" class="btn btn-success">
    </div>
   </div>
 </fieldset>
</form>
<a href='<?= $admin ?>' class="btn btn-primary">Back to admin</a>
</div>
</div>
</div>
</div>
