<article>
    <header>
        <h1><?= esc($content[0]->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= esc($content[0]->modified_iso8601) ?>" pubdate><?= esc($content[0]->modified) ?></time></i></p>
    </header>
    <?php  if ($content[0]->filter != "") {
            echo $app->filter->doFilter($content[0]->data, $content[0]->filter);
} else {
          echo esc($content[0]->data);
}
        ?>


</article>
