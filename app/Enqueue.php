<?php

namespace Veloce;

class Enqueue
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;

        add_action('wp_enqueue_scripts', [$this, 'frontEndScripts']);
        add_action('admin_enqueue_scripts', [$this, 'adminScripts']);
        add_filter('script_loader_tag', [$this, 'addModuleTypeAttribute'], 10, 3);
    }

    public function frontEndScripts()
    {
        if ($this->app->isLocal() && $this->app->isRunningDevServer()) {
            $this->enqueueViteClient();
            wp_enqueue_script(
                'vite-app',
                $this->app->devServer('/resources/js/app.js'),
                array('vite'),
                null,
                true
            );
        } else {
            $manifest = $this->getAssetManifest();
            foreach ($manifest['resources/js/app.js']['css'] as $index => $css) {
                wp_enqueue_style(
                    'app-' . $index,
                    $this->asset($css),
                    array(),
                    null
                );
            }
            wp_enqueue_script(
                'app',
                $this->asset($manifest['resources/js/app.js']['file']),
                array(),
                null,
                true
            );
        }
    }

    protected function enqueueViteClient()
    {
        wp_enqueue_script(
            'vite',
            $this->app->devServer('/@vite/client'),
            array(),
            null,
            true
        );
    }

    public function adminScripts()
    {
        if ($this->app->isLocal() && $this->app->isRunningDevServer()) {
            $this->enqueueViteClient();
            wp_enqueue_script(
                'vite-admin-app',
                $this->app->devServer('/resources/js/admin.js'),
                array('vite'),
                null,
                true
            );
        } else {
            $manifest = $this->getAssetManifest();
            foreach ($manifest['resources/js/app.js']['css'] as $index => $css) {
                wp_enqueue_style(
                    'admin-app-' . $index,
                    $this->asset($css),
                    array(),
                    null
                );
            }
            wp_enqueue_script(
                'admin-app',
                $this->asset($manifest['resources/js/admin.js']['file']),
                array(),
                null,
                true
            );
        }
    }

    public function addModuleTypeAttribute(string $tag, string $handle, string $src)
    {
        if (!in_array($handle, ['vite', 'vite-app', 'vite-admin-app'])) {
            return $tag;
        }

        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }


    protected function getAssetManifest()
    {
        try {
            return json_decode(file_get_contents(get_template_directory() . '/public/manifest.json'), true);
        } catch (Exception $e) {
            return [];
        }
    }

    protected function asset(string $path)
    {
        return get_template_directory_uri() . '/public/' . $path;
    }
}
