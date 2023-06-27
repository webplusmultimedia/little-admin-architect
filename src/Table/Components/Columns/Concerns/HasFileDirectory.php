<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Columns\Concerns;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

trait HasFileDirectory
{
    protected ?string $disk = null;

    protected string $baseDirectory = 'attachements';

    protected ?string $directory = null;

    public function disk(string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function directory(string $directory): static
    {
        $this->directory = $directory;

        return $this;
    }

    public function getDisk(): Filesystem
    {
        return Storage::disk($this->getDiskName());
    }

    public function getDiskName(): string
    {
        return $this->disk ?? config('little-admin-architect.forms.default_filesystem_disk');
    }

    protected function getBaseDirectory(): string
    {
        return implode('/', [$this->baseDirectory, $this->directory]);
    }

    protected function getDirectory(): ?string
    {
        return $this->directory;
    }

    public function getPathFile(string $file): string
    {
        return trim($this->getBaseDirectory() . $file, '/');
    }
}
