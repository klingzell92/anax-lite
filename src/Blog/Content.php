<?php

namespace Phil\Content;

class Content implements \Anax\Common\ConfigureInterface
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
    * @param $user string The user to return
    * @return The fetched result
    *
    */
    public function showAll()
    {
        $result = $this->db->executeFetchAll("SELECT * FROM content");
        return $result;
    }

    /**
    * @param $id string The id for the row to return
    * @return The fetched result
    *
    */
    public function getContent($id)
    {
        $this->db->execute("SELECT * FROM content WHERE id=?", [$id]);
        $row = $this->db->fetchOne();
        return $row;
    }
}
