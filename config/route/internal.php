<?php
$app->router->addInternal("404", function () use ($app) {
    $currentRoute = $app->request->getRoute();
    $routes = "<ul>";
    foreach ($app->router->getAll() as $route) {
        $routes .= "<li>'" . $route->getRule() . "'</li>";
    }
    $routes .= "</ul>";

    $intRoutes = "<ul>";
    foreach ($app->router->getInternal() as $route) {
        $intRoutes .= "<li>'" . $route->getRule() . "'</li>";
    }
    $intRoutes .= "</ul>";

    $app->view->add("take1/header", ["title" => "404"]);
    $app->view->add("navbar1/navbar");
    $app->view->add("take1/error", ["routes" => $routes,
                                  "currentRoute" => $currentRoute,
                                  "intRoutes" => $intRoutes]);

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
