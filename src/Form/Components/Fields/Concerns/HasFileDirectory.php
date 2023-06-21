<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

trait HasFileDirectory
{
    protected ?string $disk = null;

    protected string $directory = '';

    protected bool $preserveFilenames = false;

    protected ?int $minSize = null;

    protected ?int $maxSize = null;

    protected ?int $maxFiles = null;

    protected array $acceptedFileTypes = ['image/jpg', 'image/png'];

    protected bool $isMultiple = false;

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

    public function preserveFilenames(bool $preserveFilenames): static
    {
        $this->preserveFilenames = $preserveFilenames;

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

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function isPreserveFilenames(): bool
    {
        return $this->preserveFilenames;
    }

    public function acceptedFileTypes(array $acceptedFileTypes): static
    {
        $this->acceptedFileTypes = $acceptedFileTypes;

        return $this;
    }

    public function getAcceptedFileTypes(): array
    {
        $this->addRules('mimetypes:' . implode(',', $this->acceptedFileTypes));

        return $this->acceptedFileTypes;
    }

    public function getAcceptFileTypes(): string
    {
        return implode(',', $this->acceptedFileTypes);
    }

    public function getMaxSize(): ?int
    {
        if ($this->maxSize) {
            $this->addRules('max:' . $this->maxSize);
        }

        return $this->maxSize;
    }

    public function getMaxFiles(): ?int
    {
        return $this->maxFiles;
    }

    public function getMinSize(): ?int
    {
        if ($this->minSize) {
            $this->addRules('min:' . $this->minSize);
        }

        return $this->minSize;
    }

    public function setMinSize(int $minSize): static
    {
        $this->minSize = $minSize;

        return $this;
    }

    public function setMaxSize(int $maxSize): static
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    public function setMaxFiles(int $maxFiles): static
    {
        $this->maxFiles = $maxFiles;

        return $this;
    }

    public function setIsMultiple(bool $isMultiple): static
    {
        $this->isMultiple = $isMultiple;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->isMultiple;
    }
}
