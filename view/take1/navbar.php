<?php
$urlHome  = $app->url->create("");
$urlAbout = $app->url->create("about");
$urlReport = $app->url->create("report");
?>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?= $urlHome ?>">anax-lite</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?= $urlHome ?>">Home</a></li>
      <li><a href="<?= $urlAbout ?>">About</a></li>
      <li><a href="<?= $urlReport ?>">Report</a></li>
    </ul>
  </div>
</nav>
