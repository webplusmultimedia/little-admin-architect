<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Command\concerns;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use ReflectionClass;

trait CanManipulateFiles
{
    protected function copyStubToPath(string $stubPath, string $targetPath, array $replacements = []): void
    {
        $filesystem = app(Filesystem::class);
        $stub = Str::of($filesystem->get($stubPath));

        foreach ($replacements as $key => $replacement) {
            $stub = $stub->replace("{{ {$key} }}", $replacement);
        }

        $stub = (string) $stub;

        $this->writeFile($targetPath, $stub);
    }

    protected function fileExists(string $path): bool
    {
        return app(Filesystem::class)->exists($path);
    }

    protected function writeFile(string $path, string $contents): void
    {
        $filesystem = app(Filesystem::class);

        $filesystem->ensureDirectoryExists(
            (string) Str::of($path)
                ->beforeLast('/'),
        );

        $filesystem->put($path, $contents);
    }

    protected function getDefaultStubPath(): string
    {
        $reflectionClass = new ReflectionClass($this);
        /** @var string $fileName */
        $fileName = $reflectionClass->getFileName();

        return Str::of($fileName)
            ->beforeLast('Commands')
            ->append('../stubs')->value();
    }
}
