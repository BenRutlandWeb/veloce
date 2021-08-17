<?php

namespace Veloce;

class TemplateRedirect
{
    protected $app;

    /**
     * The templates that WordPress looks for in the root of the theme.
     *
     * @var array
     */
    protected $templateHierarchy = [
        'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy',
        'date', 'embed', 'home', 'frontpage', 'privacypolicy', 'page', 'paged',
        'search', 'single', 'singular', 'attachment',
    ];

    public function __construct(Application $app)
    {
        $this->app = $app;

        foreach ($this->templateHierarchy as $type) {
            add_action("{$type}_template_hierarchy", [$this, 'filterTemplates']);
        };

        add_action('get_search_form', [$this, 'filterSearchformTemplate']);
    }

    /**
     * Filter the WordPress hierarchy to look for templates in views before
     * looking in the root of the theme.
     *
     * @param array $templates
     * @return array
     */
    public function filterTemplates(array $templates): array
    {
        $path = $this->getTemplatePath();

        $return = [];

        foreach ($templates as $template) {
            $return[] = "{$path}/{$template}";
            $return[] = $template;
        }

        return $return;
    }

    /**
     * Filter the searchform location
     *
     * @return bool
     */
    public function filterSearchformTemplate(): bool
    {
        $path = $this->getTemplatePath();

        locate_template(["{$path}/searchform.php", 'searchform.php'], true, false);

        return false;
    }

    /**
     * Get the template path
     *
     * @return string
     */
    protected function getTemplatePath(): string
    {
        return str_replace(
            $this->app->basePath(),
            '',
            $this->app->resourcesPath('views')
        );
    }
}
