<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Resources;

use Illuminate\Filesystem\Filesystem;

class RegisterResources
{
    protected Filesystem $filesystem;

    public function __construct(

    ) {
        $this->filesystem = new Filesystem();
    }

    public static function getResourcesFromApplication(string $path): array
    {
        return (new static())->getResourcesFromDir($path);
    }

    protected function getResourcesFromDir(string $path): array
    {
        if ($this->filesystem->exists($path)) {
            $files = $this->filesystem->directories($path);

            return array_map(function (string $dir) {
                return str($dir)->afterLast('/');
            }, $files);
        }

        return [];

    }
}
