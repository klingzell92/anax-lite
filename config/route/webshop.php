<?php

$app->router->add("webshop/products", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $result = $app->db->executeFetchAll("SELECT * FROM VProducts");
        $app->view->add("take1/header", ["title" => "Products"]);
        $app->view->add("webshop/webshopnav");
        $app->view->add(
            "webshop/products",
            ["logout" => $app->url->create("login/logout"),
            "result" => $result,
            "handle" => $app->url->create("webshop/handle_create"),
            "edit" => $app->url->create("webshop/edit")]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("webshop/create", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $app->view->add("take1/header", ["title" => "Create Product"]);
        $app->view->add("webshop/webshopnav");
        $app->view->add(
            "webshop/create_product",
            ["logout" => $app->url->create("login/logout"),
            "handle" => $app->url->create("webshop/handle_create")]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("webshop/handle_create", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $create = $app->url->create("webshop/create");
    $products = $app->url->create("webshop/products");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
      // Handle incoming POST variables
        $description = getPost("description");
        $img = getPost("image");
        $price = getPost("price");
        $status = getPost("status");
        $category = getPost("category");
        $sql = "CALL createProduct('$description', '$img', $price, '$status', $category)";
        $app->db->execute($sql);
        header("Location: $products");
    } else {
        header("Location: $login");
    }
});

$app->router->add("webshop/edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $id = getGet("id");
        $result = $app->db->executeFetchAll("CALL getProduct($id)");
        $app->view->add("take1/header", ["title" => "Edit"]);
        $app->view->add("webshop/webshopnav");
        $app->view->add(
            "webshop/edit",
            ["logout" => $app->url->create("login/logout"),
            "admin" => $app->url->create("admin"),
            "result" => $result[0],
            "handle" => $app->url->create("webshop/handle_edit"),
            "delete" => $app->url->create("webshop/delete")]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("webshop/handle_edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $products = $app->url->create("webshop/products");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
        $id = getPost("id");
        $description = getPost("description");
        $img = getPost("image");
        $price = getPost("price");
        $status = getPost("status");
        $category = getPost("category");
      // Check if username exists
        $sql = "CALL updateProduct($id, '$description', '$img', $price, '$status', $category)";

        $app->db->execute($sql);
        header("Location: $products");
    } else {
        header("Location: $login");
    }
});

$app->router->add("webshop/inventory", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $result = $app->db->executeFetchAll("SELECT * FROM VInventory");
        $log = $app->db->executeFetchAll("SELECT * FROM InventoryLog");
        $app->view->add("take1/header", ["title" => "Products"]);
        $app->view->add("webshop/webshopnav");
        $app->view->add(
            "webshop/inventory",
            ["logout" => $app->url->create("login/logout"),
            "result" => $result,
            "log" => $log,
            "handle" => $app->url->create("webshop/handle_create"),
            "edit" => $app->url->create("webshop/inventory_edit")]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("webshop/inventory_edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $id = getGet("id");
        $result = $app->db->executeFetchAll("CALL getInventory($id)");
        $app->view->add("take1/header", ["title" => "Edit"]);
        $app->view->add("webshop/webshopnav");
        $app->view->add(
            "webshop/inventory_edit",
            ["logout" => $app->url->create("login/logout"),
            "admin" => $app->url->create("admin"),
            "result" => $result[0],
            "handle" => $app->url->create("webshop/inventory_handle_edit")]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("webshop/inventory_handle_edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $inventory = $app->url->create("webshop/inventory");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
        $id = getPost("id");
        $shelf = getPost("shelf");
        $items = getPost("items");
      // Check if username exists
        $sql = "CALL updateInventory($id, '$shelf', $items)";
        $app->db->execute($sql);
        header("Location: $inventory");
    } else {
        header("Location: $login");
    }
});

$app->router->add("webshop/delete", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $products = $app->url->create("webshop/products");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
        $id = getGet("id");
      // Check if username exists
        $sql = "CALL deleteProduct($id)";
        $app->db->execute($sql);
        header("Location: $products");
    } else {
        header("Location: $login");
    }
});
