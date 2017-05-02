<?php
if (!$result) {
    return;
}
?>
<div class="tab-pane fade active in" id="overview">
<table class="table table-striped table-hover ">
  <thead>
    <tr class="first">
        <th>Id</th>
        <th>Description</th>
        <th>Price</th>
        <th>Status</th>
        <th>Category</th>
        <th>Image</th>
        <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $row) :
?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->description ?></td>
        <td><?= $row->price ?></td>
        <td><?= $row->status ?></td>
        <td><?= $row->category ?></td>
        <td><img src="../../img/<?= $row->image ?>" class="mesmall" alt="Bild på Philip"></td>
        <td><a href="<?= $edit ?>?id=<?= $row->id ?>">Edit</a></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
