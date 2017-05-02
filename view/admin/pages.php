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
        <th>Title</th>
        <th>Type</th>
        <th>Path</th>
        <th>Slug</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Edit</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $row) :
?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td><a href="<?= $edit ?>?id=<?= $row->id ?>">Edit</a></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
