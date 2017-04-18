<?php

$app->router->add("session", function () use ($app) {
    $app->session->start();
    $number = $app->session->get("number");

    $app->view->add(
        "take1/session",
        ["number" => $number,
        "increment" => $app->url->create("session/increment"),
        "decrement" => $app->url->create("session/decrement"),
        "status" => $app->url->create("session/status"),
        "dump" => $app->url->create("session/dump"),
        "destroy" => $app->url->create("session/destroy"),]
    );

    $app->response->setBody([$app->view, "render"])
                  ->send();
});



$app->router->add("session/increment", function () use ($app) {
    $urlSession  = $app->url->create("session");
    $app->session->start();
    $number = $app->session->get("number");
    $app->session->set("number", $number + 1);
    header("Location: ".$urlSession);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("session/decrement", function () use ($app) {
    $urlSession  = $app->url->create("session");
    $app->session->start();
    $number = $app->session->get("number");
    $app->session->set("number", $number - 1);
    header("Location: ".$urlSession);
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("session/status", function () use ($app) {
    $data = [
        "Status" => $app->session->status(),
        "Cache expires" => $app->session->cacheExpire(),
        "Cookie Paramaters" => $app->session->getCookieParams()
      ];

    $app->response->sendJson($data);
});

$app->router->add("session/dump", function () use ($app) {
    $app->session->start();
    $number = $app->session->get("number");

    $dumped = $app->session->dump();

    $app->view->add(
        "take1/dump",
        ["number" => $number,
        "increment" => $app->url->create("session/increment"),
        "decrement" => $app->url->create("session/decrement"),
        "status" => $app->url->create("session/status"),
        "dump" => $app->url->create("session/dump"),
        "destroy" => $app->url->create("session/destroy"),
        "dumped" => $dumped]
    );
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("session/destroy", function () use ($app) {
    $urlDump  = $app->url->create("session/dump");
    $app->session->start();
    $app->session->destroy();
    header("Location:".$urlDump);
});
