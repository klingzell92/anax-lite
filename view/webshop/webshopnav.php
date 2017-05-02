<ul class="nav nav-tabs">
  <li><a href='<?= $app->url->create("login/logout") ?>'>Logout</a></li>
  <li><a href='<?= $app->url->create("login/profile") ?>'>Profile</a></li>
  <li><a href="<?= $app->url->create("webshop/products") ?>">Products</a></li>
  <li><a href="<?= $app->url->create("webshop/create") ?>">Create</a></li>
  <li><a href="<?= $app->url->create("webshop/inventory") ?>">Inventory</a></li>

</ul>
<div id="webshopContent" class="tab-content">
