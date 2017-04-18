<?php
  $this->renderView("take1/header", ["title" => "Home"]);
?>
<div class="session">
  <p>Värdet på number är: <?= $number ?></p>
  <a href="<?= $increment ?>" class="btn btn-success">Increment</a>
  <a href="<?= $decrement ?>" class="btn btn-warning">Decrement</a>
  <a href="<?= $status ?>"class="btn btn-info">Status</a>
  <a href="<?= $dump ?>"class="btn btn-primary">Dump</a>
  <a href="<?= $destroy ?>"class="btn btn-danger">Destroy</a>

<code class="dump"><?= $dumped ?></code>
</div>
<?php
$this->renderView("take1/footer");
