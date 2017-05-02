<ul class="nav nav-tabs">
  <li><a href='<?= $app->url->create("login/logout") ?>'>Logout</a></li>
  <li><a href='<?= $app->url->create("login/profile") ?>'>Profile</a></li>
  <li><a href='<?= $app->url->create("admin/create") ?>'>Create User</a></li>
  <li><a href='<?= $app->url->create("admin/search") ?>'>Search</a></li>
  <li><a href='<?= $app->url->create("admin/pages") ?>'>Overview</a></li>
  <li><a href="<?= $app->url->create("admin/createpost") ?>">Create Post</a></li>
  <li><a href="<?= $app->url->create("webshop/products") ?>">Webshop</a></li>
</ul>
<div id="myTabContent" class="tab-content">
