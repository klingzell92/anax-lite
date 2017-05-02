<article>

<?php foreach ($content as $row) : ?>
<section>
    <header>
        <h1><a href="<?=$blog?>/<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
    </header>
    <?php  if ($row->filter != "") {
            echo $app->filter->doFilter($row->data, $row->filter);
} else {
          echo esc($row->data);
}
        ?>
</section>
<?php endforeach; ?>

</article>
