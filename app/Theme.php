<?php

namespace Veloce;

class Theme
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;

        add_action('after_setup_theme', [$this, 'registerMenus']);
    }
    public function registerMenus()
    {
        register_nav_menus(array(
            'primary_menu' => __('Primary Menu', 'veloce'),
            'footer_menu'  => __('Footer Menu', 'veloce'),
        ));
    }
}
