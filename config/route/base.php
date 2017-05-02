<?php
$app->router->add("", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Home"]);
  //  $app->view->add("navbar1/navbar");
    $app->view->add("take1/home");
    $app->view->add("take1/byline");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});



$app->router->add("about", function () use ($app) {

    $app->db->connect();
    $user = $app->db->executeFetchAll("SELECT * FROM users WHERE
    name='phil'")[0];
    $app->view->add("take1/header", ["title" => "About"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("take1/about", ["user" => $user]);
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("report", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Report"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("take1/report");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("status", function () use ($app) {
    $data = [
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
    ];

    $app->response->sendJson($data);
});

$app->router->add("calendar", function () use ($app) {
    $app->session->start();
    $month = $app->session->get("month");
    $year = $app->session->get("year");
    if ($month == false) {
        $app->session->set("month", $app->calendar->month);
    } else {
        $app->calendar->month = $month;
    }

    if ($year == false) {
        $app->session->set("year", $app->calendar->year);
    } else {
        $app->calendar->year = $year;
    }
    $monthName = $app->calendar->getMonthName();
    $calendar = $app->calendar->showCalendar();
    $app->view->add(
        "take1/calendar",
        ["calendar" => $calendar,
        "month"     => $monthName,
        "increment" => $app->url->create("calendar/increment"),
        "decrement" => $app->url->create("calendar/decrement")]
    );

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("calendar/increment", function () use ($app) {
    $urlCalendar  = $app->url->create("calendar");
    $app->session->start();
    $month = $app->session->get("month");
    $year = $app->session->get("year");
    if ($month == 12) {
        $app->session->set("month", 1);
        $app->session->set("year", $year + 1);
    } else {
        $app->session->set("month", $month + 1);
    }
    header("Location: ".$urlCalendar);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("calendar/decrement", function () use ($app) {
    $urlCalendar  = $app->url->create("calendar");
    $app->session->start();
    $month = $app->session->get("month");
    $year = $app->session->get("year");
    if ($month == 1) {
        $app->session->set("month", 12);
        $app->session->set("year", $year - 1);
    } else {
        $app->session->set("month", $month - 1);
    }
    header("Location: ".$urlCalendar);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("test", function () use ($app) {
    $app->view->add("take1/header", ["title" => "TextFilter"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add("take1/test");
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("pages", function () use ($app) {
    $app->db->connect();
    $result = $app->content->getPages();
    $app->view->add("take1/header", ["title" => "Pages"]);
    //$app->view->add("navbar1/navbar");
    $app->view->add(
        "take1/pages",
        ["result" => $result,
        "page" => $app->url->create("page")]
    );
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("page", function () use ($app) {
    $app->db->connect();
    $path = getGet("path");
    $result = $app->content->getPage($path);
    if (!$result) {
           header("HTTP/1.0 404 Not Found");
           $app->view->add("take1/header", ["title" => "404"]);
           $app->view->add(
               "take1/error",
               ["content" => $result]
           );
           $app->view->add("take1/footer");
    }
    $app->view->add("take1/header", ["title" => "Page"]);
    $app->view->add(
        "take1/page",
        ["content" => $result]
    );
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});


$app->router->add("blog/**", function () use ($app) {
    $app->db->connect();
    $blog = $_SERVER['REQUEST_URI'];
    $arr = explode('blog', $blog);
    $slug = $arr[1];
    $result = "";
    if ($slug != "") {
        $slug = ltrim($slug, '/');
        $result = $app->content->getPost($slug);
        if (!$result) {
            header("HTTP/1.0 404 Not Found");
            $app->view->add("take1/header", ["title" => "404"]);
            $app->view->add(
                "take1/error",
                ["content" => $result]
            );
            $app->view->add("take1/footer");
        }
    } else {
        $result = $app->content->getBLog();
    }
    $app->view->add("take1/header", ["title" => "Blog"]);
    $app->view->add(
        "take1/blog",
        ["content" => $result,
        "blog" => $app->url->create("blog")]
    );
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("block", function () use ($app) {
    $app->db->connect();
    $result = $app->content->getBlocks();
    $app->view->add("take1/header", ["title" => "Blocks"]);
    $app->view->add(
        "take1/block",
        ["content" => $result]
    );
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});
