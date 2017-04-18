<?php
$app->router->add("login", function () use ($app) {
    $app->db->connect();
    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add(
        "login/login",
        ["validate" => $app->url->create("login/validate"),
        "logout" => $app->url->create("login/logout"),
        "create" => $app->url->create("login/create")]
    );
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});



$app->router->add("login/create", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $status = isset($_GET["status"]) ? htmlentities($_GET["status"]) : "Create User";

    $userName = isset($_GET["name"]) ? htmlentities($_GET["name"]) : null;
    $user = $app->login->getUser($userName);
    $app->view->add("take1/header", ["title" => "Create"]);
    $app->view->add(
        "login/create",
        ["logout" => $app->url->create("login/logout"),
        "login" => $app->url->create("login"),
        "handle" => $app->url->create("login/handle_create"),
        "status" => $status]
    );
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("login/change", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");

    if ($app->session->has("name")) {
        $userName = $app->session->get("name");
        $status = isset($_GET["status"]) ? $_GET["status"] : "Change Password";
        $app->view->add("take1/header", ["title" => "Change password"]);
        $app->view->add(
            "login/change_password",
            ["profile" => $app->url->create("login/profile"),
            "change" => $app->url->create("login/change_pw"),
            "userName" => $userName,
            "status" => $status]
        );
        $app->view->add("take1/footer");

        $app->response->setBody([$app->view, "render"])
                    ->send();
    } else {
        header("Location: $login");
    }

});

$app->router->add("login/logout", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $app->session->destroy();
    } else {
        die();
    }
    // Check if session is active
    $has_session = session_status() == PHP_SESSION_ACTIVE;

    if (!$has_session) {
        header("Location: $login");
    }
    $app->view->add("take1/header", ["title" => "Logout"]);
    $app->view->add(
        "login/logout",
        ["logout" => $app->url->create("login/logout")]
    );
    $app->view->add("take1/footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("login/profile", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");

    if ($app->session->has("name")) {
        $name = "";
        if (isset($_COOKIE["name"])) {
            $name = $_COOKIE["name"];
        }

        $userName = $app->session->get("name");
        $user = $app->login->getUser($userName);
        $app->view->add("take1/header", ["title" => "Profile"]);
        $app->view->add(
            "login/profile",
            ["logout" => $app->url->create("login/logout"),
            "change" => $app->url->create("login/change"),
            "login" => $app->url->create("login"),
            "admin" => $app->url->create("admin"),
            "name" => $name,
            "email" => $user->email,
            "edit" => $app->url->create("login/edit")]
        );
        $app->view->add("take1/footer");

        $app->response->setBody([$app->view, "render"])
                      ->send();
    } else {
        header("Location: $login");
    }
});

$app->router->add("login/edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    // Check if someone is logged in
    if ($app->session->has("name")) {
        $name = $app->session->get("name");
        $user = $app->login->getUser($name);
        $app->view->add("take1/header", ["title" => "Edit"]);
        $app->view->add(
            "login/edit",
            ["logout" => $app->url->create("login/logout"),
            "profile" => $app->url->create("login/profile"),
            "name" => $user->name,
            "email" => $user->email,
            "handle" => $app->url->create("login/handle_edit")]
        );
        $app->view->add("take1/footer");
    } else {
        header("Location: $login");
    }
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("login/handle_edit", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $profile = $app->url->create("login/profile");

    // Handle incoming POST variables
    if ($app->session->has("name")) {
        $user_name = $app->session->get("name");
        $new_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
        $new_email = isset($_POST["new_email"]) ? htmlentities($_POST["new_email"]) : null;

      // Check if username exists
        if ($app->login->exists($user_name)) {
          // edit user
            $app->login->editUser($new_name, $new_email, $user_name);
            $app->session->set("name", $new_name);
            header("Location: $profile");
        }
    } else {
        header("Location: $login");
    }
});
$app->router->add("login/handle_create", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $create = $app->url->create("login/create");

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
            header("Location: $login");
        }
    } else {
        $status = "User already exists! Choose another username.";
        header("Location: $create?status=$status");
    }
});

$app->router->add("login/change_pw", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $change = $app->url->create("login/change");

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
        header("Location: $change?name=$user_name&status=$status");
    } else {
        header("Location: $login");
    }
});


$app->router->add("login/validate", function () use ($app) {
    $app->db->connect();
    $app->session->start();
    $login = $app->url->create("login");
    $profile = $app->url->create("login/profile");


    // Handle incoming POST variables
    $user_name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : null;
    $user_pass = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : null;


    // Correspond according to input
    // Check if both fields are filled
    if ($user_name != null && $user_pass != null) {
        // Check if username exists
        if ($app->login->exists($user_name)) {
            $get_hash = $app->login->getHash($user_name);
            // Verify user password
            if (password_verify($user_pass, $get_hash)) {
                $app->session->set("name", $user_name);
                setcookie("name", $user_name);
                header("Location: $profile");
            } else {
                // Redirect to login.php
                echo "User name or password is incorrect. <a href='$login'>Try again.</a>";
            }
        } else {
            // Redirect to login.php
            echo "No such user. <a href='$login'>Try again.</a>";
        }
    } else {
        header("Location: $login");
    }
});
