<?php
if (!$result) {
    return;
}
?>
<div class="tab-pane fade active in" id="overview">
<legend> Inventory </legend>
<table class="table table-striped table-hover ">
  <thead>
    <tr class="first">
        <th>Shelf</th>
        <th>Location</th>
        <th>Items</th>
        <th>Description</th>
        <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $row) :
?>
    <tr>
        <td><?= $row->shelf ?></td>
        <td><?= $row->location ?></td>
        <td><?= $row->items ?></td>
        <td><?= $row->description ?></td>
        <td><a href="<?= $edit ?>?id=<?= $row->id ?>">Edit</a></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
<legend> Low Inventory Log</legend>
<table class="table table-striped table-hover ">
  <thead>
    <tr class="first">
        <th>Id</th>
        <th>Items</th>
        <th>Occured</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($log as $row) :
?>
    <tr>
        <td><?= $row->prod_id ?></td>
        <td><?= $row->amount ?></td>
        <td><?= $row->when ?></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
