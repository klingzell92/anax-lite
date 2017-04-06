<?php
$urlHome  = $app->url->create("");
$urlAbout = $app->url->create("about");
$urlReport = $app->url->create("report");
$urlSession = $app->url->create("session");
$navbar = [
    "items" => [
        "home" => [
            "text" => "Home",
            "route" => $urlHome,
        ],
        "about" => [
            "text" => "About",
            "route" => $urlAbout,
        ],
        "report" => [
            "text" => "Report",
            "route" => $urlReport,
        ],
        "session" => [
            "text" => "Session",
            "route" => $urlSession,
        ],
    ]
];
?>

<nav class='navbar navbar-default'>
  <div class='container-fluid'>
    <ul class='nav navbar-nav'>
<?php
foreach ($navbar["items"] as $key => $value) {
    echo "<li><a href='".$value["route"]."'>".$value["text"]."</a></li>";
}
?>
    </ul>
  </div>
</nav>
