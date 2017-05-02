<?php
$text = "    Header level 1 {#id1}
=====================

Here comes a paragraph.

* Unordered list
* Unordered list again


Header level 2 {#id2}
---------------------

Here comes another paragraph, now intended as blockquote.

1. Ordered list
2. Ordered list again

> This should be a blockquote.


###Header level 3 {#id3}

Here will be a table.

| Header 1 | Header 2     | Header 3 | Header 4      |
|----------|:-------------|:--------:|--------------:|
| Data 1   | Left aligned | Centered | Right aligned |
| Data     | Data         | Data     | Data          |

Here is a paragraph with some **bold** text and some *italic* text and a [link to dbwebb.se](http://dbwebb.se).
";
$bbcode = "[b]Bold text[/b][i]Italic text [/i]";
$nl2br = "This is a line\nThis is another line"
?>
<main>
  <article>
    <h1>TextFilter</h1>
    <p><b> Utan clickable </b></p>
    <p>Detta är en länk som kan vara klickbar http://dbwebb.se/coachen</p>
    <p><b> Med clickable </b></p>
    <?= $app->filter->doFilter("Detta är en länk som kan vara klickbar http://dbwebb.se/coachen.", ["clickable"])?>
    <p><b> Utan formatering </b></p>
    <pre>
    <?= $text ?>
  </pre>
    <p><b> Med formatering </b></p>
    <?= $app->filter->doFilter($text, ["markdown"]) ?>
    <p><b> Utan bbcode </b></p>
    <?= $bbcode ?>
    <p><b> Med bbcode </b></p>
    <?= $app->filter->doFilter($bbcode, ["bbcode"]) ?>
    <p><b> Utan nl2br </b></p>
    <?= $nl2br ?>
    <p><b> Med nl2br </b></p>
    <?= $app->filter->doFilter($nl2br, ["nl2br"]) ?>

  </article>
</main>
