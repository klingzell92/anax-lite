<ul class="nav nav-pills">
  <li><a href='<?= $logout ?>'>Logout</a></li>
  <li><a href='<?= $profile ?>'>Profile</a></li>
  <li><a href='<?= $create ?>'>Create</a></li>
  <li><a href='<?= $search ?>'>Search</a></li>
</ul>
<div class="panel panel-default">
  <div class="panel-body">
    <p>Items per page:
        <a href="<?= $app->login->mergeQueryString(["hits" => 2], $admin) ?>">2</a> |
        <a href="<?= $app->login->mergeQueryString(["hits" => 4], $admin) ?>">4</a> |
        <a href="<?= $app->login->mergeQueryString(["hits" => 8], $admin) ?>">8</a>
    </p>
  <table class="table table-striped table-hover ">
  <thead>
    <tr>
        <th>id <?= $app->login->orderby("id", $admin)?></th>
        <th>Username <?= $app->login->orderby("name", $admin)?></th>
        <th>Email <?= $app->login->orderby("email", $admin)?></th>
        <th>Edit</th>
    </tr>
  </thead>
  <tbody>

      <?php foreach ($users as $key => $value) : ?>
        <tr>
        <td><?=$value->id?></td>
        <td><?=$value->name?></td>
        <td><?=$value->email?></td>
        <td><a href="<?= $edit ?>?name=<?= $value->name ?>">Edit</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>

    <p>
        Pages:
        <?php for ($i = 1; $i <= $max; $i++) : ?>
            <a href="<?= $app->login->mergeQueryString(["page" => $i], $admin) ?>"><?= $i ?></a>
        <?php endfor; ?>
    </p>
  </div>
</div>
