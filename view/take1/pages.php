<?php
if (!$result) {
    return;
}
?>

<table class="table table-striped table-hover ">
  <thead>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($result as $row) :
?>
    <tr>
        <td><?= $row->id ?></td>
        <td><a href="<?= $page ?>?path=<?= $row->path ?>"><?= $row->title ?></a></td>
        <td><?= $row->type ?></td>
        <td><?= $row->status ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
