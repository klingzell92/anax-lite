<?php
  $this->renderView("take1/header", ["title" => "Home"]);
?>

<div class="calendarContainer">
  <div class="imageContainer">
    <h3><?= $month ?></h3>
    <img src="../img/<?= $month ?>.jpg" class="calendarImage"/>
  </div>
  <div class="calendar">
    <?= $calendar ?>
  <div class="switch">
    <div>
    <a href="<?= $decrement ?>" class="previous btn btn-default">Previous</a>
  </div>
  <div>
    <a href="<?= $increment ?>" class="next btn btn-default">Next</a>
  </div>
  </div>
  </div>


</div>

<?php
$this->renderView("take1/footer");
