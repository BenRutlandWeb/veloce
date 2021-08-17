<?php

namespace Veloce;

class Application
{
    protected $basePath;
    protected $env = 'production';

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
        $this->env = wp_get_environment_type();
    }

    /**
     * Get or check the current application environment.
     *
     * @param array|string|null $environments
     * @return boolean|string
     */
    public function environment($environments = null)
    {
        if ($environments) {
            return in_array($this->env, (array) $environments, true);
        }

        return $this->env;
    }

    public function isLocal(): bool
    {
        return $this->env === 'local';
    }

    public function isDevelopment(): bool
    {
        return $this->env === 'development';
    }

    public function isStaging(): bool
    {
        return $this->env === 'staging';
    }

    public function isProduction(): bool
    {
        return $this['env'] === 'production';
    }

    public function isRunningDevServer()
    {
        return !is_wp_error(wp_remote_get($this->devServer()));
    }

    public function devServer(?string $path = null)
    {
        return 'http://localhost:3000' . $path;
    }

    public function basePath(?string $path = null)
    {
        return $this->basePath . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR);
    }

    public function resourcesPath(?string $path = null)
    {
        return $this->basePath('resources' . DIRECTORY_SEPARATOR . trim($path, DIRECTORY_SEPARATOR));
    }
}
