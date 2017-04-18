<div class="row">
<div class="col-lg-8">
<form method="get" class="form-horizontal">
  <fieldset>
    <legend>Search</legend>
    <div class="form-group">
      <label for="search" class="col-lg-2 control-label">Use % as wildcard</label>
      <div class="col-lg-10">
        <input type="search" name="searchName"  id="search"  value="<?= $searchName ?>" class="form-control">
      </div>
    </div>
    <div class="form-group">
     <div class="col-lg-10 col-lg-offset-2">
      <input type="submit" name="doSearch" value="Search" class="btn btn-success">
    </div>
   </div>
 </fieldset>
</form>


<?php
if (!$result == "") {
?>
<table class="table table-striped table-hover ">
<thead>
  <tr>
      <th>id</th>
      <th>Username</th>
      <th>Email</th>
      <th>Edit</th>
  </tr>
</thead>
<tbody>
<?php
foreach ($result as $row) {
?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->name ?></td>
        <td><?= $row->email ?></td>
        <td><a href="<?= $edit ?>?name=<?= $row->name ?>">Edit</a></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<a href='<?= $admin ?>' class="btn btn-primary">Back to admin</a>
</div>
</div>
