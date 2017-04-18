<?php

namespace Phil\Session;

/**
 * Guess Class
 */
class Session implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;
    private $name;

    /**
    * Constructor
    * @param string $name (optional) The name of the session
    * @return void
    */
    public function __construct($name = "MYSESSION")
    {
        $this->name = $name;
    }

    /**
    *Methods
    */
    public function start()
    {
        session_name($this->name);

        if (!empty(session_id())) {
            session_destroy();
        }
        session_start();
    }

    public function status()
    {
        return session_status();
    }

    public function cacheExpire()
    {
        return session_cache_expire();
    }

    public function getCookieParams()
    {
        return session_get_cookie_params();
    }

    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public function get($key, $default = false)
    {
        return (self::has($key)) ? $_SESSION[$key] : $default;
    }

    public function set($key, $values)
    {
        $_SESSION[$key] = $values;
    }

    public function destroy()
    {
        session_destroy();
    }

    public function delete($key)
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function dump()
    {
        //var_dump($_SESSION);
        return var_export($_SESSION, true);
    }
}
