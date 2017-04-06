<?php

namespace Phil\Navbar;

/**
 * Navbar Class
 */
class Navbar implements \Anax\Common\AppInjectableInterface, \Anax\Common\ConfigureInterface
{
    use \Anax\Common\AppInjectableTrait;
    use \Anax\Common\ConfigureTrait;

    /**
     * Get HTML for the navbar.
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML()
    {
        $items = $this->config;
        $html = "<ul class='nav navbar-nav'>";

        foreach ($items as $key => $value) {
            $selected = $this->app->request->getRoute() == $value ?
            "selected" : "";
            $url = $this->app->url->create($value["route"]);
            $html.="<li class='$selected'><a href='".$url."'>".$value["text"]."</a></li></ul>";
        }
        return $html;
    }
}
