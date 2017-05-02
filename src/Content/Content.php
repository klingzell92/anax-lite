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

    /**
    * Return rows wtih type of page
    *
    *
    */

    public function getPages()
    {
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, ["page"]);
        return $resultset;
    }

    /**
    * Return the page with mathcing path
    *
    *
    */

    public function getPage($path)
    {
        $sql = <<<EOD
SELECT
  *,
  DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
  DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
  path = ?
  AND type = ?
  AND (deleted IS NULL OR deleted > NOW())
  AND published <= NOW()
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, [$path ,"page"]);
        return $resultset;
    }

    /**
    * Return rows wtih type of post
    *
    *
    */

    public function getBLog()
    {
        $sql = <<<EOD
SELECT
  *,
  DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
  DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, ["post"]);
        return $resultset;
    }


    /**
    * Return the post with mathcing slug
    *
    *
    */

    public function getPost($slug)
    {
        $sql = <<<EOD
SELECT
  *,
  DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
  DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
  slug = ?
  AND type = ?
  AND (deleted IS NULL OR deleted > NOW())
  AND published <= NOW()
ORDER BY published DESC
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, [$slug ,"post"]);
        return $resultset;
    }

    public function getBlocks()
    {
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        $resultset = $this->db->executeFetchAll($sql, ["block"]);
        return $resultset;
    }

    /**
    * Check if slug exists
    *
    * @param string slug
    *
    * @return boolean
    */
    public function slugExists($slug)
    {
        $sql = "SELECT * FROM content WHERE slug = ?";
        $result = $this->db->executeFetchAll($sql, [$slug]);
        return $result;
    }
}
