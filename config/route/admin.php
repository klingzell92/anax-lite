<?php
$app->router->add("admin", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");

    if (!$app->session->has("name")) {
        header("Location: $login");
    } else {
      // Only these values are valid

        $hits = isset($_GET["hits"]) ? $_GET["hits"] : 4;
        if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
            die("Not valid for hits.");
        }

        // Get max number of pages
        $sql = "SELECT COUNT(id) AS max FROM users;";
        $max = $app->db->executeFetchAll($sql);
        $max = ceil($max[0]->max / $hits);

        // Get current page
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
            die("Not valid for page.");
        }
        $offset = $hits * ($page - 1);

        $columns = ["id", "name", "email"];
        $orders = ["asc", "desc"];

        // Get settings from GET or use defaults
        $orderBy = isset($_GET["orderby"]) ? $_GET["orderby"] : "id";
        $order = isset($_GET["order"]) ? $_GET["order"] : "asc";

        // Incoming matches valid value sets
        if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
            die("Not valid input for sorting.");
        }

        $users = $app->db->executeFetchAll("SELECT * FROM users ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;");

        $app->view->add("take1/header", ["title" => "Admin"]);
        $app->view->add(
            "admin/admin",
            ["profile" => $app->url->create("login/profile"),
            "logout" => $app->url->create("login/logout"),
            "edit" => $app->url->create("admin/edit"),
            "search" => $app->url->create("admin/search"),
            "create" => $app->url->create("admin/create"),
            "admin" => $app->url->create("admin"),
            "max" => $max,
            "users" => $users]
        );
        $app->view->add("take1/footer");

        $app->response->setBody([$app->view, "render"])
                      ->send();
    }
});

$app->router->add("admin/search", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $result = "";

    if (!$app->session->has("name")) {
        header("Location: $login");
    } else {
        $searchName = isset($_GET["searchName"]) ? htmlentities($_GET["searchName"]) : null;
        $sql = "SELECT * FROM users WHERE `name` LIKE ? OR `email` LIKE ?";
        $result = $app->db->executeFetchAll($sql, [$searchName, $searchName]);
        $app->view->add("take1/header", ["title" => "Search"]);
        $app->view->add(
            "admin/search",
            ["admin" => $app->url->create("admin"),
            "search" => $app->url->create("admin/search"),
            "edit" => $app->url->create("admin/edit"),
            "result" => $result,
            "searchName" => $searchName]
        );
        $app->view->add("take1/footer");

        $app->response->setBody([$app->view, "render"])
                      ->send();
    }
});

$app->router->add("admin/edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $status = isset($_GET["status"]) ? htmlentities($_GET["status"]) : "Change Password";
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $userName = isset($_GET["name"]) ? htmlentities($_GET["name"]) : null;
        $user = $app->login->getUser($userName);
        $app->view->add("take1/header", ["title" => "Edit"]);
        $app->view->add(
            "admin/edit",
            ["logout" => $app->url->create("login/logout"),
            "admin" => $app->url->create("admin"),
            "userName" => $userName,
            "name" => $user->name,
            "email" => $user->email,
            "handle" => $app->url->create("admin/handle_edit"),
            "change" => $app->url->create("admin/change_pw"),
            "delete" => $app->url->create("admin/delete"),
            "status" => $status]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin/handle_edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $edit = $app->url->create("admin/edit");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
        $user_name = isset($_POST["userName"]) ? htmlentities($_POST["userName"]) : null;
        $new_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
        $new_email = isset($_POST["new_email"]) ? htmlentities($_POST["new_email"]) : null;
      // Check if username exists
        if ($app->login->exists($user_name)) {
          // edit user
            $app->login->editUser($new_name, $new_email, $user_name);
            header("Location: $edit?name=$new_name");
        }
    } else {
        header("Location: $login");
    }
});

$app->router->add("admin/change_pw", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $edit = $app->url->create("admin/edit");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
        $status = "Change password";
        // Handle incoming POST variables
        $user_name = isset($_POST["userName"]) ? htmlentities($_POST["userName"]) : null;
        $old_pass = isset($_POST["old_pass"]) ? htmlentities($_POST["old_pass"]) : null;
        $new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
        $re_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;

        // Check if all fields are filled
        if ($old_pass != null && $new_pass != null && $re_pass != null) {
            // Check if old password is correct
            if (password_verify($old_pass, $app->login->getHash($user_name))) {
                // Check if new password matches
                if ($new_pass == $re_pass) {
                        $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                        $app->login->changePassword($user_name, $crypt_pass);
                        $status = "Password changed.";
                } else {
                    $status = "The passwords do not match.";
                }
            } else {
                $status = "Old password is incorrect.";
            }
        } else {
            $status = "All fields must be filled.";
        }
        header("Location: $edit?name=$user_name&status=$status");
    } else {
        header("Location: $login");
    }
});

$app->router->add("admin/delete", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $admin = $app->url->create("admin");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
        $user_name = isset($_GET["name"]) ? htmlentities($_GET["name"]) : null;
      // Check if username exists
        if ($app->login->exists($user_name)) {
          // edit user
            $app->login->deleteUser($user_name);
            header("Location: $admin");
        }
    } else {
        header("Location: $login");
    }
});


$app->router->add("admin/create", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $status = isset($_GET["status"]) ? htmlentities($_GET["status"]) : "Create User";
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $userName = isset($_GET["name"]) ? htmlentities($_GET["name"]) : null;
        $user = $app->login->getUser($userName);
        $app->view->add("take1/header", ["title" => "Edit"]);
        $app->view->add(
            "admin/create",
            ["logout" => $app->url->create("login/logout"),
            "admin" => $app->url->create("admin"),
            "profile" => $app->url->create("login/profile"),
            "handle" => $app->url->create("admin/handle_create"),
            "status" => $status]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});


$app->router->add("admin/handle_create", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $admin = $app->url->create("admin");
    $create = $app->url->create("admin/create");


    // Handle incoming POST variables
    if ($app->session->has("name")) {
      // Handle incoming POST variables
        $user_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
        $user_email = isset($_POST["new_email"]) ? htmlentities($_POST["new_email"]) : null;
        $user_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
        $re_user_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
        $status = "Create User";
      // Check if username exists
        if (!$app->login->exists($user_name)) {
            // Check passwords match
            if ($user_pass != $re_user_pass) {
                $status = "Passwords do not match!";
                header("Location: $create?status=$status");
            } else {
              // Make a hash of the password
                $crypt_pass = password_hash($user_pass, PASSWORD_DEFAULT);

              // Add user to database
                $app->login->addUser($user_name, $crypt_pass, $user_email);

                header("Location: $admin");
            }
        } else {
            $status = "User already exists! Choose another username.";
            header("Location: $create?status=$status");
        }
    } else {
        header("Location: $admin");
    }
});
