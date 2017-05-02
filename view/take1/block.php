<article class="flex-container">

<?php foreach ($content as $block) : ?>
  <div class="widget">
    <h4><?= $block->title?></h4>
    <p>
        <?php     if ($block->filter != "") {
                echo $app->filter->doFilter($block->data, $block->filter);
} else {
              echo esc($block->data);
}
            ?>
    </p>
  </div>
<?php endforeach; ?>

</article>
