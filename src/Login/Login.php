<?php

namespace Phil\Login;

class Login implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;
    private $db;

    /**
     * Constructor
     * @param $dsn string The dsn to the database-file
     * @return void
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Adds user to the database
     * @param $user string The name of the user
     * @param $pass string The user's password
     * @return void
     */
    public function addUser($user, $pass, $email)
    {
        $this->db->execute("INSERT into users (name, pass, email) VALUES ('$user', '$pass', '$email')");
    }

    /**
     * Gets the hashed password from the database
     * @param $user string The user to get password from/for
     * @return string The hashed password
     */
    public function getHash($user)
    {
        $this->db->execute("SELECT pass FROM users WHERE name='$user'");
        $res = $this->db->fetchAll();
        return $res[0]->pass;
    }

    /**
     * Changes the password for a user
     * @param $user string The usr to change the password for
     * @param $pass string The password to change to
     * @return void
     */
    public function changePassword($user, $pass)
    {
        $this->db->execute("UPDATE users SET pass='$pass' WHERE name='$user'");
    }

    /**
     * Check if user exists in the database
     * @param $user string The user to search for
     * @return bool true if user exists, otherwise false
     */
    public function exists($user)
    {
        $this->db->execute("SELECT * FROM users WHERE name='$user'");
        $row = $this->db->fetchOne();
        return !$row ? false : true;
    }

    /**
    * @param $user string The user to return
    * @return The fetched result
    *
    */
    public function getUser($user)
    {
        $this->db->execute("SELECT `name`, `email` FROM users WHERE name='$user'");
        $row = $this->db->fetchOne();
        return $row;
    }

    /**
    * @param $new_name string new name
    * @param $new_email string new email
    * @param $user string The user to edit
    * @return void
    *
    */
    public function editUser($newName, $newEmail, $user)
    {
        $this->db->execute("UPDATE users SET name='$newName', email='$newEmail' WHERE name='$user'");
    }

    /**
    *@param $user string user to be deleted
    *@return void
    */
    public function deleteUser($user)
    {
        $this->db->execute("DELETE FROM users WHERE name='$user'");
    }

    /**
     * Use current querystring as base, extract it to an array, merge it
     * with incoming $options and recreate the querystring using the resulting
     * array.
     *
     * @param array  $options to merge into exitins querystring
     * @param string $prepend to the resulting query string
     *
     * @return string as an url with the updated query string.
     */
    public function mergeQueryString($options, $prepend = "?")
    {
          // Parse querystring into array
          $query = [];
          parse_str($_SERVER["QUERY_STRING"], $query);

          // Merge query string with new options
          $query = array_merge($query, $options);
          // Build and return the modified querystring as url
          return $prepend . "?" . http_build_query($query);
    }

    /**
 * Function to create links for sorting.
 *
 * @param string $column the name of the database column to sort by
 * @param string $route  prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
    public function orderby($column, $route)
    {
        return <<<EOD
<span class='orderby'>
<a href="{$route}?orderby={$column}&order=asc">&darr;</a>
<a href="{$route}?orderby={$column}&order=desc">&uarr;</a>
</span>
EOD;
    }
}
